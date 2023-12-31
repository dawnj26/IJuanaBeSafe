<?php

session_start();
if (! isset($_SESSION['id'])) {
    exit();
}
require '../../config/config.php';

$id = $_SESSION['id'];

$result = $mainConn->query("SELECT user_id, first_name, last_name, user_role FROM user WHERE user_id != '$id'");
$count = 0;
$json = [];
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {

        $initials = strtoupper(substr($data['first_name'], 0, 1)).strtoupper(substr($data['last_name'], 0, 1));
        $full_name = $data['first_name'].' '.$data['last_name'];
        $json[] = ['user_id' => $data['user_id'], 'full_name' => $full_name, 'initials' => $initials, 'user_role' => $data['user_role']];

    }

}
echo json_encode($json);
