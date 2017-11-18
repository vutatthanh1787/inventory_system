<?php
include_once "../database/constants.php";
include_once "user.php";
include_once "DBOperation.php";
include_once "manage.php";

if (isset($_POST["user_register"])) {
	$username = preg_replace("/[^A-Za-z ]+/", "", $_POST["username"]);
	$regexp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
	if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password1"]) || empty($_POST["password2"])) {
		header("location:".DOMAIN."/register.php?error=Please fill all input fields");
		exit();
	}
	if(!preg_match($regexp, $_POST["email"])){
		header("location:".DOMAIN."/register.php?error=Invalid Email Address");
		exit();
	}
	if(strlen($_POST["password1"]) < 7 || strlen($_POST["password2"]) < 7){
		header("location:".DOMAIN."/register.php?error=Password should be greater than 7 characters");
	}
	if ($_POST["password1"] != $_POST["password2"]) {
		header("location:".DOMAIN."/register.php?error=Password is not matched");
	}
	$user = new User();
	$result = $user->createUser($username,$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	if($result == "email_exists"){
		header("location:".DOMAIN."/register.php?error=Email Address already exists");
	}
	if($result == 1){
		header("location:".DOMAIN."/index.php?success=Your account is created successfully now you can login");
	}
	exit();	
}


if (isset($_POST["log_email"]) && isset($_POST["log_password"])) {
	$regexp = "/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
	if(!preg_match($regexp, $_POST["log_email"])){
		echo "INVALID_EMAIL";
		exit();
	}
	$user = new User();
	$result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
	echo $result;
	
}


if (isset($_POST["brand_name"])) {
	$brand_name = preg_replace("/[^a-zA-Z ]+/", "", $_POST["brand_name"]);
	$db = new DBOperation();
	echo $result = $db->addBrand($brand_name);
}

if (isset($_POST["category"])) {
	$category = preg_replace("/[^a-zA-Z ]+/", "", $_POST["category"]);
	$p_cat = preg_replace("/[^0-9]+/", "", $_POST["p_cat"]);
	$db = new DBOperation();
	echo $result = $db->addCategory($category,$p_cat);
}

if (isset($_POST["date"])) {
	$regexp = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
	if(!preg_match($regexp, $_POST["date"])){
		echo "DATE_MODIFY";
		exit();
	}
	$db = new DBOperation();
	echo $result = $db->addProduct($_POST["pro_name"],$_POST["pro_brand"],$_POST["pro_cat"],$_POST["price"],$_POST["qty"],$_POST["date"],1);
	exit();
}


if (isset($_POST["fetch_category"])) {
	 $cat = new DBOperation();
     $rows = $cat->displayBrandAndCategory("categories");
     foreach ($rows as $row) {
     	echo "<option value=".$row["cat_id"].">".$row["cat_name"]."</option>";
	}
	exit();
                   
}
if (isset($_POST["fetch_brand"])) {
	 $cat = new DBOperation();
     $rows = $cat->displayBrandAndCategory("brands");
     foreach ($rows as $row) {
     	echo "<option value=".$row["brand_id"].">".$row["brand_name"]."</option>";
	}
	exit();
                   
} 

if (isset($_POST["getCategory"])) {
	$mng = new Manage();
	if (isset($_POST["pageNumber"])) {
		$result = $mng->manageTables("categories","cat","cat_id",$_POST["pageNumber"]);
	}else{
		$result = $mng->manageTables("categories","cat","cat_id",1);
	}
    $rows = $result["rows"];
    $pages = $result["pagination"];
     foreach ($rows as $row) {
     	//echo "<option value=".$row["cat_id"].">".$row["cat_name"]."</option>";
     	if ($row["child"] == null) {
                	$child = "Root";
                }else{
                	$child = $row["child"];
          }
                
     	echo '<tr>
                <th scope="row">'.$row["cat_id"].'</th>
                <td>'.$row["parent"].'</td>
                <td>'.$child.'</td>
                <td><a href="" status='.$row["c_status"].' class="btn btn-success"><span class="fa fa-ok">&nbsp;</span>Active</a></td>
                <td>
                  <a href="#" did="'.$row["cat_id"].'" id="delete_category"  class="btn btn-danger"><span class="fa fa-trash">&nbsp;</span>Delete</a>
                  <a href="#" eid="'.$row["cat_id"].'" id="update_category" class="btn btn-info"><span class="fa fa-edit">&nbsp;</span>Edit</a>
                </td>
              </tr>';
	}
	echo '<tr>
			<td colspan="5">
				<nav aria-label="Page navigation example">
	            	<ul class="pagination">'.$pages.'</ul>
          		</nav>
			</td>
		</tr>
	';
	exit();
}

