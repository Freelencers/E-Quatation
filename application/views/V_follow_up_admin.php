<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<style type="text/css">
	.text_in_row {
		overflow:hidden;
		white-space:nowrap;
		text-overflow:ellipsis;
		width:230px;
		height:1.2em;
	}
</style>
<div class="row">
<div class="col-md-5">
	<div class="box">
	  <div class="box-header">
		<h3 class="box-title">All Project</h3>
		<div class="col-md-5 pull-right">
          <div class="form-group input-group-sm pull-right">
            <!--<input type="text" id="prj_search" class="form-control" placeholder="Enter keyword"> -->
          </div>
        </div>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
		<table id="project_table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Quatation No.</th>
					<th>Name</th>
					<th>Status</th>
					<th>Operation</th>
				</tr>
			</thead>
			<tbody class="tbody_project">
				
			</tbody>
		</table>
	  </div>
	  <!-- /.box-body -->
	  <div class="box-footer">
		<div class="col-md-6" style="height: 30px">
			<ul class="pagination pagination-sm pull-left paging_project" style="margin-top:1px">
			  <!-- paging list -->
			</ul>
        </div>
	  </div>
	</div>
</div>
<div class="col-md-7">
	<div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li><a href="#tab_2-1" data-toggle="tab">Estimate</a></li>
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Support</a></li>
        <li class="pull-left header"><i class="fa fa-shopping-cart"></i>Follow up</li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
          <div class="box-header">
              <div class="col-sm-4 pull-right">
                <button class="btn btn-block btn-primary" id="enable_btn" data-toggle="modal" data-target="#modal-follow_up_add" disabled>
					<i class="fa fa-fw fa-plus"></i>New
				</button>
              </div>
            </div>
          <div class="box-body">
		  <div style="overflow:scroll;height:400px;width:100%;overflow:auto">
			<table width='100%' id="follow_up_table" class="table table-bordered table-striped dttable">
				<thead class="hscroll">
					 <tr>
						<th width='10%'>No.</th>
						<th width='30%'>Date</th>
						<th width='17%'>Success (%)</th>
						<th width='43%'>Message</th>
					</tr>
				</thead>
				<tbody class="tbody_follow_up scrollit">
					<tr>
						<td colspan='4'><center>No Data</center></td>
					</tr>
				</tbody>
			</table>
          </div>
          </div>
		  <div class="box-footer">
			<div class="col-md-6" style="height: 30px">
				<ul class="pagination pagination-sm pull-left paging_follow_up" style="margin-top:1px">
				  <!-- paging list -->
				</ul>
			</div>
		  </div>
        </div>
      </div>    
    </div>
</div>
</div>
<?php
  $now_date = date('Y-m-d');
?>
<!-- Modal -->
<div class="modal fade" id="modal-follow_up_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Follow Up</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
            <!-- Date -->
            <div class="form-group">
				<div class="col-xs-4">
					<label>Date :</label>
						<div class="input-group date">
						<input type="text" class="form-control pull-right" value="<?php echo $now_date;?>" name="fol_date" id="fol_date" disabled> 
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
					</div>
				</div>
				<!-- /.input group -->
            </div>
		</div>
		<div class="box-body">
            <div class="form-group">
				<div class="col-xs-4">
					<label>Success (%) :</label>
						<div class="input-group">
						<input type="number" class="form-control pull-right" value="" name="fol_success" id="fol_success"> 
						<div class="input-group-addon">
							%
						</div>
					</div>
				</div>
				<!-- /.input group -->
            </div>
		</div>
		<div class="box-body">
            <div class="form-group">
				<div class="col-xs-12">
					<label>Message :</label>
					<textarea class="form-control" rows="3" name="fol_msg" id="fol_msg" placeholder="Enter ..."></textarea>
				</div>
			</div>
				<!-- /.input group -->
			<input type="hidden" id="project_id"> </p>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" id="btn_insert_follow">Save changes</button><!--id="btn_insert_follow"-->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
  echo script_tag("js/follow_up.js");
?>