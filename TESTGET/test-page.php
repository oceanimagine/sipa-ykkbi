<?php

// this is sequence 4 : i give an output and it should show testingtest because it has been change at sequence 3 
echo "Sequence 4 : " . $_GET['test'] . " <br />\n";

// let's move to next sequence
include_once "test-page-inside.php";