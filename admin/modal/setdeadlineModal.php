<!-- Edit -->
<div class="modal fade" id="setreminder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Set Reminder</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/setdeadlineController.php" enctype="multipart/form-data">
                <input type="hidden" name="teams_id" id="setreminder_teams_id">
                <input type="hidden" name="setdeadline_id" id="setreminder_setdeadline_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Notes</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" name="notes" rows="6" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="setreminder"><i class="fa fa-check-square-o"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="changestatus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Status</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/setdeadlineController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                      <input type="hidden" class="form-control" id="changestatus_setdeadline_id" name="setdeadline_id" required>
                      <input type="hidden" class="form-control" name="teams_id" value="<?php echo $_GET['teams_id'] ?>" required>
                      <select class="form-control" name="status" required>
                        <option value="0">ONGOING</option>
                        <option value="1">SCHEDULED</option>
                        <option value="2">PAST DUE</option>
                        <option value="3">COMPLETED</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="changestatus"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>