<?php

// Delete all requests and go back to the home.
$db->exec("DELETE FROM requests");
redirectTo("index&cleaned");
