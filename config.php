<?php
/**
 * Created by PhpStorm.
 * User: devalere
 * Date: 28/01/2019
 * Time: 12:56
 */
/* define('HOST','localhost');
define('USER', 'habitech_sant');
define('PASS','?bi6JRpHLV.W');
define('DB','habitech_sant-alert');
$con = mysqli_connect(HOST,USER,PASS,DB);
  if (!$con){
	 die("Error in connection" . mysqli_connect_error()) ;
  }
*/
define('DB_HOST','db4free.net');
define('DB_USER', 'essayeuse');
define('DB_PASSWORD','easykeep');
define('DB_NAME','keepsake');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

date_default_timezone_set('Africa/Douala');


/*define('DB_HOST','localhost');
define('DB_USER', 'habitech_sant');
define('DB_PASSWORD','?bi6JRpHLV.W');
define('DB_NAME','habitech_easyKeep');
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

date_default_timezone_set('Africa/Douala');*/

