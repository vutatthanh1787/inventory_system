<!-- Modal -->
    <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          
          
            <form id="update_category_form" onsubmit="return false">
              <div class="form-group">
                <input type="hidden" id="cat_id" name="cat_id" value="">
                <label for="category">Category Name</label>
                <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
                <small id="c-error">Enter new Category Name</small>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Parent Category</label>
                <select class="form-control cat_select" name="p_cat" id="p_cat">

                  <option value="0">Root</option>
                  
                </select>
                <small id="p_c-error">Choose Parent Category or root</small>
              </div>
              <button type="submit" name="u_category" id="u_category" class="btn btn-primary">Update</button>
            </form>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 