

<div class="modal fade" id="addnewschedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add New Schedule</b></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/calendarController.php">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Hectares</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_hectare" name="hectare" required>
                        <option value="">-- Select --</option>
                          <option>Hectare 1</option>
                          <option>Hectare 2</option>
                          <option>Hectare 3</option>
                          <option>Hectare 4</option>
                          <option>Hectare 5</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Type</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_type" name="type" required>
                        <option value="">-- Select --</option>
                          <option>Fertilizer</option>
                          <option>Watering</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Unit</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_select" name="select2" required>
                        <option value="">-- Select --</option>
                          <option value="Sacks">Sacks</option>
                          <option value="Liter">Liter</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Total</label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" name="total" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Start Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="start_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">End Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn" name="addcalendar" style="background-color: #E5EE7F;"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editschedule" tabindex="-1" role="dialog">

  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Schedule</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/calendarController.php">
                <input type="hidden" name="schedule_id" id="edit_schedule_id2">
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Title</label>
                    <div class="col-sm-12">
                      <input class="form-control" id="edit_title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Hectares</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_hectare2" name="hectare" required>
                        <option value="">-- Select --</option>
                          <option value="Hectare 1">Hectare 1</option>
                          <option value="Hectare 2">Hectare 2</option>
                          <option value="Hectare 3">Hectare 3</option>
                          <option value="Hectare 4">Hectare 4</option>
                          <option value="Hectare 5">Hectare 5</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Type</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_type2" name="type" required>
                        <option value="">-- Select --</option>
                          <option value="Fertilizer">Fertilizer</option>
                          <option value="Watering">Watering</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-12">Unit</label>
                    <div class="col-sm-12">
                      <select class="form-control" id="edit_select2" name="select2" required>
                        <option value="">-- Select --</option>
                          <option value="Sacks">Sacks</option>
                          <option value="Liter">Liter</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Total</label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" id="edit_total" name="total" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">Start Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_list_id" class="col-sm-12">End Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger" name="deletecalendar"><i class="fa fa-check-square-o"></i> Delete</button>
                <button type="submit" class="btn btn-success" name="editcalendar"><i class="fa fa-check-square-o"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>