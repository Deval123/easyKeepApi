<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 04/05/2019
 * Time: 15:28
 */

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

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
        $login = $request->login;
        $password = $request->password;

    }
        $login = stripslashes($login);
        $password = stripslashes($password);

	  $sql = "SELECT id FROM releveur WHERE login = '$login' and password = '$password' ";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $idadd = $row['id'];
      $count = mysqli_num_rows($result);
      if($count >0) {
          $response = array('success' => true, 'idadd' => $idadd);
          //$response= "Your Login success";
      }else {
          //$response= "Your Login Email or Password is invalid";
          $response = array('success' => false);
      }

	echo json_encode( $response);
?>