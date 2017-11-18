<?php



/**
* 
*/

class DBOperation
{
	
	private $con;

	public function __construct(){
		include_once "../database/db.php";
		$db = new Database();
		$this->con = $db->connectDB();
	}


	public function addCategory($catName,$parentCat){
		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`cat_name`, `parent_cat`) VALUES (?,?)");
		$pre_stmt->bind_param("ss",$catName,$parentCat);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result){
			return true;
		}
		return 0;
	}
	public function addBrand($brandName){
		$pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`) VALUES (?)");
		$pre_stmt->bind_param("s",$brandName);
		$result = $pre_stmt->execute();
		if($result){
			return true;
		}
		return 0;
	}
	public function displayBrandAndCategory($table){
		$list = array();
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute();
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$list[] = $row;
			}
		}else{
			return "NO_DATA_FOUND";
		}
		return $list;
	}

	public function addProduct($pro_name,$pro_brand,$pro_category,$pro_price,$pro_qty,$date,$status){
		$pre_stmt = $this->con->prepare("INSERT INTO `products` (`pro_name`, `pro_brand`, `pro_category`, `pro_price`, `pro_qty`, `added_date`, `status`) 
			VALUES (?, ?, ?, ?, ?, ?, ?)");
		$status = 1;
		$date = date("Y-m-d");
		$pre_stmt->bind_param("siidisi",$pro_name,$pro_brand,$pro_category,$pro_price,$pro_qty,$date,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result){
			return "PRODUCT_ADDED";
		}
		return 0;
	}

	public function updateCategory($catName,$parentCat,$cat_id){
		$pre_stmt = $this->con->prepare("UPDATE categories SET cat_name = ? , parent_cat = ? WHERE cat_id = ? ");
		$pre_stmt->bind_param("ssi",$catName,$parentCat,$cat_id);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result){
			return true;
		}
		return 0;
	}

	public function updateBrand($brandName,$brand_id){
		$pre_stmt = $this->con->prepare("UPDATE brands SET brand_name = ? WHERE brand_id = ? ");
		$pre_stmt->bind_param("si",$brandName,$brand_id);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result){
			return true;
		}
		return 0;
	}

	public function deleteRecord($table,$key,$id){
		$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$key."= ? ");
		$pre_stmt->bind_param("i",$id);
		$result = $pre_stmt->execute();
		if($result){
			return "DELETED";
		}
		return "NOT_DELETED";
	}

	


}

//$db = new DBOperation();
//print_r($db->displayCategory());

//echo $db->addBrand("LG");
//echo $db->addCategory("Antivirus","3");

//echo $db->addProduct("xxxx",2,3,2000.50,5,'2017-05-03',1);
?>