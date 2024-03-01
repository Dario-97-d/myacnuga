<?php
$conn = mysqli_connect('localhost', 'root', 'uchihasasukeitachi97D', 'myacnuga');

function prot($conn, $str) {
	return mysqli_real_escape_string($conn, strip_tags(trim(addslashes($str))));
}

function output($string) {
    echo '<br /><div id="output">' . $string . "</div><br />";
}
?>