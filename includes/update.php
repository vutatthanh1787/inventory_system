<?php
include_once "../database/constants.php";
include_once "user.php";
include_once "DBOperation.php";
include_once "manage.php";

$obj = new Manage();

if (isset($_POST["category"]) && isset($_POST["cat_id"])) {
	$category = preg_replace("/[^a-zA-Z ]+/", "", $_POST["category"]);
	$p_cat = preg_replace("/[^0-9]+/", "", $_POST["p_cat"]);
	$db = new DBOperation();
	echo $result = $db->updateCategory($category,$p_cat,$_POST["cat_id"]);
}

if (isset($_POST["brand_name"]) && isset($_POST["brand_id"])) {
	$brand_name = preg_replace("/[^a-zA-Z ]+/", "", $_POST["brand_name"]);
	$db = new DBOperation();
	echo $result = $db->updateBrand($brand_name,$_POST["brand_id"]);
}

if (isset($_POST["get_price_qty"])) {
	$pid = $_POST["pid"];
	$row = $obj->singleRecord("products","pro_id",$pid);
	$str = $row["pro_price"].",".$row["pro_qty"].",".$row["pro_name"];
	if ($row["pro_qty"] < 1) {
		echo "NO_PRODUCT";
		exit();
	}else{
		echo $str;
		exit();
	}
}

if (isset($_POST["o_date"]) && isset($_POST["paid"])) {
	$date = $_POST["o_date"];
	$customer = $_POST["customer_name"];
	$sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$ptype = $_POST["payment_type"];

	//Product Arrays details 
	$pro_name = $_POST["pname"];
	$price = $_POST["price"];
	$qty = $_POST["qty"];

	echo $obj->addOrder($date,$customer,$sub_total,$gst,$discount,$net_total,$paid,$due,$ptype,$pro_name,$price,$qty);
}


if (isset($_POST["deleteRecord"])) {
	$obj = new DBOperation();
	if(isset($_POST["deleteCategory"])){
		$result = $obj->deleteRecord("categories","cat_id",$_POST["id"]);
	}else if(isset($_POST["deleteBrand"])){
		$result = $obj->deleteRecord("brands","brand_id",$_POST["id"]);
	}else if(isset($_POST["deleteProduct"])){
		$result = $obj->deleteRecord("products","pro_id",$_POST["id"]);
	}
	echo $result;
	exit();
}
?>