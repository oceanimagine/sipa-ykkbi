<title>Test GET</title>
<style type="text/css">
    html, body {
        font-family: consolas, monospace;
    }
</style>
<?php

// this is sequence 1 : i get all $_GET output
echo "Sequence 1 : <br />\n";
echo "<pre>\n";
print_r($_GET);
echo "</pre>\n";

// this is sequence 2 : i give an output
echo "Sequence 2 : " . $_GET['test'] . " <br />\n";

// this is sequence 3 : i do the change from HELLO to testingtest
echo "Sequence 3 : change \$_GET['test'] from HELLO to testingtest <br />\n";
$_GET['test'] = "testingtest";

// let's move to next sequence
include_once "test-page.php";
