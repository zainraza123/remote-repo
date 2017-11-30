<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/time-entry/');

$search = 'sample';
$it = new RecursiveDirectoryIterator(ROOT . 'sql/');
foreach (new RecursiveIteratorIterator($it) as $file) {
    if (strpos($file, $search . '.sql')) {
        echo $file . "<br/> \n";
    }
}
