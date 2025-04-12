<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>ADD SUBTASK</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/tasklistController.php" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="edit_setdeadline_id" name="setdeadline_id" >
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Member</label>
                    <div class="col-sm-12">
                        <?php

                          $sql3 = "SELECT * FROM teams WHERE users_id = '".$_SESSION['id']."'";
                          $stmt3 = $this->conn()->query($sql3);
                          $row3 = $stmt3->fetch();

                          $sql = "SELECT * FROM teams_member INNER JOIN users ON teams_member.users_id=users.id WHERE teams_id = '".$row3['teams_id']."'";
                          $stmt = $this->conn()->query($sql);
                          while ($row = $stmt->fetch()) { ?>
                            <div>
                              <input type="checkbox" value="<?php echo $row['id']; ?>" name="users_id[]"> <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>
                            </div>
                          <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Description</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="" name="description" rows="6" required>
                      </textarea>
                    </div>
                </div>
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
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="uploadfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Upload File</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/tasklistController.php" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="uploadfile_setdeadline_id" name="setdeadline_id" >
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">File</label>
                    <div class="col-sm-12">
                      <input type="file" class="form-control" id="" name="file" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="uploadfile"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
