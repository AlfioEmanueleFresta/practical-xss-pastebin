<?php

ob_clean();

$timestamp = time();
$type = strtoupper($_SERVER['REQUEST_METHOD']);
$metadata = json_encode([
    "ip" => $_SERVER["REMOTE_ADDR"],
    "user_agent" => $_SERVER["HTTP_USER_AGENT"]
]);
$body = json_encode($_REQUEST);

$query = $db->prepare("
    INSERT INTO   requests (type, timestamp, metadata, body)
    VALUES        (:type, :timestamp, :metadata, :body)
");
$query->bindValue(":type", $type);
$query->bindValue(":timestamp", $timestamp, PDO::PARAM_INT);
$query->bindValue(":metadata", $metadata);
$query->bindValue(":body", $body);
$result = $query->execute() or die("Error persisting the request to the database.");

$request_id = $db->lastInsertId();

echo "The request has been captured with request_id={$request_id}.";
exit(0);
