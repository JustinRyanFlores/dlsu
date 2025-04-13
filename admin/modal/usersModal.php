<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>New User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/usersController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Firstname</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Lastname</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Email</label>
                    <div class="col-sm-12">
                      <input type="email" class="form-control" id="" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Password</label>
                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Department</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="" name="department" required>
                        <option value="Computer SCIENCE">Computer SCIENCE</option>
                        <option value="Information Technology">Information Technology</option>
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
              <form class="form-horizontal" method="POST" action="../controller/usersController.php">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Firstname</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Lastname</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Email</label>
                    <div class="col-sm-12">
                      <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Department</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_department" name="department" required>
                        <option value="Computer SCIENCE">Computer SCIENCE</option>
                        <option value="Information Technology">Information Technology</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Section/s handled:</label>
                    <div class="col-sm-12" id="addEditSection">
                        <?php 
                        $database = new Connection();
                        $pdo = $database->conn();
                        
                        $sql = "SELECT section_name FROM sections WHERE adviser IS NULL";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $sections = $stmt->fetchAll();
                        ?>
                        <input type="text" class="form-control" style="background-color: transparent;" id="edit_section" disabled required>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 5px;" id="addSection">+ Add Section</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Status</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_status" name="status" required>
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Declined</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
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
              <h4 class="modal-title">Deleting...</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/usersController.php">
                <input type="hidden" name="id" id="delete_id">
                <div class="text-center">
                    <p>Are you sure you want to delete this user?</p>
                    <h2 class="bold catname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
              <button type="submit" class="btn btn-danger" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>