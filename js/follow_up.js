	load_project(10, 0,"");
	function load_project(limit=10, page=0, search=""){
		console.log("start");
		var json = {
			"limit" : "10",
			"page" : page,
			"search" : search
		};
		$.post("C_follow_up/api_get_project", json, function(data){
			var NowDate = data.nowDate;
			index = 0;
			var day = 0;
			var table = "";
			for(var i=0;i< data.project.length;i++){
				if(data.project[i].max_date == null){
					day = 16;
				}else{
					day = jsDateDiff(data.project[i].max_date,NowDate);
				}
				if(data.project.length == 0){

					table = "<tr><td colspan='4' align='center'> No data </td></tr>";
				}else{
					table += project_row(data.project[i].prj_title, data.project[i].wor_name, data.project[i].prj_ref_no , data.project[i].prj_id , day);
				}
			}
			$("#project_table tbody").html(table).fadeIn(100);
		}, "json");
	}
	
	load_paging();
	localStorage.setItem("page", 1);
	localStorage.setItem("prj_search", "");
	function load_paging(page=0, search=""){
		var json = {
			"limit" : "",
			"page" : "",
			"search" : search
		};
		$.post("C_follow_up/api_get_project", json, function(data){
			var btn = "";
			var count = Math.round(data.project.length / 10);
			// console.log(count + " " + data.project.length);
			// check rang
			var current_page = parseInt(localStorage.getItem("page"));
			var start = current_page - 3;
			var stop = current_page + 3;
			var display = "";

			// avtive btn
			var active = "";
			// clear 
			$(".paging_project").html("");
			for(i=0;i<count;i++){

				if((i + 1) <= stop && (i + 1) >= start){

					display = "block";
				}else{
					
					display = "none";
				}

				// active current page
				if((i+1) == page){

					active = "active";
				}else{

					active = "";
				}
				btn += "<li class='" + active + "' style='cursor: pointer;'><a class='page_btn' style='display: " + display + "' page='" + (i + 1) + "'>"+ (i + 1) + "</a></li>";
			}
			$(".paging_project").append(btn);
		},"json");
	}

	// action click page
	$(document).on("click", ".page_btn", function(){

		var current_page = $(this).attr("page");
		var search = localStorage.getItem("prj_search");
		
		// $("#tbody_project").html("");
		// Set page to global
		localStorage.setItem("page", current_page);
		
		load_project(10, current_page - 1, search);
		load_paging(current_page, search);
		$(this).closest("li").addClass("active");
	});

	function project_row(project_name, status, quatation_no , data_id , day){
        // console.log("ADD ROW");
		var alert_date = "";
		 if(day > 15){
			 alert_date = "<i class='fa fa-warning' style='cursor:pointer;color:red;'></i>";
		}
		$("#tbody_follow_up").val("");
		$("#tbody_project").val("");
        var table = "";
        table += "<tr>";
		table += "<td><center>"+alert_date+"</center></td>"
        table += "<td id='" + data_id + "_field_quatation_no'><center>" + quatation_no + "</center></td>";
        table += "<td id='" + data_id + "_field_name'>" + project_name + "</td>";
		if(status == 'ปกติ'){
			table += "<td id='" + data_id + "_field_status'><center><span class='label label-primary'>" + status + "</span></center></td>";
		}
		else if(status == 'ได้งานแล้ว'){
			table += "<td id='" + data_id + "_field_status'><center><span class='label label-success'>" + status + "</span></center></td>";
		}
		else if(status == 'ปกติด่วน'){
			table += "<td id='" + data_id + "_field_status'><center><span class='label label-warning'>" + status + "</span></center></td>";
		}
		else if(status == 'ได้งานแล้วด่วน'){
			table += "<td id='" + data_id + "_field_status'><center><span class='label label-danger'>" + status + "</span></center></td>";
		}else{
			table += "<td id='" + data_id + "_field_status'><center><span class='label label-primary'>" + status + "</span></center></td>";
		}
		//success, danger, warning,Info
        table += "<td id='" + data_id + "_field_prj_id' >";
        table += "  <center><i class='fa fa-search' style='cursor:pointer;' onclick='follow_up_detail("+data_id+")'></i></center>";
        table += "</td>";
        table += "</tr>";
        return table;
    }
	function jsDateDiff(strDate1,strDate2){
		var theDate1 = Date.parse(strDate1)/1000;
		var theDate2 = Date.parse(strDate2)/1000;
		var diff=(theDate2-theDate1)/(60*60*24);
		return diff;
	}
	
	//-----------------------------FOLLOW UP ----------------------------------------------

	// Set type of follow up
	$(".add_follow_up").click(function(){
		var fol_type = $(this).attr("fol_type");
		localStorage.setItem("fol_type", fol_type);
	});
	
	$("#btn_insert_follow").click(function(){
        var fol_type = localStorage.getItem("fol_type");
        var fol_date = $("#fol_date").val();
        var fol_success = $("#fol_success").val();
        var fol_msg = $("#fol_msg").val();
        var fol_prj_id = localStorage.getItem("fol_prj_id");
        var fol_emp_id = $("#fol_emp_id").val();
		var fol_id = $("#fol_id").val();

		var json = {
			"fol_date" : fol_date,
			"fol_success" : fol_success,
			"fol_msg" : fol_msg,
			"fol_prj_id" : fol_prj_id,
			"fol_type" : fol_type
		}

		//inser follow_up
		$.post("C_follow_up/api_insert_follow_up", json, function(data){

			console.log("LOAD");
			follow_up_detail(json.fol_prj_id);

			// Clear form
			$("#fol_success").val("");
			$("#fol_msg").val("");
			$("#fol_emp_id").val("");
			$("#fol_id").val("");
		}, "json");
		
	});

	function follow_up_detail(prj_id=""){

		// Save to menory
		localStorage.setItem("fol_prj_id", prj_id);
		$(".add_follow_up").prop("disabled", false);
		var table_estimate = "";
		var index_estimate = 1;
		var table_support = "";
		var index_support = 1;

		var json = {
			"prj_id" : prj_id,
			"limit" : "10",
			"page" : "0"
		}
		
		$.post("C_follow_up/api_get_follow_up", json, function(data){
			for(var i=0;i< data.follow_up.length;i++){
					if(data.follow_up[i].fol_type == 0){

						table_support += "<tr>";
						table_support += "<td><center>"+ index_support +"</center></td>"
						table_support += "<td><center>" + data.follow_up[i].fol_date + "</center></td>";
						table_support += "<td><center>" + data.follow_up[i].fol_success + "%</center></td>";
						table_support += "<td><center>" + data.follow_up[i].emp_first_name + "</center></td>";
						table_support += "<td><p class='text_in_row'>" + data.follow_up[i].fol_msg + "</p></td>";
						table_support += "</tr>";
						index_support++;

					}else{

						table_estimate += "<tr>";
						table_estimate += "<td><center>" + index_estimate + "</center></td>"
						table_estimate += "<td><center>" + data.follow_up[i].fol_date + "</center></td>";
						table_estimate += "<td><center>" + data.follow_up[i].fol_success + "%</center></td>";
						table_estimate += "<td><center>" + data.follow_up[i].emp_first_name + "</center></td>";
						table_estimate += "<td><p class='text_in_row'>" + data.follow_up[i].fol_msg + "</p></td>";
						table_estimate += "</tr>";
						index_estimate++;
					}
			}

			// Check no data
			if(table_estimate == ""){
				table_estimate = "<tr><td colspan='5' class='text-center'> No data</td></tr>";
			}

			if(table_support == ""){
				table_support = "<tr><td colspan='5' class='text-center'> No data</td></tr>";
			}

			$("#estimate_table tbody").html(table_estimate);
			$("#support_table tbody").html(table_support);

		},"json");
		// load_paging_follow();
	}