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
<link rel="stylesheet" href="<?php echo base_url('/assert/plugins/iCheck/all.css'); ?>">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url('/assert/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url('/assert/bower_components/select2/dist/css/select2.min.css'); ?>">

<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="box-title">Add New Project</h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Project</label>
              <input type="text" class="form-control" id="prj_title" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Company</label>
              <input type="email" class="form-control" id="prj_company" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Contact</label>
              <input type="email" class="form-control" id="prj_contact" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Mobile</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-mobile"></i>
                </div>
                <input type="text" class="form-control" id="prj_mobile" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tel</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" class="form-control" id="prj_tel" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="prj_email" placeholder="Enter ...">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Fax</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-fax"></i>
                </div>
                <input type="text" class="form-control" id="prj_fax" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Sale</label>
              <select class="form-control" id="prj_emp_id">
                <!-- list of saleman -->
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Customer</label>
              <div class="row">
                <div class="col-sm-4">
                  <select class="form-control" id="prj_regular_customer">
                    <option value = "0">เก่า</option>
                    <option value = "1">ใหม่</option>
                  </select>
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="prj_customer_name" placeholder="Enter ...">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label> Customer Type</label>
              <select class="form-control" id="prj_ctp_id">
                <!-- list of customer type -->
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Type</label>
              <select class="form-control" id="prj_plt_id">
                <!-- place type list -->
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">ประเภท</label>
              <select class="form-control" id="prj_wor_id">
                <!-- work type list -->
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleInputEmail1">วันที่</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right datepicker" id="prj_wot_date">
              </div>
              <!-- /.input group -->
            </div>
            

            <div class="form-group">
              <label for="exampleInputEmail1">Status</label>
              <select class="form-control" id="prj_sta_id">
                <!-- status lsit -->
              </select>
            </div>
            <div class="form-group">
              <label> Attachment</label>
              <div class="row" id="attachment_blog">

              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="file" id="prj_att_file">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Location</label>
              <input type="text" class="form-control" id="prj_att_location">
            </div>
          </div> 
        </div>

        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped" id="system_table">
              <thead>
                <th></th>
                <th class="col-xs-2">System Type</th>
                <th class="col-xs-10">Brand</th>
              </thead>
              <tbody>
                <?php
                  $data_num = $syl_num->num_rows();
                  for($i=0;$i<$system_num;$i++){
                    //echo json_encode($brand_log[$i])."<BR>";
                ?>
                <tr
                  <?php
                    if($i > ($data_num - 1)){
                      
                      if($data_num != -1 && $i != 0){

                        echo " style='display:none;'"; 
                      }
                    }
                    
                  ?>
                >
                  <td>
                    <i class="fa fa-fw fa-plus" style="color: green; cursor: pointer;" id="add_new_row" index="<?= $i ?>"></i>
                  </td>
                  <td>
                    <select class="form-control system_type" index="<?= $i ?>">
                    <!-- system type list -->
                    <?php
                      foreach($system_type as $row){
                        echo "<option value='$row->syt_id'>$row->syt_name</option>";
                      }
                    ?>
                    </select> 
                  </td>
                  <td>
                    <select class="form-control select2 brand" index="<?= $i ?>" id="brand_<?= $i ?>" multiple="multiple" data-placeholder="Select Brand" style="width: 100%;">
                      <!-- brand list-->
                      <?php
                        //echo $syl_num_result->
                        foreach($brand as $row){

                          foreach($brand_log[$i] as $row_j){ 
                            if($row_j == $row->bra_id){
                              $selected = "selected";
                              break;
                            }else{
                              $selected = "";
                            }
                          }
                          echo "<option value='$row->bra_id' $selected>$row->bra_name</option>";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="reset_btn">Reset</button>
        <button type="button" class="btn btn-primary pull-right" id="save_btn">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('/assert/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/iCheck/icheck.min.js'); ?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('/assert/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('/assert/plugins/iCheck/icheck.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/assert/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('/assert/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<script>

  var prj_id = '<?= $prj_id ?>';
</script>
<?php
    echo script_tag("js/update_project.js");
?>
