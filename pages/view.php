<?php

$request_id = (int) $_GET['request_id'];

$query = $db->query("
    SELECT      id, type, metadata, timestamp, body
    FROM        requests
    WHERE       id = $request_id
");
$query->execute();

$request = $query->fetch(PDO::FETCH_ASSOC);
if (!$request) {
    die("Unable to find a request with this ID.");
}

?>

<h2>
    Request Details
    <span class="text-muted">
        (#<?= $request_id; ?>)
    </span>
</h2>

<p>
    <a href="<?= getRefreshURL(); ?>&highlight_request_id=<?= $request_id; ?>"
       class="btn btn-lg btn-default">
        <i class="glyphicon glyphicon-backward"></i>
        Find in the list
    </a>
</p>
<p>&nbsp;</p>

<table class="table table-bordered table-striped">

    <tr>
        <td>Request Type</td>
        <td class="sl">
            <?= $request['type']; ?>
        </td>
    </tr>

    <tr>
        <td>Timestamp</td>
        <td class="sl">
            <?= date('d/m/Y H:i:s', $request['timestamp']); ?>
        </td>
    </tr>

    <tr>
        <td>Metadata</td>
        <td>

            <table class="table table-condensed monospace">
                <?php foreach (json_decode($request['metadata']) as $key => $value) { ?>
                    <tr>
                        <td class="text-muted"><?= $key; ?></td>
                        <td><?= $value; ?></td>
                    </tr>
                <?php } ?>
            </table>

        </td>
    </tr>

    <tr>
        <td>Request Body</td>
        <td>

            <table class="table table-condensed monospace">
                <?php foreach (json_decode($request['body']) as $key => $value) { ?>
                    <tr>
                        <td class="text-muted"><?= $key; ?></td>
                        <td class="monospace"><?= $value; ?></td>
                    </tr>
                <?php } ?>
            </table>

        </td>
    </tr>

</table>