<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<div class="row">
  <div class="col-md-2">
	<?php
		echo form_open('/C_report_all_project/');
	?>
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Search</h3>
        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="col-sm-2 pull-right">
        </div>
      </div>
      <div class="box-body">
        <div class="box-body">
         <div class="form-group">
            <label>Month</label>
            <select class="form-control" name="prj_month" id="fol_month">
				<?php 
				$date_month = date("m");
				foreach($get_month->result() as $month) {
				?>
					<option value="<?php echo substr($month->prj_wot_date,5,2); ?>" <?php if($month1 == substr($month->prj_wot_date,5,2)){echo 'selected="selected"';} ?> >
						<?php echo date("F", strtotime($month->prj_wot_date)); ?>
					</option>
				<?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Year</label>
            <select class="form-control" name="prj_year" id="fol_year">
				<?php 
				$date_year = date("Y");
				foreach($get_year->result() as $year) {
				?>
					<option value="<?php echo substr($year->prj_wot_date,0,4); ?>" <?php if(substr($year->prj_wot_date,0,4) == $nyear){echo 'selected="selected"';} ?> >
						<?php echo substr($year->prj_wot_date,0,4); ?>
					</option>
				<?php } ?>
            </select>
          </div>
          <br>

        </div>
      </div>
      <div class="box-footer">
        <input type="submit" class="btn btn-primary pull-right" id="btn_search" value="Search">
      </div>
    </div>
	<?php
		// echo form_close();
	?>
  </div>
  <div class="col-md-10">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">All Project chart</h3>
        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="col-sm-2 pull-right">
        </div>
      </div>
      <div class="box-body">
			<?php 
			if($report->num_rows() <= 0 ){
				echo "<div style='min-width: 310px; height: 400px; margin: 0 auto'><br><br><br><br><br><br><center><h2>No Data</h2></center></div> ";
			}else{
			?>
			<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			<?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-2">
</div>
	<div class="col-md-10">
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">All Project warning log</h3>
			<div class="box-tools">
			</div>
		</div>
		<div class="box-header">
			<div class="col-sm-2 pull-right">
			</div>
		</div>
		<p id="test"></p>
		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
				<th>No.</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th style="width:19%">Number of Project</th>
				<th>Sum Price</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$last_date = "";
				$sum = 0;
				$sum1 = 0;
				$index = 1;
				$sum_price = 0;
				foreach($em->result() as $emp){
				?>
						<tr>
							<td><center><?php echo $index++; ?></center></td>
							<td><?php echo $emp->emp_first_name; ?></td>
							<td><?php echo $emp->emp_last_name; ?></td>
				<?php
						foreach($fl->result() as $re){
							if($emp->emp_id == $re->prj_emp_id){
								$sum +=count($re->prj_emp_id);
								if ($re->prj_wot_date > $last_date) {
									$last_date = $re->prj_wot_date;
								}
								// $sum_price = $emp->sPrice;
								$sum_price += $re->prj_price;
							}
						}
				?>			
							
							<td><center><?php echo $sum-$sum1; ?></center></td>
							<td><center><?php echo $sum_price; ?></center></td>
						</tr>
				<?php
					$sum1 = $sum;
					$last_date = "";
					$sum_price = 0;
				}
				?>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</div>
<!-- Hight chart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<?php
	// echo script_tag("js/report_follow_up.js");
?>

<script>
$(function () {
	<?php
	if($report->num_rows() > 0 ){
	?>
	var chart = Highcharts.chart('container', {
        chart:{ type: 'column' },
        credits: false,
        title: { text: '' },
        legend: {enabled: false},
        plotOptions: {
            column:{
                dataLabels: {
                    enabled: true,
                    color: 'white',
                    style: {
                        textShadow: '0 0 3px black, 0 0 3px black',
                        fontWeight: 'normal',
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                },
                grouping: false
            }
        },
		xAxis: {
		 type: 'category',
		 labels: {
		  rotation: -45,
		  style: {
			  fontSize: '10px',
			  fontFamily: 'Verdana, sans-serif'
		  }
		 }
		},
		yAxis: {
		 min: 0,
		 title: {
		  text: 'จำนวนเงิน (บาท)'
		 }
		},
		legend: {
		 enabled: false
		},
		tooltip: {
		 pointFormat: '<b>{point.y:f} Bath</b>'
		},
		series: [
			<?php 
				foreach($report->result() as $row ){
					if($row->sPrice != 0){
				?>
				{
					  name: '<?php echo $row->emp_first_name; ?>',
					  data: [
						['<?php echo $row->emp_first_name; ?>', <?php echo $row->sPrice; ?>],
						]
				},
				<?php 
					}
				}
			?>
		]
        // series: initialSeriesFromJSON //initial data
    });
	<?php 
	}
	?>
});
</script>