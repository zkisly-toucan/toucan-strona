<?php

$db = new SQLite3('database.sqlite');

$query = "select * from mails;";
$result = $db->query($query);



while ($row = $result->fetchArray()) {
    echo ('<br>');
    var_dump($row);
}