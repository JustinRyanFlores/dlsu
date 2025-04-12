<div class="modal fade" id="assign">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Assign Research Teacher</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/assignationController.php">
                <input type="hidden" id="taskcomment_task_id" name="task_id" required>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Section</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="section" name="section" readonly required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Research Teacher</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="rt" id="rt" required>
                          <option value="" selected disabled>Select Research Teacher</option>
                          <?php  
                            $sql = "SELECT * FROM users WHERE type = 1";
                            $stmt = $this->conn()->query($sql);
                            while ($row = $stmt->fetch()):
                                $rt = ucwords($row['firstname']." ".$row['lastname'])
                          ?>
                          <option value="<?=$row['id']?>"><?=$rt?></option>
                          <?php endwhile ?>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="assign"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Change Research Teacher</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/assignationController.php">
                <input type="hidden" id="taskcomment_task_id" name="task_id" required>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Section</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="chng-section" name="section" readonly required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Research Teacher</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="rt" id="chng-rt" required>
                          <option value="NULL">Remove Research Teacher</option>
                          <?php  
                            $sql = "SELECT * FROM users WHERE type = 1";
                            $stmt = $this->conn()->query($sql);
                            while ($row = $stmt->fetch()):
                                $rt = ucwords($row['firstname']." ".$row['lastname'])
                          ?>
                          <option value="<?=$row['id']?>"><?=$rt?></option>
                          <?php endwhile ?>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success" name="change"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