if (isset($_POST["getBrands"])) {
	$mng = new Manage();
	if (isset($_POST["pageNumber"])) {
		$result = $mng->manageTables("brands",null,"brand_id",$_POST["pageNumber"]);
	}else{
		$result = $mng->manageTables("brands",null,"brand_id",1);
	}  
    $rows = $result["rows"];
    $pages = $result["pagination"];
     foreach ($rows as $row) {
     	//echo "<option value=".$row["cat_id"].">".$row["cat_name"]."</option>";
     	echo '<tr>
                <th scope="row">'.$row["brand_id"].'</th>
                <td>'.$row["brand_name"].'</td>
                <td><a href="" status='.$row["b_status"].' class="btn btn-success"><span class="fa fa-ok">&nbsp;</span>Active</a></td>
                <td>
                  <a href="#" did="'.$row["brand_id"].'" id="delete_brand" class="btn btn-danger"><span class="fa fa-trash">&nbsp;</span>Delete</a>
                  <a href="#" eid="'.$row["brand_id"].'" id="update_brand" class="btn btn-info"><span class="fa fa-edit">&nbsp;</span>Edit</a>
                </td>
              </tr>';
	}
	echo '<tr>
			<td colspan="5">
				<nav aria-label="Page navigation example">
	            	<ul class="pagination">'.$pages.'</ul>
          		</nav>
			</td>
		</tr>
	';
	exit();
}
if (isset($_POST["getProducts"])) {
	$mng = new Manage();
	if (isset($_POST["pageNumber"])) {
		$result = $mng->manageTables("products",null,"pro_id",$_POST["pageNumber"]);
	}else{
		$result = $mng->manageTables("products",null,"pro_id",1);
	}  
    $rows = $result["rows"];
    $pages = $result["pagination"];
     foreach ($rows as $row) {
     	//echo "<option value=".$row["cat_id"].">".$row["cat_name"]."</option>";
     	echo '<tr>
                <th scope="row">'.$row["pro_id"].'</th>
                <td>'.$row["pro_name"].'</td>
                <td>'.$row["cat_name"].'</td>
                <td>'.$row["brand_name"].'</td>
                <td>'.$row["pro_price"].'</td>
                <td>'.$row["pro_qty"].'</td>
                <td>'.$row["added_date"].'</td>
                <td><a href="" status='.$row["status"].' class="btn btn-success btn-sm"><span class="fa fa-ok">&nbsp;</span>Active</a></td>
                <td>
                  <a href="" did="'.$row["pro_id"].'" id="delete_product" class="btn btn-danger btn-sm"><span class="fa fa-trash">&nbsp;</span>Delete</a>
                  <a href="" eid="'.$row["pro_id"].'" id="update_product" class="btn btn-info btn-sm"><span class="fa fa-edit">&nbsp;</span>Edit</a>
                </td>
              </tr>';
	}
	echo '<tr>
			<td colspan="9">
				<nav aria-label="Page navigation example">
	            	<ul class="pagination">'.$pages.'</ul>
          		</nav>
			</td>
		</tr>
	';
	exit();
}


if (isset($_POST["addNewRow"])) {
	 $num = $_POST["number"];
	 $pro = new DBOperation();
     $rows = $pro->displayBrandAndCategory("products");
     ?>
     <tr>
        <td><b class="number"></b></td>
        <td>
        <select name="pname[]" class="form-control form-control-sm product_name">
        <option value="0">Choose Product</option>
     <?php
     foreach ($rows as $row) {
     	?>
     		<option value="<?php echo $row['pro_id']; ?>"><?php echo $row["pro_name"]; ?></option>
     	<?php
     }
     ?>
     	</select>
        </td>
        <td><input name="total_qty[]" type="text" class="form-control form-control-sm total_qty" readonly></td>
        <td><input name="qty[]" type="text" class="form-control form-control-sm qty"></td>
        <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></td>
        <td>Rs.<span class="amt">0</span></td>
        <td><input type="hidden" type="text" name="pro_name[]" class="pro_name" id="pro_name"></td>
      </tr>
     <?php
     exit();
}   


if (isset($_POST["singleRecord"])) {
	$mng = new Manage();
	$row = $mng->singleRecord("categories","cat_id",$_POST["id"]);
	echo $row["cat_id"].",".$row["cat_name"].",".$row["parent_cat"];
	exit();
}
if (isset($_POST["singleRecordBrand"])) {
	$mng = new Manage();
	$row = $mng->singleRecord("brands","brand_id",$_POST["id"]);
	echo $row["brand_id"].",".$row["brand_name"];
	exit();
}



?>