<?php

$mysqli = new mysqli("localhost", "root", "root", "crashtest");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

// select *, makes.name as make, models.name as model from cars c join makes on makes.id=c.make_id join models on models.id=c.model_id

// select *, makes.name as make, models.name as model from cars c join makes on makes.id=c.make_id join models on models.id=c.model_id where year > 2014 and overall_rating="5";

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT models.id, makes.name as make, models.name as model FROM models JOIN makes ON makes.id=models.make_id")) {

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);

    /* free result set */
    $result->close();
}

$mysqli->close();