<?php

include_once("../database/db.php");

/**
* 
*/
class Manage
{
	
	private $con;

	function __construct()
	{
		$db = new Database();
		$this->con = $db->connectDB();
	}

	public function manageTables($table,$type,$id,$page_num){
		$a = $this->pagination($table,$id,$page_num);
		$pagination = $a["pagination"];
		$limit = $a["limit"];
		if ($type == "cat") {
			$pre_stmt = $this->con->prepare("SELECT p.cat_id,p.cat_name as parent,c.cat_name as child,p.c_status FROM categories p LEFT OUTER JOIN ".$table." c ON p.parent_cat=c.cat_id ".$limit);
		}else if($table == "products"){
			$pre_stmt = $this->con->prepare("SELECT p.pro_id,p.pro_name,c.cat_name,b.brand_name,p.pro_price,p.pro_qty,p.added_date,p.status FROM products p LEFT OUTER JOIN categories c ON p.pro_category=c.cat_id LEFT OUTER JOIN brands b ON p.pro_brand = b.brand_id ".$limit);
		}else{
			$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." ".$limit);
		}
		$pre_stmt->execute();
		$result = $pre_stmt->get_result() or die($this->con->error);
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return array("rows"=>$rows,"pagination"=>$pagination);
	
	}

	public function pagination($table,$id,$page_num){
		$query = $this->con->query("SELECT ".$id." FROM ".$table);
		$each_page = 5;
		$total_rows = $query->num_rows;
		if ($total_rows > 0) {
			$total_page = ceil($total_rows/$each_page);//37/5=7.4=8
		}
		$page_number = 1;
		if (isset($page_num)) {
			$page_number = $page_num;//1
		}
		$last_page = $total_page;//1
		if ($last_page < 1) {
			$last_page = 1;
		}else if($page_number > $last_page){
			$last_page = $page_number;
		}

		$limit = "LIMIT ".(($page_number-1)*$each_page).",".$each_page;

		$pagination = "";
		if ($last_page >= 1 ) {
			if ($page_number > 1) {
				$previous = $page_number - 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='$previous' href='#'>Previous</a></li>";
				for ($i=$page_number-4; $i < $page_number ; $i++) { 
					if ($i > 0) {
						$pagination .= "<li class='page-item'><a class='page-link' pn='$i'>$i</a></li>";
					}
				}
			}
			$pagination .= "<li class='page-item'><a class='page-link' pn='$page_number'>$page_number</a></li>";
				for ($i=$page_number+1; $i < $last_page ; $i++) { 
					$pagination .= "<li class='page-item'><a class='page-link' pn='$i' href='#'>$i</a></li>";
					if ($i > $last_page) {
						break;
					}
				}
				if ($page_number != $last_page) {
					$next = $page_number + 1;
					$pagination .= "<li class='page-item'><a class='page-link' pn='$i' href='#'>Next</a></li>";
				}
			
		}

		return array("pagination"=>$pagination,"limit"=>$limit);
		
	}


	public function singleRecord($table,$key,$id){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$key."= ? LIMIT 1");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute();
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}

	public function addOrder($date,$customer,$sub_total,$gst,$discount,$net_total,$paid,$due,$ptype,$pro_name,$price,$qty){
		$pre_stmt = $this->con->prepare("INSERT INTO `invoice`(`cust_name`, `order_date`, `sub_total`, `gst_tax`, `discount`, `net_total`, `paid_amt`, `due`, `payment_method`) 
			VALUES (?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssdidddds",$customer,$date,$sub_total,$gst,$discount,$net_total,$paid,$due,$ptype);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result){
			//Array Processing
			$invoice_no = $pre_stmt->insert_id;
			$_SESSION["invoice_no"] = $invoice_no;
			for ($i=0; $i < count($pro_name); $i++) { 
				$p_stmt = $this->con->prepare("INSERT INTO invoice_details (`invoice_no`, `product_name`, `product_price`, `qty`)
					VALUES (?,?,?,?)");
				$p_stmt->bind_param("isdi",$invoice_no,$pro_name[$i],$price[$i],$qty[$i]);
				$result1 = $p_stmt->execute() or die($this->con->error);
			}
			if(!$result1){
				return "INNER_LOOP_ERROR";
			}
		}else{
			return "ERROR";
			exit();
		}
		return "SUCCESS";
	}

}



//$m = new Manage();
//print_r($m->manageTables("products"));
//echo $m->pagination("categories","cat_id",4);
//$m->manageTables("categories","cat","cat_id",1)
//print_r($m->singleRecord("categories","cat_id",2));
?>