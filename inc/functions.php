<?php

/*
 * Redirect the user to a different page.
 */
function redirectTo($page) {
    header("Location: ?page=$page");
    exit(0);
}


/*
 * Gets the latest requests saved to the database.
 */
function getLatestRequests() {
    global $db, $conf;
    $limit = (int) $conf["requests_show_no"];
    $query = $db->query("
        SELECT      id, type, timestamp, metadata, body
        FROM        requests
        ORDER BY    timestamp DESC, id DESC
        LIMIT       0, {$limit}
    ");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // If set in the configuration, clean up the database
    if ($conf["requests_auto_cleanup"] && count($results) == $limit) {
        $min_id = $results[count($results) - 1]['id'];
        $db->exec("DELETE FROM requests WHERE id < {$min_id}");
    }

    return $results;
}


/*
 * Get the Capture URL
 */
function getCaptureURL() {
    global $_SERVER;
    return "http://{$_SERVER['HTTP_HOST']}/?page=capture";
}


/*
 * Get a fresh Index URL
 */
function getRefreshURL() {
    $time = time() + 1;
    return "http://{$_SERVER['HTTP_HOST']}/?page=index&refresh=$time";
}
