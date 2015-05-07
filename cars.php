<?php

$mysqli = new mysqli("localhost", "root", "root", "crashtest");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s:\n", $mysqli->connect_error);
    die();
}

// select *, makes.name as make, models.name as model from cars c join makes on makes.id=c.make_id join models on models.id=c.model_id

// select *, makes.name as make, models.name as model from cars c join makes on makes.id=c.make_id join models on models.id=c.model_id where year > 2014 and overall_rating="5";



$make = $_GET['make'];
$model = $_GET['model'];
$gt_year = $_GET['gt_year'];
$lt_year = $_GET['lt_year'];
$year = $_GET['year'];
$stars = $_GET['stars'];

echo "make: $make model: $model gt_year: $gt_year lt_year $lt_year year $year stars $stars";
die();

$sql = "SELECT *, makes.name AS make, models.name AS model FROM cars c JOIN makes ON makes.id=c.make_id JOIN models ON models.id=c.model_id";

if ($result = $mysqli->query($sql)) {

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);

    $result->close();
}

$mysqli->close();