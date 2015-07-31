<?php
require_once( 'inc/connect.inc');
function getDB() {
	global $db;
        $dbhost=$db['host'];
        $dbuser=$db['user'];
        $dbpass=$db['pass'];
        $dbname=$db['name'];
        $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
}
