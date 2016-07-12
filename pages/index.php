<?php

$highlight_request_id = (int) (@$_GET['highlight_request_id']);

?>


<div class="row">


    <div class="col-xs-9">

        <?php if (isset($_GET['cleaned'])) { ?>
            <div class="alert alert-info">
                <i class="glyphicon glyphicon-check"></i> All requests deleted.
            </div>
        <?php } ?>

        <?php
        $requests = getLatestRequests();
        ?>

        <table class="table table-condensed table-striped">
            <thead>
            <th>#</th>
            <th>Date</th>
            <th>Time</th>
            <th>Type</th>
            <th>IP</th>
            <th>Body</th>
            </thead>

            <?php foreach ($requests as $request) { ?>
                <tr<?php if ($request['id'] == $highlight_request_id) { ?> class="info"<?php }?>>
                    <td><?= $request['id']; ?></td>
                    <td><?= date('d/m/Y', $request['timestamp']); ?></td>
                    <td><?= date('H:i:s', $request['timestamp']); ?></td>
                    <td style="font-weight: bold;"><?= $request['type']; ?></td>
                    <td><?= json_decode($request['metadata'])->ip; ?></td>
                    <td>
                        <a href="?page=view&request_id=<?= $request['id']; ?>">
                            View request
                        </a>
                    </td>
                </tr>

            <?php } ?>

            <?php if (!$requests) { ?>
                <tr class="warning">
                    <td colspan="6">
                        No request captured. Use the URL on the right to capture your requests,
                        then <a href="<?= getRefreshURL(); ?>">refresh this page</a>.
                    </td>
                </tr>
            <?php } ?>

        </table>

    </div>

    <div class="col-xs-3">

        <p>
            <a href="<?= getRefreshURL(); ?>" class="btn btn-default btn-block">
                <i class="glyphicon glyphicon-refresh"></i>
                Refresh
            </a>
        </p>
        <p>&nbsp;</p>

        <h3>
            <i class="glyphicon glyphicon-info-sign"></i>
            Capture
        </h3>
        <p>1. Use the following URL to capture your requests:</p>
        <p>
            <input type="text" class="form-control input-lg"
                   readonly="readonly" autofocus id="capture-url"
                   value="<?= getCaptureURL(); ?>"
            />
        </p>
        <p>2. <a href="<?= getRefreshURL(); ?>">Refresh this page</a>.</p>
        <p>&nbsp;</p>

        <h3>
            <i class="glyphicon glyphicon-trash"></i>
            Clean up
        </h3>
        <p>To delete all requests, click the following button:</p>
        <p>
            <a href="?page=clean" class="btn btn-danger btn-block">
                <i class="glyphicon glyphicon-warning-sign"></i>
                Delete all requests
            </a>
        </p>
        <p>&nbsp;</p>

        <hr />

        <p>
            Please note only the <?= $conf["requests_show_no"]; ?> most recent
            requests are displayed<?= $conf["requests_auto_cleanup"] ? " and stored" : ""; ?>.
        </p>

    </div>

</div>
