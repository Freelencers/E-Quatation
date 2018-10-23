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
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">System Type</h3>

        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="input-group col-xs-6 pull-right">
          <input id="new_name_syt" type="text" class="form-control" placeholder="System Name">
          <div class="input-group-btn">
            <button id="add_syt" type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-success">Add</button>
          </div>
          <!-- /btn-group -->
        </div>
      </div>
      <div class="box-body">
        <table id="system_type_table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>System Name</th>
            <th>Operation</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Brand</h3>

        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="input-group col-xs-6 pull-right">
          <input id="new_name_bra" type="text" class="form-control" placeholder="Brand Name">
          <div class="input-group-btn">
            <button id="add_bra" type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-success">Add</button>
          </div>
          <!-- /btn-group -->
        </div>
      </div>
      <div class="box-body">
        <table id="brand_table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Brand Name</th>
            <th>Operation</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Place Type</h3>

        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="input-group col-xs-6 pull-right">
          <input id="new_name_plt" type="text" class="form-control" placeholder="Place Type Name">
          <div class="input-group-btn">
            <button id="add_plt" type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-success">Add</button>
          </div>
          <!-- /btn-group -->
        </div>
      </div>
      <div class="box-body">
        <table id="place_type_table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Place Type Name</th>
            <th>Operation</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-8">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Product</h3>
        <div class="box-tools">
        </div>
      </div>
      <div class="box-header with-border">
        <div class="col-xs-2 pull-right">
          <label> &nbsp </label>
          <button type="button" class="btn btn-block btn-primary" id="btn_add_new_product"><i class="fa fa-fw fa-plus"></i> Add Product</button>
        </div>
        <div class="col-xs-3 pull-right">
          <label> Brand </label>
          <select class="form-control" id="brand_filter">
            <!-- brand list -->
          </select>
        </div>

        <div class="col-md-6" style="height: 30px">
          <br>
          <ul class="pagination pagination-sm pull-left paging_project" style="margin-top:1px">
            <!-- paging list -->
          </ul>
        </div>
      </div>
      <div class="box-body">
        <table id="product_table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No.</th>
            <th>Model</th>
            <th class="col-md-2">Picture</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Price</th>
            <th>Profit</th>
            <th class="col-md-1">Operation</th>
          </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
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

<!-- New Product modal -->
<div class="modal fade" id="modal-product_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">New Product</h4>
      </div>
      <div class="modal-body">
        <form name="add_product_form">
          <div class="form-group">
            <label>Model</label>
            <input type="text" name="model" class="form-control" placeholder="Enter ..." id="model">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="desc" rows="3" placeholder="Enter ..." id="desc"></textarea>
          </div>
          <div class="form-group">
            <label>Unit</label>
            <select class="form-control" name="unit" id="unit">

            </select>
          </div>
          <!--div class="form-group">
            <label>Unit</label>
            <input type="number" step="1" min="1" class="form-control" placeholder="Enter ...">
          </div -->
          <div class="form-group">
            <label>Cost</label>
            <div class="input-group">
              <input type="text" class="form-control" name="cost" placeholder="Enter ..." id="cost">
              <span class="input-group-addon">Baht</span>
            </div>
          </div>
          <div class="form-group">
            <label>Price</label>
            <div class="input-group">
              <input type="text" class="form-control" name="price" placeholder="Enter ..." id="price">
              <span class="input-group-addon">Baht</span>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Image File </label>
            <input type="file" name="product_image" id="product_image">
            <div id="warning_file" style="color:red;"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="add_product_btn">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 


<!-- Edit name -->
<div class="modal fade" id="modal-name_update">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update name</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>New Name</label>
          <input type="hidden" class="form-control" placeholder="Enter ..." id="table">
          <input type="text" class="form-control" placeholder="Enter ..." id="new_name">
          <input type="hidden" id="new_id">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_name" data-dismiss="modal">Save</button>
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

<?php
  echo script_tag("js/fundamental.js");
?>
