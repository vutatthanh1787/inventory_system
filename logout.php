<?php
include_once("./database/db.php");
if (!isset($_SESSION["user_id"])) {
	header("location:".DOMAIN."/");
	exit();
}

session_destroy();
header("location:".DOMAIN."/");
?>