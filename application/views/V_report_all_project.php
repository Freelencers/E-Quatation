<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<div class="row">
  <div class="col-md-2">
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
            <select class="form-control" name="fol_month" id="fol_month">
							<option value='' selected>All Month</option>
							<option value='1'>Period 01</option>
							<option value='2'>Period 02</option>
							<option value='3'>Period 03</option>
							<option value='4'>Period 04</option>
            </select>
          </div>
          <div class="form-group">
            <label>Year</label>
            <select class="form-control" name="fol_year" id="fol_year">
				<option value='' selected>All Year</option>

            </select>
          </div>
          <br>

        </div>
      </div>
      <div class="box-footer">
        <input type="submit" class="btn btn-primary pull-right" id="btn_search" value="Search">
      </div>
    </div>
  </div>
  <div class="col-md-10">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Amount report</h3>
        <div class="box-tools">
        </div>
      </div>
      <div class="box-header">
        <div class="col-sm-2 pull-right">
        </div>
      </div>
      <div class="box-body">
	  	<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>	
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
			<h3 class="box-title">Amount report</h3>
			<div class="box-tools">
			</div>
		</div>
		<div class="box-header">
			<div class="col-sm-2 pull-right">
			</div>
		</div>
		<p id="test"></p>
		<div class="box-body">
			<table id="data_table" class="table table-bordered table-striped" >
				<thead>
					<tr>
					<th>No.</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th style="width:19%">Amount</th>
					</tr>
				</thead>
				<tbody>
			
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
// dropdown list year
var d = new Date();
var n = d.getFullYear();
option = "";
for(i=0;i<5;i++){
	option += "<option value='" + (n-i) + "'>" + (n-i) + "</option>"; 
}
$("#fol_year").append(option);

$("#btn_search").click(function(){
	var year = $("#fol_year").val();
	var month = $("#fol_month").val();
	load_data(month, year);
})

load_data();
function load_data(period=0, year=0){
	var json = {
		"period" : period,
		"year" : year
	}
	$.post("C_report_all_project/api_income_report", json, function(resp){
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
				text: 'ยอดขาย (บาท)'
				}
				},
				legend: {
				enabled: false
				},
				tooltip: {
				pointFormat: '<b>{point.y:f} ครั้ง</b>'
				},
				series: [
					{
						name: 'test',
						data: resp.graph
					}
				]
				// series: initialSeriesFromJSON //initial data
			});

		var table = "";
		for(i=0;i<resp.table.length;i++){
			
			table += "<tr>";
			table += "	<td>" + (i+1) + "</td>";
			table += "	<td>" + resp.table[i][0] + "</td>";
			table += "	<td>" + resp.table[i][1] + "</td>";
			table += "	<td>" + resp.table[i][2] + "</td>";
			table += "</tr>";
			console.log(table);
		}
		$("#data_table tbody").html(table);
	}, "json");
}


</script>