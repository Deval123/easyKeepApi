<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 27/07/2019
 * Time: 16:07
 */


if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
$datecreate = date('Y-m-d H-i-s');// use to remove duplicate name of  images

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

require "dbconnect.php";

$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $nom = $request->nom;
    $tel = $request->tel;
    $sexe = $request->sexe;
    $email = $request->email;
    $utilisateurs_id = $request->utilisateurs_id;
}


$sql = "INSERT INTO recommandation ( nom, tel ,sexe ,email, utilisateurs_id, datecreate)
     VALUES ('$nom', '$tel', '$sexe', '$email', '$utilisateurs_id', '$datecreate' )";


if ($con->query($sql) === TRUE) {
    $sql1 = "SELECT id FROM recommandation WHERE nom = '$nom' and tel = '$tel'";
    $result = mysqli_query($con,$sql1);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $idadd = $row['id'];

    $response = array('success' => true, 'idadd' => $idadd);
} else {
    $response= "Error:";
}

echo json_encode( $response);


?>
