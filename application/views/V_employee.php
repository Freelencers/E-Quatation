<style>
  td, th{
    text-align: center;
  }

  .error {
      border: solid 1px #FF0000;  
  }

  .text_error {
      color: #FF0000;  
  }

</style>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="<?php echo base_url('/assert/plugins/iCheck/all.css'); ?>">

<div class="row">
  <div class="col-md-4">
    <div class="box box-primary" id="add_new_form">
      <div class="box-header with-border">
        <h3 class="box-title">New User</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <label>Username</label>
          <input type="text" id="emp_username" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="input-group input-group-md">
            <input type="password" id="emp_password" class="form-control" placeholder="Enter ...">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-flat" id="eye_password"><i class="fa fa-eye"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input type="text" id="emp_first_name" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" id="emp_last_name" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="emp_email" id="emp_email" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Position</label>
          <select class="form-control" id="emp_pos_id" name="emp_pos_id" placeholder="Enter">
            <option value="" disabled selected>Select your option</option>
          </select>
        </div>
      </div>
      <div class="box-footer">
          <button type="button" id="btn_insert" class="btn btn-primary pull-right" data-toggle='modal' data-target='modal-success'>Add New User</button>
          <!-- button type="button" class="btn btn-primary pull-right" data-toggle='modal' data-target='#modal-confirm' >Add New User</button -->
      </div>
    </div>
  </div>

  <div class="col-md-8"> 
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Waiting Aprove</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="waitting_approve" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Username</th>
              <th>Password</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Position</th>
              <th>Email</th>
              <th>Create</th>
              <th>Update</th>
              <th>Operation</th>
            </tr>
          </thead>
          <tbody>
            <!-- employee waitting approve list -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <div class="col-md-8">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Employee List</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="employee_list" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Username</th>
              <th>Password</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Position</th>
              <th>Email</th>
              <th>Create</th>
              <th>Update</th>
              <th>Operation</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Change Profile -->
<div class="modal fade" id="modal-change_profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update User Profile</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>First Name</label>
          <input type="hidden" id="change_emp_id">
          <input type="text" id="change_first_name" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" id="change_last_name" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="change_email" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Position </label>
            <select class="form-control" id="change_pos_id" name="emp_pos_id">
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="change_profile_ok">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Change password -->
<div class="modal fade" id="modal-change_password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <input type="hidden" id="emp_id">
      <div class="modal-body">
      <input type="hidden" id="username">
        <div class="form-group">
          <label>Current Password</label> <span id="error_password" class="text_error"></span>
          <input type="password" id="password" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>New Password</label> <span id="error_new_password" class="text_error"></span>
          <input type="password" id="new_password" class="form-control" placeholder="Enter ...">
        </div>
        <div class="form-group">
          <label>Confirm New Password</label> <span id="error_confirm_password" class="text_error"></span>
          <input type="password" id="confirm_password" class="form-control" placeholder="Enter ...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="change_password_ok">Change</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- confirm delete -->
 <div class="modal modal-danger fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>This user will be remove from system</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="confirm_delete">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Permission Modal -->
<div class="modal fade" id="modal-permission">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Permission</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="permission_table">
          <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Menu</th>
              <th style="width: 10px">Access</th>
              <th style="width: 10px">Copy</th>
            </tr>
          </head>
          <tbody>
            <!-- module list -->
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- add new user -->
 <div class="modal modal-success fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Success</h4>
      </div>
      <div class="modal-body">
        <p>Username create already</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" data-dismiss="modal">Okay</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('/assert/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/iCheck/icheck.min.js'); ?>"></script>

<script src="<?php echo base_url('/assert/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<script>
  var pos_id = '<?= $this->session->userdata('position_id'); ?>';
</script>
<?php
  echo script_tag("js/employee.js");
?>
