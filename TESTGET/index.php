<title>Test GET</title>
<style type="text/css">
    html, body {
        font-family: consolas, monospace;
    }
</style>
<?php

echo "<pre>\n";
print_r($_GET);
echo "</pre>\n";

echo $_GET['test'] . " <br />\n";
$_GET['test'] = "testingtest";

include_once "test-page.php";
