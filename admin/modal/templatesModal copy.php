


<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>New Template</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/templatesController.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Upload File</label>
                    <div class="col-sm-12">
                      <input type="file" class="form-control" id="" name="file" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Notes</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="" name="notes" rows="6" required>
                      </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Report</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="" name="report" rows="6" required>
                      </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/templatesController.php" enctype="multipart/form-data">
                <input type="hidden" name="templates_id" id="edit_templates_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Upload File</label>
                    <div class="col-sm-12">
                      <input type="file" class="form-control" id="" name="file">
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Notes</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="edit_notes" name="notes" rows="6" required>
                      </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Report</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="edit_report" name="report" rows="6" required>
                      </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<!-- Delete Confirmation Modal -->
<div id="delete" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons text-danger">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center">
                <form class="form-horizontal" method="POST" action="../controller/templatesController.php">
                    <input type="hidden" name="templates_id" id="delete_templates_id">
                    <p class="fs-5">Do you really want to delete this template? This action cannot be undone.</p>
                    <h3 class="fw-bold text-danger catname"></h3>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-danger" name="delete">
                    <i class="fa fa-trash"></i> Delete
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Better UI -->
<style>
    .modal-confirm {        
        color: #636363;
        width: 400px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
    }
    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        background: #f44336;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-confirm .icon-box i {
        font-size: 40px;
        color: #fff;
    }
</style>
