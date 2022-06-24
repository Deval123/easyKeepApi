<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 27/07/2019
 * Time: 15:11
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
//////id	consultation_id	contenu

$data = file_get_contents("php://input");
if (isset($data)) {
    $request = json_decode($data);
    $nom_prenom = $request->nomPrenom;
    $tel1 = $request->tel1;
    $tel2 = $request->tel2;
    $sexe = $request->sexe;
    $email = $request->email;
    $cni = $request->cni;
    $residence = $request->residence;
    $profession = $request->profession;
    $no_repertoire = $request->noRepertoire;
    $nbre_contact = $request->nbreContact;
    $document = $request->document;
    $operateur = $request->operateur;
    $apparence = $request->apparence;
    $zones = $request->zones;
    $detail = $request->detail;
    $point = $request->point;
    $mode = $request->mode;
    $releveur_id = $request->releveurId;
}


$sql = "INSERT INTO utilisateurs ( nom_prenom, tel1,tel2 ,sexe ,email,cni,residence,profession,
    no_repertoire,nbre_contact,document, operateur,apparence,zones, 	 detail, point, mode,	  datecreate, releveur_id)
     VALUES ('$nom_prenom', '$tel1', '$tel2', '$sexe', '$email', '$cni', '$residence', '$profession', '$no_repertoire', '$nbre_contact',
      '$document', '$operateur', '$apparence', '$zones', '$detail', '$point',
     '$mode', '$datecreate', '$releveur_id' )";


if ($con->query($sql) === TRUE) {
    //$idadd = mysqli_insert_id($);
    //$response= "Successfull";
    $sql1 = "SELECT id FROM utilisateurs WHERE nom_prenom = '$nom_prenom' and tel1 = '$tel1'";
    $result = mysqli_query($con,$sql1);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $idadd = $row['id'];

    $response = array('success' => true, 'idadd' => $idadd);
} else {
    $response= "Error:";
}

echo json_encode( $response);


?>
