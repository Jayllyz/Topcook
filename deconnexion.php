<?php
session_start();
session_destroy();
// Refresh 0.1s
header("location: https://topcook.site/");
