<?php

// Connect to the SQLite database
$db = new PDO(
    $conf["database"]["dsn"],
    $conf["database"]["username"],
    $conf["database"]["password"],
    $conf["database"]["options"]
);


// There is only one table, if it does not exist,
// create it on the fly.

$table_exists = $db->exec("SELECT 1 FROM requests");
if (!$table_exists) {
    $db->exec("
        CREATE TABLE requests (
          id INTEGER PRIMARY KEY AUTOINCREMENT,
          type VARCHAR(255),
          timestamp INTEGER,
          body TEXT,
          metadata TEXT
        )
    ");
}
