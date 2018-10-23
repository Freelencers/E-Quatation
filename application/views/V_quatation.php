<style>
    .text_center{
        text-align: center;
    }
    .content-wrapper{
      height : 2000px;
    }
</style>
<!-- Main content -->
<section class="col-lg-4 content">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Project</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6" style="height: 30px">
              <ul class="pagination pagination-sm pull-left paging_project" style="margin-top:1px">
                <!-- paging list -->
              </ul>
            </div>
            <div class="col-md-5 pull-right">
              <div class="form-group input-group-sm pull-right">
                <input type="text" id="prj_search" class="form-control" placeholder="Enter keyword">
              </div>
            </div>
          </div>
            <table id="project_list" class="table table-bordered table-hover text_center data_table">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Write</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Revised History</h3>
        </div>
        <div class="box-body">
            <table id="revise_history" class="table table-bordered table-hover text_center data_table">
            <thead>
                <tr>
                <th>No.</th>
                <th>Create</th>
                <th>Status</th>
                <th>Version</th>
                <th>Edit</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
              <tr>
                <td colspan="5">Please select project</td>
               </tr>
            </table>
        </div>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Profit Summary</h3>
                <div class="box-tools">
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-12 cost_empty" style="text-align:center; display:none">
                  <p>Please select revised<p>
                </div>

                <div class="row">
                  <!-- left -->
                  <div class="col-md-4 cost_monitor">

                    <div class="form-group">
                      <label>Cost</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="cost_price_percent" maxlength="2" value="0" disabled>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Overhead</label>
                      <div class="input-group">
                        <input type="number" id="over_head" step="1" min="0" max="100" value="0" class="form-control" disabled>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Actual Profit</label>
                      <div class="input-group">
                        <input type="number" id="actual_profit" step="1" min="0" max="100" value="0" class="form-control" disabled>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>

                  </div>

                  <!-- right -->
                  <div class="col-md-8 cost_monitor">              
                      <div class="form-group">
                        <label style="color: white">.</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="cost_price" value="0" maxlength="2" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label style="color: white">.</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="overhead_price" value="0" maxlength="2" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>


                      <div class="form-group">
                        <label style="color: white">.</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="actual_profit_price" value="0" maxlength="2" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>

                      <div class="from-group">
                        <label>Total Cost</label>
                        <div class="input-group">
                            <input type="number" id="over_head_price" step="1" min="0" max="100" value="0" class="form-control" disabled>
                            <span class="input-group-addon">THB</span>
                        </div>
                      </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <!-- left -->
                  <div class="col-md-4 cost_monitor">
                    <div class="form-group">
                      <label>Profit</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="profit" maxlength="2" value="0" disabled>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>

                  <!-- right -->
                  <div class="col-md-8 cost_monitor">              
                      <div class="form-group">
                        <label>Final Price</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="final_price" maxlength="2" value="0" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>
                      <div class="from-group">
                        <label>Recive Profit</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="final_profit" maxlength="2" value="0" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Commission</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="commission" maxlength="2" value="0" disabled>
                          <span class="input-group-addon">THB</span>
                        </div>
                      </div>
                  </div>
                </div>
                <br>
            </div>
        </div>
    </section>
    <section class="col-lg-8 content">
        <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Project Detail</h3>
            <div class="box-tools">
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;display: none" id="pdf_generate">
                <i class="fa fa-download"></i> Generate PDF
            </button>
            </div>
        </div>
        <div class="box-body">
            <div class="row" id="prj_detail_box_empty">
              <div class="col-md-12" style="text-align:center">
                <BR>
                <p>Please select project</p>
              </div>
            </div>
            <div class="row" id="prj_detail_box" style="display: none">
              <div class="col-md-6">
                  <dl class="dl-horizontal">
                  <dt>Project</dt>
                  <dd id="detail_prj_title">....</dd>
                  <dt>Company</dt>
                  <dd id="detail_prj_company_name">....</dd>
                  <dt>Mobile</dt>
                  <dd id="detail_prj_mobile">....</dd>
                  <dt>Tel</dt>
                  <dd id="detail_prj_tel">....</dd>
                  <dt>Email</dt>
                  <dd id="detail_prj_email">....</dd>
                  <dt>Fax</dt>
                  <dd id="detail_prj_fax">....</dd>
                  <dt>Sale</dt>
                  <dd id="detail_emp_name">....</dd>
                  <dt>Quotation No.</dt>
                  <dd id="detail_prj_ref_no">yyyy/mm/dd no.</dd>
                  </dl> 
              </div><!-- col-md-6 -->
              <div class="col-md-6">
                  <dl class="dl-horizontal">
                  <dt>Customer</dt>
                  <dd id="detail_prj_customer_name">...</dd>
                  <dt>Type</dt>
                  <dd id="detail_prj_ctp">...</dd>
                  <dt>ประเภท</dt>
                  <dd id="detail_prj_wor">.... วันที่ ../../....</dd>
                  <dt>Status</dt>
                  <dd id="detail_prj_sta">....</dd>
                  <dt>ลงวันที่</dt>
                  <dd id="detail_prj_wot_date">../../....</dd>
                  <dt>Attactment</dt>
                  <dd id="detail_prj_attachment">
                      Riser, Floor Plan, Spec, .... 
                  </dd>
                  <dt>File</dt>
                  <dd><a href="" id="detail_prj_att_file"><span class="label label-primary" style="cursor:pointer;">Download</span></a></dd>
                  <dt>Location</dt>
                  <dd id="detail_location">....</dd>
                  </dl> 
              </div>
            </div>
          </div>
        </div>

        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
            <li><a href="#tab_5-5" data-toggle="tab">Scope of work</a></li>
            <li><a href="#tab_4-4" data-toggle="tab">Payment Condition</a></li>
            <li><a href="#tab_3-2" data-toggle="tab">Service</a></li>
            <li><a href="#tab_2-2" data-toggle="tab">Accessory</a></li>
            <li class="active"><a href="#tab_1-1" data-toggle="tab">Product</a></li>
            <li class="pull-left header"><i class="fa fa-shopping-cart"></i>Quotation</li>
        </ul>
        <div class="tab-content tab_empty">
          <br>
          <p align="center">Please select revised</p>
        </div>
        <div class="tab-content tab_content" style="display:none">
            <div class="tab-pane active" id="tab_1-1">
            <div class="box-header">
                <div class="col-lg-2 pull-right">
                <label> &nbsp </label>
                <button type="button" class="btn btn-block btn-primary" id="add_product_btn"><i class="fa fa-fw fa-plus"></i> Add</button>
                </div>
                <div class="col-lg-2 pull-right">
                <label> Quantity </label>
                <input type="number" class="form-control" step="1" min="1" id="product_qty" value="1">
                </div>
                <div class="col-lg-2 pull-right">
                <label> Model </label>
                <select class="form-control model_list " id="product_model">
                </select>
                </div>
                <div class="col-lg-2 pull-right">
                <label> Brand </label>
                <select class="form-control brand_list" id="product_brand">
                </select>
                </div>
                <div class="col-lg-2 pull-right">
                <label> System Type </label>
                <select class="form-control system_list" id="product_system_type">
                </select>
                </div>
                <div class="col-lg-2 pull-right">
                    <label> Product Set </label>
                    <button type="button" class="btn btn-block btn-primary" id="add_product_set_btn"><i class="fa fa-fw fa-plus"></i> Product Set</button>
                </div>
                <!-- /btn-group -->
            </div>
            <table id="hardware_table" class="table table-bordered table-striped data_table">
                <thead>
                <tr>
                <th>No.</th>
                <th>System</th>
                <th>Model</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                    <!-- hardware list -->
                </tbody>
            </table> 
            <div class="box-footer">
                <div class="col-lg-2 pull-right">
                <label> Discount (%)</label>
                <input type="number" class="form-control" step="1" min="1" id="discount" value="0">
                </div>
                <div class="col-lg-2 pull-right">
                <label> Vat (%) </label>
                <input type="number" class="form-control" step="1" min="1" id="vat" value="0">
                </div>
            </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2-2">
            <div class="box-header">
                <div class="col-lg-2 pull-right">
                <label> &nbsp </label>
                <button type="button" class="btn btn-block btn-primary" id="add_accessory_btn"><i class="fa fa-fw fa-plus"></i> Add</button>

                </div>
                <div class="col-lg-2 pull-right">
                <label> Quantity </label>
                <input type="number" class="form-control" step="1" min="1" id="acc_qty" value="1">
                </div>
                <div class="col-lg-2 pull-right">
                    <label> Model </label><br>
                    <select class="form-control model_list col-md-12" id="acc_model">
                        <!-- model list -->
                    </select>
                </div>
                <div class="col-lg-2 pull-right">
                <label> Brand </label>
                <select class="form-control brand_list">
                    <!-- brand list -->
                </select>
                </div>
                <div class="col-lg-2 pull-right">
                <label> System Type </label>
                <select class="form-control system_list">
                    <!-- product list -->
                </select>
                </div>
                <!-- /btn-group -->
            </div>
            <table id="accessory_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No.</th>
                <th>Model</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                    <!-- accessory list --> 
                </tbody>
            </table> 
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3-2">
            <div class="box-header">
                <div class="col-lg-2 pull-right">
                <label> &nbsp </label>
                <button type="button" class="btn btn-block btn-primary" id="add_services_btn"><i class="fa fa-fw fa-plus"></i> Add</button>
                </div>
                <div class="col-lg-2 pull-right">
                <label>Unit</label>
                <input type="text" class="form-control" step="1" min="1" id="service_unit">
                </div>
                <div class="col-lg-2 pull-right">
                <label>Price</label>
                <input type="text" class="form-control" step="1" min="1" id="service_price">
                </div>
                <div class="col-lg-2 pull-right" style="display:none" id="serivce_other_div">
                <label>Detail</label>
                <input type="text" class="form-control" step="1" min="1" id="service_other">
                </div>
                <div class="col-lg-4 pull-right">
                <label>Service</label>
                <select class="form-control service_list" id="service_list">
                    <!-- service list -->
                </select>
                </div>
                <!-- /btn-group -->
            </div>
            <table id="service_log_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No.</th>
                <th>Service</th>
                <th>Price</th>
                <th>Unit</th>
                <th>Amount</th>
                <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                    <!-- service log list -->
                </tbody>
            </table> 
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_4-4">
            <div class="box-header">
                <div class="col-lg-2 pull-right">
                <label> &nbsp </label>
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-success" id="add_condition"><i class="fa fa-fw fa-plus"></i> Add</button>
                </div>
                <div class="col-lg-4 pull-right condition_other_div" style="display: none">
                <label>Other</label>
                <input type="text" class="form-control" id="col_con_other">
                </div>
                <div class="col-lg-4 pull-right">
                <label>Condition</label>
                <select class="form-control condition_list" id="condition_list">
                    <!-- service list -->
                </select>
                </div>
                <!-- /btn-group -->
            </div>
            <table id="condition_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No.</th>
                <th>Condition</th>
                <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table> 
            </div>
            <div class="tab-pane" id="tab_5-5">
            <div class="box-header">
                <div class="col-lg-2 pull-right">
                <label> &nbsp </label>
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-success" id="add_sow_btn"><i class="fa fa-fw fa-plus"></i> Add</button>
                </div>
                <div class="col-lg-4 pull-right scope_of_work_div" style="display :none">
                <label>Detail</label>
                <input type="text" class="form-control" id="sol_sow_other">
                </div>
                <div class="col-lg-4 pull-right">
                <label>Work</label>
                <select class="work_list form-control" id="sol_sow_id">
                  <!-- work list -->
                </select>
                </div>
                <!-- /btn-group -->
            </div>
            <table id="sow_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>No.</th>
                  <th>Work</th>
                  <th>Operation</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- list scope of work -->
                </tbody>
            </table>  
            </div>
        </div>
        <div class="box-footer clearfix">
            <!--<button type="button" class="pull-right btn btn-success" id="sendEmail">
            <i class="fa fa-pencil-square-o"></i>
            Write
            </button>-->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
