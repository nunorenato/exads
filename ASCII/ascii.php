<?php

// create an array with the ascii codes of the characters
$chars = range(ord(','), ord('|'));

// transform the codes into the charactes
$chars = array_map(chr, $chars);

// get an original array for later validation
$validation = $chars;

// randomize the array
shuffle($chars);

// pick one element at random
$randKey = rand(0, count($chars)-1);

// remove it from the array
echo "Removing $randKey: " . $chars[$randKey] . "<br>";
unset($chars[$randKey]);

// finds the missing element
$diff = array_diff($validation, $chars);
if(count($diff) == 0)
    echo "Nothing is missing.<br>";
else{
    $missing = array_pop($diff);
    echo "Missing: $missing<br>";
}
?>