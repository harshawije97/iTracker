<?php


// Get all estates
function getAllEstates(PDO $conn)
{
    try {
        $query = $conn->prepare("SELECT * FROM estates");
        $query->execute();
        return [
            'success' => true,
            'data' => $query->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

// Get all estates and filter by parameters
function getAllEstatesByParameters(PDO $conn, array $filter = [])
{
    try {
        if (empty($filter)) {
            $columns = "*";
        } else {
            $allowedColumns = ['id', 'estate_code', 'estate_name'];

            // remove invalid columns
            $validColumns = array_intersect($filter, $allowedColumns);

            // if all are invalid fallback to all columns
            if (empty($validColumns)) {
                $columns = "*";
            } else {
                $columns = implode(', ', $validColumns);
            }
        }

        // Run the query
        $query = $conn->prepare("SELECT $columns FROM estates");
        $query->execute();
        return [
            'success' => true,
            'data' => $query->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}


// Get estate by estate code
function getEstateByCode(PDO $conn, $estateCode)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM estates WHERE estate_code = :estateCode");
        $stmt->bindParam(':estateCode', $estateCode);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}