</section>
<!-- /.content -->

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
        <p>This item will be remove from system</p>
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


<!-- confirm delete -->
<div class="modal modal-danger fade" id="modal-acc-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>This item will be remove from system</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="confirm_acc_delete">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Brand</label>
          <select class="form-control brand_list" id="brand_edit">
          </select>
        </div>
        <div class="form-group">
          <label>Model</label><BR>
          <select class="form-control model_list" id="model_edit">
          </select>
        </div>
        <div class="form-group">
          <label>Quantity</label>
          <input type="number" step="1" min="1" class="form-control" placeholder="Enter ..." id="qty_edit">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_btn">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Accesory -->
<div class="modal fade" id="modal-acc-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Brand</label>
          <select class="form-control brand_list" id="acc_brand_edit">
          </select>
        </div>
        <div class="form-group">
          <label>Model</label><BR>
          <select class="form-control model_list " id="acc_model_edit">
          </select>
        </div>
        <div class="form-group">
          <label>Quantity</label>
          <input type="number" step="1" min="1" class="form-control" placeholder="Enter ..." id="acc_qty_edit">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="acc_update_btn">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Service -->
<div class="modal fade" id="modal-sel-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Service</label><BR>
          <select class="form-control service_list" id="sel_ser_id">
          </select>
        </div>
        <div class="form-group">
          <label>Value</label>
          <input type="number" step="1" min="1" class="form-control" placeholder="Enter ..." id="sel_ser_value">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sel_update_btn">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Scope of work -->
