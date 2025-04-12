<!--Comment-->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Set Comment</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/viewtasklistController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Comment</label>
                    <div class="col-sm-12">
                      <input type="hidden" class="form-control" id="edit_setdeadline_id" name="setdeadline_id" required>
                      <input type="hidden" class="form-control" value="<?php echo $_GET['teams_id'] ?>" name="teams_id" required>
                      <textarea class="form-control" name="comment" rows="6" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary" name="edit"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!--Add task-->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Task</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/viewtasklistController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Name</label>
                    <div class="col-sm-12">
                      <input type="hidden" class="form-control" value="<?php echo $_GET['teams_id'] ?>" name="teams_id" required>
                      <input class="form-control" name="name" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!--Edit-->
<div class="modal fade" id="edit2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Task</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/viewtasklistController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Name</label>
                    <div class="col-sm-12">
                      <input type="hidden" value="<?php echo $_GET['teams_id'] ?>" name="teams_id" required>
                      <input type="hidden" name="setdeadline_id" id="edit2_setdeadline_id">
                      
                      <input class="form-control" id="edit2_name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Set Deadline</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="edit2_deadline" name="deadline">
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit2_status" name="status">
                          <option value="0">Ongoing</option>
                          <option value="1">Scheduled </option>
                          <option value="2">Past Due</option>
                          <option value="3">Completed</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Set Reminder</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" name="notes" rows="6" id="edit2_notes" placeholder="reminder here ..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="edit2"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>



<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/viewtasklistController.php">
                <input type="hidden" name="setdeadline_id" id="delete_setdeadline_id">
                <input type="hidden" class="form-control" value="<?php echo $_GET['teams_id'] ?>" name="teams_id" required>
                <div class="text-center">
                    <p>DELETE TASK</p>
                    <h2 class="bold catname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>