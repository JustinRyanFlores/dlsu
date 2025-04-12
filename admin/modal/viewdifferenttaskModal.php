<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/viewdifferenttaskController.php" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="edit_task_id" name="task_id" >
                <input type="hidden" class="form-control" name="setdeadline_id" value="<?php echo $_GET['setdeadline_id'] ?>">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="" name="status" required>
                        <option value="1">TO DO</option>
                        <option value="2">IN WORK</option>
                        <option value="3">TASK DUE THIS WEEK</option>
                        <option value="4">COMPLETED</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Description</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_description" name="description" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
