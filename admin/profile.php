<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Profile</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../controller/profileController.php" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                      <label for="imgFile" style="cursor: pointer; position: relative;">
                        <div class="icon" style="position: absolute; right: 0; bottom: 0">
                          <i class="fas fa-camera" style="padding: 6px; background-color: gray; color: white; border-radius: 50%;"></i>
                        </div>
                        <img id="img" style="border-radius: 50%;" alt="wala" width="80px" height="80px">
                      </label>
                      <input type="file" id="imgFile" name="img" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-12">Firstname:</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-12">Lastname:</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="user_id" id="users_id">
                    <label for="email" class="col-sm-12">Email:</label>

                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <?php if($_SESSION['type'] == 2): ?>
                    <div class="form-group">
                        <label for="section" class="col-sm-12">Section:</label>
    
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="section" name="section">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="yrLvl" class="col-sm-12">Year Level:</label>
    
                        <div class="col-sm-12">
                            <select name="yr_lvl" id="yrLvl" class="form-control">
                                <option value="3RD">3rd Year</option>
                                <option value="4TH">4th Year</option>
                            </select>
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <label for="password" class="col-sm-12">Password:</label>

                    <div class="col-sm-12"> 
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary" name="save"><i class="fa fa-check-square-o"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>