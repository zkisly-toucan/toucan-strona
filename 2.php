<?php

$db = new SQLite3('database.sqlite');

$query = "select * from log;";
$result = $db->query($query);



while ($row = $result->fetchArray()) {
    echo ('<br>');
    var_dump($row);
}