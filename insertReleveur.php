<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 27/07/2019
 * Time: 08:58
 */

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
$datenow1 = date('Y-m-d H-i-s');// use to remove duplicate name of  images

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

require "dbconnect.php";
//////id	consultation_id	contenu

$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $login = $request->login;
    $password = $request->password;
    $gender = $request->gender;
}


$sql = "INSERT INTO releveur (login, password, gender, datecreate) VALUES ('$login', '$password', '$gender', '$datenow1')";


if ($con->query($sql) === TRUE) {
    //$idadd = mysqli_insert_id($);
    //$response= "Successfull";
    $sql1 = "SELECT id FROM releveur WHERE login = '$login' and password = '$password'";
    $result = mysqli_query($con,$sql1);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $idadd = $row['id'];

    $response = array('success' => true, 'idadd' => $idadd);
} else {
    $response= "Error:";
}

echo json_encode( $response);


?>
