<?php
$connection = new mysqli("localhost","root","","get-city-by-state-by-country");
if (! $connection){
    die("Error in connection".$connection->connect_error);
}
