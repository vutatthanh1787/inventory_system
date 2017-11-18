<!-- Modal -->
    <div class="modal fade" id="add_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="update_brand_form" onsubmit="return false">
              <div class="form-group">
                <input type="hidden" id="brand_id" name="brand_id" value="">
                <label for="category">Brand Name</label>
                <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand">
                <small id="b-error">Enter new Brand Name</small>
              </div>
              <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span>Update</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 