<!-- Modal -->
    <div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="msg"></div>
            <form id="product_form" onsubmit="return false" autocomplete="off">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="date" class="col-form-label">Date</label>
                  <input type="text" class="form-control" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" readonly="readonly">
                </div>
                <div class="form-group col-md-6">
                  <label for="pro_name" class="col-form-label">Product Name</label>
                  <input type="text" class="form-control" name="pro_name" id="pro_name" placeholder="Enter Product Name">
                  <small id="pro-error">Enter new Product name</small>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Product Brand</label>
                <select class="form-control" name="pro_brand" id="pro_brand">
                  
                  


                </select>
                <small id="pro-brand-error">Choose a Product Brand</small>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Product Category</label>
                <select class="form-control" name="pro_cat" id="pro_cat">
                  



                </select>
                <small id="pro-cat-error">Choose a Product Category</small>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="price" class="col-form-label">Price</label>
                  <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                   <small id="price-error"></small>
                </div>
                <div class="form-group col-md-6">
                  <label for="qty" class="col-form-label">Quantity</label>
                  <input type="text" class="form-control" name="qty" id="qty" placeholder="Qantity">
                  <small id="qty-error"></small>
                </div>
              </div>  
              <input type="submit" class="btn btn-primary" name="add_product" value="Submit"/>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 