<?php

$mysqli = new mysqli("localhost", "root", "root", "crashtest");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT id, name FROM makes")) {

    header('Content-Type: application/json');

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);

    /* free result set */
    $result->close();
}

$mysqli->close();