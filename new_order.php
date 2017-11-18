<?php 
include_once("./database/db.php");
if (!isset($_SESSION["user_id"])) {
  header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script type="text/javascript" src="./js/main.js"></script> -->
    <script type="text/javascript" src="./js/ajax_process.js"></script>
  </head>
  <body>
<div class="overlay"><div class="loader"></div></div>
    <?php include_once "./templates/navbar.php" ?>
    <br/><br/>
    <div class="container">
      <div class="row">
        <div class="col-md-10" style="margin:0 auto;">
          <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
            <h4 class="card-header">New Order</h4>
            <div class="card-body">

                  <form id="order_form_details" onsubmit="return false" autocomplete="off">
                    <div class="form-group row">
                      <label for="date" class="col-sm-3 col-form-label" align="right">Order Date</label>
                      <div class="col-sm-6">
                        <input type="text" name="o_date" class="form-control form-control-sm" id="o_date" value="<?php echo date("Y-m-d"); ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="customer" class="col-sm-3 col-form-label" align="right">Customer Name*</label>
                      <div class="col-sm-6">
                        <input type="text" name="customer_name" class="form-control form-control-sm" id="customer_name" placeholder="Enter Customer Name">
                      </div>
                    </div>


                    <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                      <div class="card-body" style="overflow-x:scroll;">
                        <h3>Make Product List</h3>
                          <table align="center" style="width:800px;">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th style="text-align:center;">Item Name</th>
                                <th style="text-align:center;">Total Quantity</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Price</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody id="invoice_item">
                              <!--<tr>
                                <td><b id="number">1</b></td>
                                <td>
                                  <select name="pname[]" class="form-control form-control-sm">
                                    <option>Washing Machine</option>
                                  </select>
                                </td>
                                <td><input name="qty[]" type="text" class="form-control form-control-sm"></td>
                                <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                                <td>Rs.1540</td>
                              </tr>-->
                            </tbody>
                          </table>
                          <p></p>
                      <center><button id="add" class="btn btn-success btn-sm" style="width:150px;"><span class="fa fa-plus">&nbsp;</span>Add</button>
                      <button id="remove" class="btn btn-danger btn-sm" style="width:150px;"><span class="fa fa-remove">&nbsp;</span>Remove</button></center>
                      </div>

                    </div>
                    <p></p>
                    <div class="form-group row">
                      <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                      <div class="col-sm-6">
                        <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                      <div class="col-sm-6">
                        <input type="text" name="gst" class="form-control form-control-sm" id="gst">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                      <div class="col-sm-6">
                        <input type="text" name="discount" class="form-control form-control-sm" id="discount">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                      <div class="col-sm-6">
                        <input type="text" name="net_total" class="form-control form-control-sm" id="net_total">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                      <div class="col-sm-6">
                        <input type="text" name="paid" class="form-control form-control-sm" id="paid">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                      <div class="col-sm-6">
                        <input type="text" name="due" class="form-control form-control-sm" id="due">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                      <div class="col-sm-6">
                        <select name="payment_type" class="form-control form-control-sm" id="payment_type">
                          <option>Cash</option>
                          <option>Card</option>
                          <option>Draft</option>
                          <option>Cheque</option>
                        </select>
                      </div>
                    </div>

                    <center>
                      <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                      <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                    </center>
                     
                  </form>
              




            </div>
          </div>
        </div>
      </div>
    </div>




  </body>
</html>
<script type="text/javascript">
$(document).ready(function(){
  var domain = "http://inventorysystem.dev.com";

  addNewRow();

  $("#add").click(function(){
    addNewRow();
  })

  function addNewRow(){
    $.ajax({
      url : domain+"/includes/process.php",
      method : "POST",
      data : {addNewRow:1,number:1},
      success : function(data){
        $("#invoice_item").append(data);
        var n = 1;
        $(".number").each(function(){
          $(this).html(n);
          n++;
        })
      }
    })
  }

  $("#remove").click(function(){
    removeRow();
  })

  function removeRow(){
    var tr = $("#invoice_item").children("tr:last");
    tr.remove();
  }




  $("#invoice_item").delegate(".product_name","change",function(){
    var pid = $(this).val();
    var tr = $(this).parent().parent();
    if (pid != 0) {
      $.ajax({
        url : domain+"/includes/update.php",
        method : "POST",
        data : {get_price_qty:1,pid:pid},
        success : function(data){
          if(data == "NO_PRODUCT"){
            alert("Sorry, Selected product is not available");
          }else{
            var ar = data.split(",");
            tr.find(".pro_name").val(ar[2]);
            tr.find(".price").val(ar[0]);
            tr.find(".total_qty").val(ar[1]);
            tr.find(".qty").val(0);
            tr.find(".amt").html(tr.find(".price").val() * tr.find(".qty").val());
            $("#discount").val(0);
          }
        }
      })
    }else{
      alert("Please Select at least one product");
    }
  })



  var status = false;
  $("#invoice_item").delegate(".qty","keyup",function(){
    var qty = $(this).val();
    var tr = $(this).parent().parent();

    if (isNaN(qty)) {
      alert("Please enter Quantity in number format");
    }else{
      var available_qty = tr.find(".total_qty").val();
      var remaining_qty = available_qty - qty;
      if(remaining_qty < 0){
        alert("Sorry, We dont have this much Quantity of this product");
      }else{
        var price = tr.find(".price").val();
        var total_amt = price * qty;
        tr.find(".amt").html(total_amt);
        cal(0);
        status = true;
      }
    }

  })

  function cal(discount){
    var sub_total = 0;
    $(".amt").each(function(){
      sub_total += ($(this).html()-0);
    })
    var gst = 0.18 * (sub_total-0);
    var net_total = ((sub_total-0)+(gst-0))-(discount-0);
    $("#sub_total").val(sub_total);
    $("#gst").val(gst);
    $("#net_total").val(net_total);

  }

  $("#discount").keyup(function(){
    var discount = $("#discount").val();
    cal(discount);
  })

  $("#paid").keyup(function(){
    var paid = $("#paid").val();
    var due = ($("#net_total").val()-0) - paid;
    $("#due").val(due);
  })



  $("#order_form").click(function(){
    var cust_name = $("#customer_name").val();
    var paid = $("#paid").val();
    if (cust_name == "") {

    }else{

    }
    if (paid == "") {

    }else{

    }
    if (status == true) {
      $(".overlay").show();
      $.ajax({
        url : domain+"/includes/update.php",
        method : "POST",
        data : $("#order_form_details").serialize(),
        success : function(data){
          if(data == "SUCCESS"){
            $("#order_form").addClass("d-none");
            $("#print_invoice").removeClass("d-none");
            $(".overlay").hide();
          }
        }
      })
    };
  })


  $("#print_invoice").click(function(){
    var form_data = $("#order_form_details").serialize();
    window.location = domain+"/includes/invoice_bill.php?"+form_data;
  })
})

</script>