<?php
session_start();
session_destroy();
// Refresh 0.1s
header("Refresh: 0.1; url=https://topcook.site/");

?>
