<div class="modal fade" id="taskcomment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Comment Task</b></h4>
      </div>
      <div class="modal-body">
        <div id="comments_section" style="max-height: 200px; overflow-y: auto;">
          <!-- Comments will be loaded here -->
        </div>
        <br>
        <!-- Comment Form -->
        <form class="form-horizontal" method="POST" action="../controller/monitorthesisController.php">
          <input type="hidden" id="taskcomment_task_id" name="task_id" required>
          <input type="hidden" name="teams_id" value="<?php echo $_GET['teams_id'] ?>" required>
          <div class="form-group">
            <label for="project_list_id" class="col-sm-12">COMMENT:</label>
            <div class="col-sm-12">
              <textarea class="form-control" name="comment" rows="6" required></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-success" name="taskcomment"><i class="fa fa-save"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="taskcommentdashboard">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Task Comments</b></h4>
      </div>
      <div class="modal-body">
        <div id="comments_section_dashboard" style="max-height: 200px; overflow-y: auto;">
          <!-- Comments will be loaded here -->
        </div>
        <br>
        <!-- Comment Form -->
        <form class="form-horizontal" method="POST" action="../controller/monitorthesisController.php">
          <input type="hidden" id="taskcommentdashboard_task_id" name="task_id" required>
          <div class="form-group">
            <label for="project_list_id" class="col-sm-12">COMMENT:</label>
            <div class="col-sm-12">
              <textarea class="form-control" name="comment" rows="6" required></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-success" name="taskcommentdashboard"><i class="fa fa-save"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>