<div class="modal fade" id="modal-sow-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Scope of work</label>
          <select class="work_list form-control" id="sol_sow_id_edit">
            <!-- condition list -->
          </select>
        </div>

        <div class="form-group scope_of_work_div" id="scope_of_work_div_edit" style="display: none">
          <label>Detail</label>
          <input type="text" id="sol_sow_other_edit" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sow_update_btn" data-dismiss="modal">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Condition -->
<div class="modal fade" id="modal-con-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Condition</label>
          <select class="condition_list form-control" id="col_con_id">
            <!-- condition list -->
          </select>
        </div>

        <div class="form-group condition_other_div" id="condition_other_div_edit" style="display: none">
          <label>Detail</label>
          <input type="text" id="col_con_other_edit" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="con_update_btn" data-dismiss="modal">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Service -->
<div class="modal fade" id="modal-sow-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Condition</label>
          <input type="text" class="form-control" id="sow_value_edit">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sow_update_btn">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Status -->
<div class="modal fade" id="modal-sta-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Status</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Status</label>
          <select id="status_list" class="form-control">
            <!-- status list -->
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sta_update_btn" data-dismiss="modal">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Discount -->
<div class="modal fade" id="modal-discount">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Discount</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Formula</label>
          <input type="text" id="har_discount" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="discount_update_btn" data-dismiss="modal">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- confirm delete -->
<div class="modal modal-danger fade" id="modal-sel-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>This item will be remove from system</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="confirm_sel_delete">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- confirm delete -->
<div class="modal modal-danger fade" id="modal-con-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>This item will be remove from system</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="confirm_con_delete" data-dismiss="modal">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- confirm delete -->
<div class="modal modal-danger fade" id="modal-sow-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <p>This item will be remove from system</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline" id="confirm_sow_delete">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- item set modal -->
<div class="modal modal fade" id="modal-item-set">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Product Set</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>System</label>
          <select class="form-control system_list" id="isl_syt_id">
            <!-- system list -->
          <select>
        </div>
        <div class="form-group">
          <label>Product Set</label>
          <select id="product_set_list" class="form-control">
            <!-- product set list -->
          <select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-defulat pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confitm_add_product_set">Add Set</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="<?php echo base_url('/assert/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/assert/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('/assert/bower_components/select2/dist/css/select2.min.css'); ?>">

<?php
  echo script_tag("js/quatation.js");
?>