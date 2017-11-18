$(document).ready(function(){
	var domain = "http://inventorysystem.dev.com";
	alert(domain);
  $("#login_form").on("submit",function(){
  	if ($("#log_email").val() == "") {
  		$("#log_email").addClass("border-danger");
  		$("#e-error").html("<span class='text-danger'>Please enter Email address<span>");
  	}else{
  		$("#log_email").removeClass("border-danger");
  		$("#e-error").html("");
  	}
  	if ($("#log_password").val() == "") {
  		$("#log_password").addClass("border-danger");
  		$("#p-error").html("<span class='text-danger'>Please enter Password<span>");
  	}else{
  		$("#log_password").removeClass("border-danger");
  		$("#p-error").html("");
  	}
  	if ($("#log_email").val() != "" && $("#log_password").val() != "") {
  		$(".overlay").show();
  		$.ajax({
  			url: "http://inventorysystem.dev.com/includes/process.php",
		    //url: domain+"/includes/process.php",
		    type: 'post',
		    data: $("#login_form").serialize(),
		    success : function(data){
		  			$(".overlay").hide();
		  			if(data == "INVALID_EMAIL"){
		  				$("#log_email").addClass("border-danger");
		  				$("#e-error").html("<span class='text-danger'>Invalid Email Address<span>");
		  			}else{
		  				$("#log_email").removeClass("border-danger");
		  				$("#e-error").html("");
		  			}
		  			if(data == "NOT_REGISTERED"){
		  				$("#log_email").addClass("border-danger");
		  				$("#e-error").html("<span class='text-danger'>Sorry, It seems like you are not registered !<span>");
		  			}else{
		  				$("#log_email").removeClass("border-danger");
		  				$("#e-error").html("");
		  			}
		  			if (data == "NO_PASSWORD_MATCH") {
		  				$("#log_password").addClass("border-danger");
		  				$("#p-error").html("<span class='text-danger'>Invalid Password<span>");
		  			}else{
		  				$("#log_password").removeClass("border-danger");
		  				$("#p-error").html("");
		  			}
		  			if (data == 1) {
		  				window.location = domain+"/dashboard.php";
		  			}
		  		}
		  	})
  	};
  	
  })


	$("#brand_form").on("submit",function(){
		var brand_name = $("#brand_name").val();
		if (brand_name == "") {
		  		$("#brand_name").addClass("border-danger");
		  		$("#b-error").html("<span class='text-danger'>Please enter brand name<span>");
		  	}else{
		  		$("#brand_name").removeClass("border-danger");
		  		$("#b-error").html("");
		  		$(".overlay").show();
		  		$.ajax({
		  			url : domain+"/includes/process.php",
		  			method : "POST",
		  			data : $("#brand_form").serialize(),
		  			success : function(data){
		  				if (data == 1) {
		  					$("#b-error").html("<span class='text-success'>New Brand Added Successfully<span>");
		  					$("#brand_name").val(""); 
		  					$(".overlay").hide();
		  					fetch_brand();
		  				}else{
		  					alert(data);
		  					$(".overlay").hide();
		  				}
		  			}
		  		})
		  	}
	})

	$("#new_category").on("click",function(){
		var cat_name = $("#category").val();
		if (cat_name == "") {
		  		$("#category").addClass("border-danger");
		  		$("#c-error").html("<span class='text-danger'>Please Enter Category Name<span>");
		  	}else{
		  		$(".overlay").show();
		  		$("#category").removeClass("border-danger");
		  		$("#c-error").html("");
		  		$.ajax({
		  			url : domain+"/includes/process.php",
		  			method : "POST",
		  			data : $("#category_form").serialize(),
		  			success : function(data){
		  				if (data == 1) {
		  					$("#c-error").html("<span class='text-success'>New Category Added Successfully<span>");
		  					$("#category").val(""); 
		  					$(".overlay").hide();
		  					fetch_category();
		  				}else{
		  					alert(data);
		  					$(".overlay").hide();
		  				}
		  			}
		  		})
		  	}
	})

	$("#product_form").on("submit",function(){
		if($("#pro_name").val() == ""){
			$("#pro_name").addClass("border-danger");
		  	$("#pro-error").html("<span class='text-danger'>Please Enter Product Name<span>");
		}else{
			$("#pro_name").removeClass("border-danger");
		  	$("#pro-error").html("");
		}
		if ($("#pro_cat").val() == "") {
			$("#pro_cat").addClass("border-danger");
		  	$("#pro-cat-error").html("<span class='text-danger'>Please Choose Category Name<span>");
		  }else{
		  	$("#pro_cat").removeClass("border-danger");
		  	$("#pro-cat-error").html("");
		  }
		  if ($("#pro_brand").val() == "") {
			$("#pro_brand").addClass("border-danger");
		  	$("#pro-brand-error").html("<span class='text-danger'>Please Choose Brand Name<span>");
		  }else{
		  	$("#pro_brand").removeClass("border-danger");
		  	$("#pro-brand-error").html("");
		  }
		  if ($("#price").val() == "") {
			$("#price").addClass("border-danger");
		  	$("#price-error").html("<span class='text-danger'>Please Enter Price Per Product<span>");
		  }else{
		  	$("#price").removeClass("border-danger");
		  	$("#price-error").html("");
		  }
		  if ($("#qty").val() == "") {
			$("#qty").addClass("border-danger");
		  	$("#qty-error").html("<span class='text-danger'>Please Enter Quantity of Product<span>");
		  }else{
		  	$("#qty").removeClass("border-danger");
		  	$("#qty-error").html("");
		  }
		  if($("#pro_name").val() != "" && $("#pro_cat").val() != "" && $("#pro_brand").val() != ""
		  	&& $("#price").val() != "" && $("#qty").val() != ""){
		  	$(".overlay").show();
		  		$.ajax({
		  			url : domain+"/includes/process.php",
		  			method : "POST",
		  			data : $("#product_form").serialize(),
		  			success : function(data){
		  				if (data == "PRODUCT_ADDED") {
		  					$("#pro_name").val("");
		  					$("#pro_cat").val("");
		  					$("#pro_brand").val("");
		  					$("#price").val("");
		  					$("#qty").val("");
		  					$("#msg").html("<span class='text-success'>New Product Added Successfully<span>")
		  					$(".overlay").hide();
		  				}else{
		  					alert(data);
		  					$(".overlay").hide();
		  				}
		  			}
		  		})
		  }
	})
	
	fetch_category();
	function fetch_category(){
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {fetch_category:1},
		  		success : function(data){
		  			var option = "<option value='0'>Root</option>";
		  			var Choose = "<option value=''>Choose Category</option>";
		  			$(".cat_select").html(option+data);
		  			$("#pro_cat").html(Choose+data);
		  		}
		  })
	}
	fetch_brand();
	function fetch_brand(){
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {fetch_brand:1},
		  		success : function(data){
		  			var Choose = "<option value=''>Choose Brand</option>";
		  			$("#pro_brand").html(Choose+data);
		  		}
		  })
	}

	getCategory();
	function getCategory(){
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {getCategory:1},
		  		success : function(data){
		  			$("#get_category").html(data);
		  		}
		  })
	}

	getBrands();
	function getBrands(){
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {getBrands:1},
		  		success : function(data){
		  			$("#get_brand").html(data);
		  		}
		  })
	}

	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {getCategory:1,pageNumber:pn},
		  		success : function(data){
		  			$("#get_category").html(data);
		  		}
		  })
	})
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		$.ajax({
		  		url : domain+"/includes/process.php",
		  		method : "POST",
		  		data : {getBrands:1,pageNumber:pn},
		  		success : function(data){
		  			$("#get_brand").html(data);
		  		}
		  })
	})









	getProducts();
          function getProducts(){
            $.ajax({
                  url : domain+"/includes/process.php",
                  method : "POST",
                  data : {getProducts:1},
                  success : function(data){
                    $("#get_products").html(data);
                  }
              })
          }

        $("body").delegate(".page-link","click",function(){
          var pn = $(this).attr("pn");
          $.ajax({
                url : domain+"/includes/process.php",
                method : "POST",
                data : {getProducts:1,pageNumber:pn},
                success : function(data){
                  $("#get_products").html(data);
                }
            })
        })


  $("body").delegate("#update_category","click",function(){
    var cid = $(this).attr("eid");
    $.ajax({
      url : domain+"/includes/process.php",
      method : "POST",
      data : {singleRecord:1,id:cid},
      success : function(data){
        var ar = data.split(",");
        $("#cat_id").val(ar[0]);
        $("#category").val(ar[1]);
        $("#p_cat").val(ar[2]);
        $("#add_category").modal('show');
      }
    })
  })


  $("#update_category_form").on("submit",function(){
    var cat_name = $("#category").val();
		if (cat_name == "") {
		  		$("#category").addClass("border-danger");
		  		$("#c-error").html("<span class='text-danger'>Please Enter Category Name<span>");
		  	}else{
		  		$(".overlay").show();
		  		$("#category").removeClass("border-danger");
		  		$("#c-error").html("");
		  		$.ajax({
		  			url : domain+"/includes/update.php",
		  			method : "POST",
		  			data : $("#update_category_form").serialize(),
		  			success : function(data){
		  				if (data == 1) {
		  					$("#c-error").html("<span class='text-success'> Category Updated Successfully<span>");
		  					$("#category").val(""); 
		  					$(".overlay").hide();
		  					getCategory();
		  				}else{
		  					alert(data);
		  					$(".overlay").hide();
		  				}
		  			}
		  		})
		  	}
  })



 $("body").delegate("#update_brand","click",function(){
    var bid = $(this).attr("eid");
    $.ajax({
      url : domain+"/includes/process.php",
      method : "POST",
      data : {singleRecordBrand:1,id:bid},
      success : function(data){
        var ar = data.split(",");
        $("#brand_id").val(ar[0]);
        $("#brand_name").val(ar[1]);
        $("#add_brand").modal('show');
      }
    })
  })

    $("#update_brand_form").on("submit",function(){
    var brand_name = $("#brand_name").val();
    if (brand_name == "") {
          $("#brand_name").addClass("border-danger");
          $("#b-error").html("<span class='text-danger'>Please Enter Brand Name<span>");
        }else{
          $(".overlay").show();
          $("#brand_name").removeClass("border-danger");
          $("#b-error").html("");
          $.ajax({
            url : domain+"/includes/update.php",
            method : "POST",
            data : $("#update_brand_form").serialize(),
            success : function(data){
              if (data == 1) {
                $("#b-error").html("<span class='text-success'> Brand Updated Successfully<span>");
                $("#brand_name").val(""); 
                $(".overlay").hide();
                getBrands();
              }else{
                alert(data);
                $(".overlay").hide();
              }
            }
          })
        }
  })


    $("body").delegate("#delete_category","click",function(){
    	$(".overlay").show();
    	var did = $(this).attr("did");
    	$.ajax({
    		url : domain+"/includes/update.php",
    		method : "POST",
    		data : {deleteRecord:1,deleteCategory:1,id:did},
    		success : function(data){
    			getCategory();
    			$(".overlay").hide();
    		}
    	})
    });

    $("body").delegate("#delete_brand","click",function(){
    	$(".overlay").show();
    	var did = $(this).attr("did");
    	$.ajax({
    		url : domain+"/includes/update.php",
    		method : "POST",
    		data : {deleteRecord:1,deleteBrand:1,id:did},
    		success : function(data){
    			$(".overlay").hide();
    			getBrands();
    		}
    	})
    });

    $("body").delegate("#delete_product","click",function(){
    	$(".overlay").show();
    	var did = $(this).attr("did");
    	$.ajax({
    		url : domain+"/includes/update.php",
    		method : "POST",
    		data : {deleteRecord:1,deleteProduct:1,id:did},
    		success : function(data){
    			$(".overlay").hide();
    			getProducts();
    		}
    	})
    });




  

  
















        
});