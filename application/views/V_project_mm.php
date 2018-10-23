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
<div class="row">
<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Project</h3>
      <div class="box-tools">
      </div>
    </div>
    <div class="box-header">
      <div class="col-md-6" style="height: 30px">
        <ul class="pagination pagination-sm pull-left paging_project" style="margin-top:1px">
          <!-- paging list -->
        </ul>
      </div>
      <div class="col-sm-2 pull-right">
        <a href="c_project_mm/add_project_view"><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-product_add"><i class="fa fa-fw fa-plus"></i>Create Project</button></a>
      </div>
    </div>
    <div class="box-body">
      <table id="project_table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>Project</th>
          <th>Company</th>
          <th>Customer</th>
          <th>Type</th>
          <th>Status</th>
          <th>Operation</th>
        </tr>
        </thead>
        <tbody>
          <!-- project list -->
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div> 


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

<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('/assert/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/iCheck/icheck.min.js'); ?>"></script>
<?php
  echo script_tag("js/project_mm.js");
?>
