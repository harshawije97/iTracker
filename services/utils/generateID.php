<?php

function generateUniqueKey(int $length)
{
    return sprintf('%s', bin2hex(random_bytes($length)));
}

?>