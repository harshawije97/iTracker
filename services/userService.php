<?php

require_once './services/constants/enums.php';


// get all users

// get all head office managers (email & name)
function getAllManagers(PDO $conn, bool $isHeadOfficeManager = false, array $filter = [])
{
    if (empty($filter)) {
        $columns = "*";
    } else {
        $allowedColumns = ['id', 'first_name', 'last_name', 'email', 'estate_code', 'role', 'is_registered'];

        // remove invalid columns
        $validColumns = array_intersect($filter, $allowedColumns);

        // if all are invalid fallback to all columns
        if (empty($validColumns)) {
            $columns = "*";
        } else {
            $columns = implode(', ', $validColumns);
        }
    }

    if ($isHeadOfficeManager) {
        $query = $conn->prepare("SELECT $columns FROM users WHERE role NOT IN ('chief-clerk', 'estate-manager')");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $query = $conn->prepare("SELECT * FROM users WHERE role NOT IN ('chief-clerk')");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
