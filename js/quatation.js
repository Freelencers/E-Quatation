
//############################
// On load
//############################
$('.select2').select2();


//##########################
// Project table
//#########################
load_project(5, 0,"");
function load_project(limit=5, page=1, search=""){
	
	var json = {
		"limit" : "5",
		"page" : page,
		"search" : search
	};
	//$("#project_list tbody").html("");
	$.post("C_project/api_get_project", json, function(data){

	    var table = "";
	    if(data.project.length == 0){

	        table = "<tr><td colspan='4' align='center'> No data </td></tr>";
	    }else{
	        for(i=0;i<data.project.length;i++){
	            table += "<tr>";
	            table += "  <td>" + data.project[i].prj_ref_no + "</td>";
	            table += "  <td>" + data.project[i].prj_title + "</td>";
	            table += "  <td> <span class='label label-primary'>" + data.project[i].sta_name + "</span> </td>";
	            table += "  <td> <i class='fa fa-pencil-square-o get_info_prj' style='cursor:pointer;' prj_id='" + data.project[i].prj_id + "'></i> </td>";
	            table += "</tr>";
	        }
	    }
	    $("#project_list tbody").html(table).fadeIn(100);
	},'json');
}

// show pagination
load_paging();
localStorage.setItem("page", 1);
localStorage.setItem("prj_search", "");

function load_paging(page=0, search=""){
	var json = {
		"limit" : "",
		"page" : "",
		"search" : search
	};
    $.post("C_project/api_get_project", json, function(data){
        var btn = "";
        var count = Math.round(data.project.length / 5);
        console.log(count + " " + data.project.length);
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

    // Set page to global
    localStorage.setItem("page", current_page);
    
    load_project(5, current_page - 1, search);
    load_paging(current_page, search);
    $(this).closest("li").addClass("active");
});

// Search
$("#prj_search").change(function(){
    
    var search = $(this).val();
    localStorage.setItem("prj_search", search);
    localStorage.setItem("page", 1);
    load_project(5, 0, search);
    load_paging(1, search);
});

//##########################

// Load scope of work
$.post("C_scope_of_work/api_get_scope_of_work", "", function(data){
    
   var option = ""; 
    for(var i=0;i< data.length;i++){

        if(data[i].sow_id != 99){
            var option = new Option(data[i].sow_value, data[i].sow_id);
            $(".work_list").append(option);
        }
    }
    option = new Option("อื่น ๆ", 99);
    $(".work_list").append(option);

}, "json");

// Load service
$.post("C_services/api_get_services", "", function(data){
   
    var option = "";
    for(var i=0;i< data.length;i++){

        if(data[i].ser_id != 99){
            option = new Option(data[i].ser_name, data[i].ser_id);
            $(".service_list").append(option);
        }
    }
    option = new Option("อื่น ๆ", 99);
    $(".service_list").append(option);

}, "json");

// Load condition
$.post("C_condition/api_get_condition", "", function(data){
   
    console.log("condition");
    for(var i=0;i< data.length;i++){

        var option = "";
        if(data[i].ser_id != 99){
            option = new Option(data[i].con_value, data[i].con_id);
            $(".condition_list").append(option);
        }
    }
    option = new Option("อื่น ๆ", 99);
    $(".condition_list").append(option);

}, "json");


// Load brand type 
$.post("C_brand/api_get_brand", "", function(data){
    for(var i=0;i<data.length;i++){

        $(".brand_list").append(new Option(data[i].bra_name, data[i].bra_id));
    }

    // Load model default
    $(".model_list").html("");
    var json = {
        'pro_bra_id' : $(".brand_list").val(),
        'limit' : 0,
        'page' : 0,
        'search' : ""
    };
    $.post("C_product/api_get_product_by_brand_id", json, function(data){

        var option = "";
        for(var i=0;i< data.length;i++){

            option += "<option value='" + data[i].pro_id + "'>" + data[i].pro_model + "</option>";
        }
        $(".model_list").html(option);
    }, "json");

}, "json");

// Produc filter
$(".brand_list").change(function(){

    $(".model_list").html("");
    var json = {
        'pro_bra_id' : $(this).val(),
        'limit' : 0,
        'page' : 0,
        'search' : ""
    };
    $.post("C_product/api_get_product_by_brand_id", json, function(data){

        var option = "";
        for(var i=0;i< data.length;i++){

            option += "<option value='" + data[i].pro_id + "'>" + data[i].pro_model + "</option>";
        }
        $(".model_list").html(option);

    }, "json");
});


// Load product set 
$.post("C_item_set/api_get_item_set", "", function(data){
    
    //Pace.restart();
    for(var i=0;i< data.length;i++){

        $("#product_set_list").append(new Option(data[i].its_name, data[i].its_id));
    }
}, "json");

//####################
// Project Detail
//####################
$(document).on("click", ".get_info_prj", function(){
    var json = {
        "prj_id" : $(this).attr("prj_id")
    };

    // local storage
    //localStorage.setItem("prj_id", json.prj_id);

    // Get detail of project
    $.post("C_project/api_get_project_by_id", json, function(data){

        $("#detail_prj_title").text(data.project[0].prj_title);
        $("#detail_prj_company_name").text(data.project[0].prj_company);
        $("#detail_prj_mobile").text(data.project[0].prj_mobile);
        $("#detail_prj_tel").text(data.project[0].prj_tel);
        $("#detail_prj_email").text(data.project[0].prj_email);
        $("#detail_prj_fax").text(data.project[0].prj_fax);
        $("#detail_emp_name").text(data.project[0].emp_first_name + " " + data.project[0].emp_last_name);
        $("#detail_prj_ref_no").text(data.project[0].prj_ref_no);

        $("#detail_prj_customer_name").text(data.project[0].prj_customer_name);
        $("#detail_prj_ctp").text(data.project[0].ctp_name);
        $("#detail_prj_wor").text(data.project[0].wor_name);
        $("#detail_prj_sta").text(data.project[0].sta_name);
        $("#detail_prj_wot_date").text(data.project[0].prj_wot_date);
        $("#detail_location").text(data.project[0].prj_att_location);
       
        if(data.project[0].prj_att_file != ""){

            $("#detail_prj_att_file").show();
            $("#detail_prj_att_file").attr("href", "../assert/project/" + data.project[0].prj_att_file);
        }else{

            $("#detail_prj_att_file").hide();
        }

        //Show 
        $("#prj_detail_box_empty").hide();
        $("#prj_detail_box").show();
    }, "json");

    // Get attachment list
    $.post("C_attachment_log/api_get_attachment_log_by_prj_id", json, function(data){

       atl = "";
       for(i=0;i<data.attachment_log.length;i++){
           atl += data.attachment_log[i].att_name;

           if(i < data.attachment_log.length - 1){
                atl += ", ";
           }
       }

        $("#detail_prj_attachment").text(atl);

    }, "json");

    //####################
    // Revise History
    //####################
    localStorage.setItem("revised_prj_id", json.prj_id);
    load_revised(json.prj_id);

});

function load_revised(prj_id){
    console.log("LOAD REVISED");
    var json = {
        "prj_id" : prj_id
    };
    //####################
    // Revise History
    //####################
    $.post("C_project/api_get_revise", json, function(data){
        
                var table = "";
                // Clear table
                $("#revise_history tbody").html("");
        
                // show no data
                if(data.revise_history.length == 0){
        
                    table = "<tr><td colspan='5' text-align='center'> No data </td></tr>";
                    $("#revise_history").append(table);
                }
        
                // Add data to table
                for(i=0;i<data.revise_history.length;i++){
                    var table = "";
                    table += "<tr>";
                    table += "  <td>" + (i+1) + "</td>";
                    table += "  <td>" + data.revise_history[i].prj_wot_date, + "</td>";
                    table += "  <td> <span class='label label-primary status' style='cursor: pointer;' parent='" + prj_id + "' prj_id='" + data.revise_history[i].prj_id + "'>" + data.revise_history[i].sta_name, + "</span></td>";
                    table += "  <td>" + check_null(data.revise_history[i].prj_version) + "</td>";
                    table += "  <td> ";
                    table += "      <i class='fa fa-fw fa-pencil-square-o get_quatation_prj' title ='Change detail' prj_id='" + data.revise_history[i].prj_id + "' style='cursor:pointer;'></i>";
                    table += "      <i class='fa fa-fw fa-files-o duplicate' title='Duplicate this version' prj_id='" + data.revise_history[i].prj_id + "' style='cursor:pointer;'></i>";
                    table += "  </td> ";
                    table += "</tr>";
                    $("#revise_history").append(table);
                }
        
            }, "json");
}

$(document).on("click", ".duplicate", function(){
    
    var json = {
        "prj_id" : $(this).attr("prj_id")
    };

    if(confirm("Are you want to create new revise?")){
        $.post("C_project/api_create_new_revised", json, function(data){
            console.log(data);
            console.log("DATA : " + json.prj_id);
            var prj_id = localStorage.getItem("revised_prj_id");
            load_revised(prj_id);
        },"json");
    }
});

function load_hardware(json){
    // Hardware
    $.post("C_hardware/api_get_hardware_by_project", json, function(data){
        
        var table = "";
        // Add data to table
        $("#hardware_table tbody").html("");
        var table = "";

        if(data.hardware.length == 0){

            console.log("NO DATA");
            table += "<tr><td colspan='10' align='center'> No data </td></tr>";
        }else{
            var har_id = "";
            limit = data.hardware.length;
            for(i=0;i<limit;i++){
                console.log("LOOP");
                har_id = data.hardware[i].har_id;
                table += "<tr id='row_" + har_id + "'>";
                table += "  <td>" + (i+1) + "</td>";
                table += "  <td>" + data.hardware[i].syt_name + "</td>";
                table += "  <td>" + data.hardware[i].pro_model + "</td>";
                table += "  <td>" + data.hardware[i].pro_description + "</td>";
                table += "  <td>" + data.hardware[i].har_qty + "</td>";
                table += "  <td>" + data.hardware[i].uni_name + "</td>";
                table += "  <td>" + data.hardware[i].pro_price + "</td>";
                table += "  <td>" + data.hardware[i].har_discount + "</td>";
                table += "  <td>" + layor_discount(data.hardware[i].amount, data.hardware[i].har_discount) + "</td>";
                table += '  <td>';
                table += '      <i class="fa fa-fw fa-pencil-square-o edit" style="cursor:pointer" har_id="' + har_id + '" ></i>';
                table += '      <i class="fa fa-fw fa-trash-o delete" style="cursor:pointer; color:red" har_id="' + har_id + '"></i>';
                table += '      <i class="fa fa-fw fa-tags discount" style="cursor:pointer; color:blue" har_id="' + har_id + '" section="hardware"></i>';
                table += '  </td>';
                table += "</tr>";
            }
        }
        $("#hardware_table tbody").append(table);
    },"json");
}

function load_accessory(json){
    $.post("C_accessory/api_get_accessory_by_project", json, function(data){
        
        var table = ""
        // Add data to table
        $("#accessory_table tbody").html("");
        var table = "";
        if(data.accessory.length == 0){

            console.log("NO DATA");
            table += "<tr><td colspan='9' align='center'> No data </td></tr>";
        }else{
            var acc_id = 0;
            for(i=0;i<data.accessory.length;i++){
                acc_id = data.accessory[i].acc_id;
                table += "<tr id='acc_row_" + acc_id + "'>";
                table += "  <td>" + (i+1) + "</td>";
                table += "  <td>" + data.accessory[i].pro_model + "</td>";
                table += "  <td>" + data.accessory[i].pro_description + "</td>";
                table += "  <td>" + data.accessory[i].acc_qty + "</td>";
                table += "  <td>" + data.accessory[i].uni_name + "</td>";
                table += "  <td>" + data.accessory[i].pro_price + "</td>";
                table += "  <td>" + data.accessory[i].acc_discount + "</td>";
                table += "  <td>" + layor_discount(data.accessory[i].amount, data.accessory[i].acc_discount) + "</td>";
                table += '  <td>';
                table += '      <i class="fa fa-fw fa-pencil-square-o acc_edit" style="cursor:pointer" acc_id="' + acc_id + '" ></i>';
                table += '      <i class="fa fa-fw fa-trash-o acc_delete" style="cursor:pointer; color:red"  acc_id="' + acc_id + '"></i>';
                table += '      <i class="fa fa-fw fa-tags discount" style="cursor:pointer; color:blue" acc_id="' + acc_id + '" section="accessory"></i>';
                table += '  </td>';
                table += "</tr>";
            }
        }
        $("#accessory_table tbody").append(table);
    },"json");
}

function load_service(json){
    $.post("C_service_log/api_get_service_log_by_prj_id", json, function(data){
        
        var table = ""
        // Add data to table
        $("#service_log_table tbody").html("");
        var table = "";
        if(data.length == 0){

            console.log("NO DATA");
            table += "<tr><td colspan='6' align='center'> No data </td></tr>";
        }else{
            for(i=0;i<data.length;i++){

                table += "<tr id='sel_row_" + data[i].sel_id + "'>";
                table += "  <td>" + (i+1) + "</td>";

                // check if other type
                console.log("SER ID : " + data[i].sel_ser_id);
                if(data[i].sel_ser_id == 99){
                
                    service_value = data[i].sel_ser_other;
                }else{
                
                    service_value = data[i].ser_name;
                }

                table += "  <td>" + service_value + "</td>";
                table += "  <td>" + data[i].sel_ser_price + "</td>";
                table += "  <td>" + data[i].sel_ser_unit + "</td>";
                table += "  <td>" + (data[i].sel_ser_unit * data[i].sel_ser_price) + "</td>";
                table += '  <td>';
                table += '      <i class="fa fa-fw fa-pencil-square-o sel_edit" style="cursor:pointer" sel_id="' + data[i].sel_id + '" ></i>';
                table += '      <i class="fa fa-fw fa-trash-o sel_delete" style="cursor:pointer; color:red"  sel_id="' + data[i].sel_id + '"></i>';
                table += '  </td>';
                table += "</tr>";
            }
        }
        $("#service_log_table tbody").append(table);
    },"json");
}

function load_condition(json){
    $.post("C_condition_log/api_get_condition_log_by_prj_id", json, function(data){
        
        var table = ""
        // Add data to table
        $("#condition_table tbody").html("");
        var table = "";
        if(data.length == 0){

            console.log("NO DATA");
            table += "<tr><td colspan='3' align='center'> No data </td></tr>";
        }else{
            for(i=0;i<data.length;i++){

                table += "<tr id='con_row_" + data[i].con_id + "'>";
                table += "  <td>" + (i+1) + "</td>";
                if(data[i].con_id == 99){
                    condition = data[i].col_con_other;
                }else{
                    condition = data[i].con_value;
                }
                table += "  <td>" + condition + "</td>";
                table += '  <td>';
                table += '      <i class="fa fa-fw fa-pencil-square-o con_edit" style="cursor:pointer" con_id="' + data[i].col_id + '" ></i>';
                table += '      <i class="fa fa-fw fa-trash-o con_delete" style="cursor:pointer; color:red"  con_id="' + data[i].col_id + '"></i>';
                table += '  </td>';
                table += "</tr>";
            }
        }
        $("#condition_table tbody").append(table);
    },"json");
}

function load_scope_of_work(json){
    $.post("C_scope_of_work_log/api_get_scope_of_work_log_by_prj_id", json, function(data){
        
        var table = "";
        var value = "";
        // Add data to table
        $("#sow_table tbody").html("");
        var table = "";
        if(data.length == 0){

            console.log("NO DATA");
            table += "<tr><td colspan='3' align='center'> No data </td></tr>";
        }else{
            for(i=0;i<data.length;i++){

                table += "<tr id='sow_row_" + data[i].sow_id + "'>";
                table += "  <td>" + (i+1) + "</td>";

                if(data[i].sol_sow_id == 99){
                   value = data[i].sol_sow_other; 
                }else{
                   value = data[i].sow_value;
                }
                table += "  <td>" + value + "</td>";
                table += '  <td>';
                table += '      <i class="fa fa-fw fa-pencil-square-o sow_edit" style="cursor:pointer" sow_id="' + data[i].sol_id + '" ></i>';
                table += '      <i class="fa fa-fw fa-trash-o sow_delete" style="cursor:pointer; color:red"  sow_id="' + data[i].sol_id + '"></i>';
                table += '  </td>';
                table += "</tr>";
            }
        }
        $("#sow_table tbody").append(table);
    },"json");
}
$(document).on("click", ".get_quatation_prj", function(){

    var json = {
        "prj_id" : $(this).attr("prj_id")
    };

    // local storage
    localStorage.setItem("prj_id", $(this).attr("prj_id"));

    // Show element
    $(".tab_empty").hide();
    $(".tab_content").show();
    $(".cost_empty").hide();
    $(".cost_monitor").show();
    $("#pdf_generate").show();
    
    // Hardware
    load_hardware(json);

    // Accessory
    load_accessory(json);

    // Service
    load_service(json);

    // Condition
    load_condition(json);

    // Scope of work
    load_scope_of_work(json);

    // Load discount
    $.post("C_project/api_get_project_by_id", json, function(data){

        $("#discount").val(data.project[0].prj_discount);
    },"json");

    // Quatation information
    $.post("C_quatation_mm/cost_monitor", json, function(data){
       
        var percent_cost = ( (100 * data.sum_cost) / (data.sum_price) ).toFixed(2);
        $("#cost_price").html(percent_cost); 
        $("#real_profit").html(data.sum_price - data.sum_cost); 
        $("#total_cost").text(data.sum_cost);

        // local storage
        localStorage.setItem("sum_price", data.sum_price);
    },"json");

    // Load system type 
    // var json = {
    //     "prj_id" : localStorage.getItem("revised_prj_id")
    // };
    $.post("C_system_log/api_get_system_log_by_prj_id", json, function(data){
   
        var option = "";
        for(var i=0;i< data.system_log.length;i++){
    
            option += "<option value='" + data.system_log[i].syt_id + "'>" + data.system_log[i].syt_name + "</option>";
            //$(".system_list").append(option);
        }
        $(".system_list").html(option);

        $(".system_list").val(1);
        $(".system_list").change();
    }, "json");

    // Define cost monitor
    $("#over_head").prop("disabled", false);
    get_cost();

    // Load vat
    // var json = {
    //     "prj_id" :  localStorage.getItem("revised_prj_id")
    // }
    $.post("C_project/api_get_vat_by_prj_id", json, function(resp){

        $("#vat").val(resp[0].prj_vat);
    },"json");
});

// Update vat
$("#vat").change(function(){
    var vat = $(this).val();
    var json = {
        "prj_vat" : vat,
        "prj_id" : localStorage.getItem("prj_id")
    };
    $.post("C_project/api_change_vat", json, function(resp){

    },"json");
});

// Cost monitor
$("#over_head").change(function(){

    console.log("OVERHEAD");
    var over_head = parseFloat($(this).val());
    var cost_price = $("#cost_price").val();
    var sum_cost = localStorage.getItem("sum_price");
    cost_price = parseInt(cost_price.replace(",", ""));

    
    var price_over_head = ( over_head / 100) * sum_cost;
    var over_head_price = cost_price + price_over_head;
    $("#overhead_price").val(price_over_head.toFixed(2));
    $("#over_head_price").val(over_head_price);
    
    // Actual Profit
    var actual_profit_price = sum_cost - over_head_price;
    var actual_profit = (actual_profit_price / sum_cost) * 100;
    $("#actual_profit_price").val(actual_profit_price.toFixed(2));
    $("#actual_profit").val(actual_profit.toFixed(2));

    $("#profit").prop("disabled", false);

});

$("#profit").change(function(){
    console.log("PROFIT");
    var sum_cost = $("#over_head_price").val();
    var profit = $(this).val();
 
    var final_price = sum_cost / ((100 - profit) / 100);
    $("#final_price").val(final_price);

    var final_profit = final_price - sum_cost;
    $("#final_profit").val(final_profit)
});



//####################
// Add Hardware Product
//####################

$("#add_product_btn").click(function(){
    
    var har_qty = $("#product_qty").val();
    var pro_id = $("#product_model").val();
    var pro_syt = $("#product_system_type").val();
    var prj_id = localStorage.getItem("prj_id");    
    //console.log(qty + " : " + brand + " : " + system_type + " : " + model);

    var json = {
        "har_pro_id" : pro_id,
        "har_prj_id" : prj_id,
        "har_syt_id" : pro_syt,
        "har_qty" : har_qty,
    };

    $.post("C_hardware/api_insert_hardware", json, function(data){

        if(data.hardware.length != 0){
            var json_a = {
                "prj_id" : prj_id
            }
            load_hardware(json_a);
            get_cost();
        }
    }, "json");
});

//####################
// Remove Hardware Product
//####################
$(document).on("click", ".delete", function(){

    
    var har_id = $(this).attr("har_id");
    $("#confirm_delete").attr("har_id", har_id);
    $("#modal-delete").modal("show");
});

$("#confirm_delete").click(function(){

    var json = {
        "har_id" : $(this).attr("har_id")
    }

    $.post("C_hardware/api_delete_hardware", json, function(){

        get_cost();
    },"json");

    $("#row_" + json.har_id).remove();
    // Run new index
    // New index
    var index = 1;
    $("#hardware_table tbody tr").each(function(){
        $(this).find("td:first").text(index++); //put elements into array
    });
    $("#modal-delete").modal("hide");
    
});

//####################
// Edit Hardware Product
//####################
$(document).on("click", ".edit", function(){

    localStorage.setItem("edit_har_id", $(this).attr("har_id"));
    
    var json = {
        "har_id" : $(this).attr("har_id")
    }

    $.post("C_hardware/api_get_hardware_by_har_id", json, function(data){

        $("#brand_edit").val(data.hardware[0].pro_bra_id);
        $("#model_edit").val(data.hardware[0].pro_id);
        $("#qty_edit").val(data.hardware[0].har_qty);
        get_cost();
    },"json");

    $("#modal-edit").modal("show");
});

$("#update_btn").click(function(){

    var har_id = localStorage.getItem("edit_har_id");
    var prj_id = localStorage.getItem("prj_id");   
    var json = {
        "har_id" : har_id,
        "har_pro_id" : $("#model_edit").val(),
        "har_qty" : $("#qty_edit").val() ,
        "har_prj_id" : prj_id 
    }
    $.post("C_hardware/api_update_hardware", json, function(data){

        var json = {
            "prj_id" : prj_id
        };
        load_hardware(json);
        $("#modal-edit").modal("hide");
        get_cost();

    },'json');
});


//####################
// Add Accessory Product
//####################

$("#add_accessory_btn").click(function(){
    
    var acc_qty = $("#acc_qty").val();
    var pro_id = $("#acc_model").val();
    var prj_id = localStorage.getItem("prj_id");    
    //console.log(qty + " : " + brand + " : " + system_type + " : " + model);

    var json = {
        "acc_pro_id" : pro_id,
        "acc_prj_id" : prj_id,
        "acc_qty" : acc_qty,
    };

    $.post("C_accessory/api_insert_accessory", json, function(data){

        if(data.accessory.length != 0){
            
            var json_a = {
                "prj_id" : prj_id
            }
            load_accessory(json_a);
            get_cost();
        }
    }, "json");
});

//####################
// Edit Accessory Product
//####################
$(document).on("click", ".acc_edit", function(){
    
    localStorage.setItem("edit_acc_id", $(this).attr("acc_id"));

    var json = {
        "acc_id" : $(this).attr("acc_id")
    }

    $.post("C_accessory/api_get_accessory_by_acc_id", json, function(data){

        $("#acc_brand_edit").val(data.accessory[0].pro_bra_id);
        $("#acc_model_edit").val(data.accessory[0].pro_id);
        $("#acc_qty_edit").val(data.accessory[0].acc_qty);

        get_cost();
    },"json");

    $("#modal-acc-edit").modal("show");
});
    
$("#acc_update_btn").click(function(){

    var acc_id = localStorage.getItem("edit_acc_id");

    console.log(acc_id);

    var json = {
        "acc_id" : acc_id,
        "acc_pro_id" : $("#acc_model_edit").val(),
        "acc_qty" : $("#acc_qty_edit").val() 
    }
    $.post("C_accessory/api_update_accessory", json, function(data){

        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(1).text(data.accessory[0].pro_model);
        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(2).text(data.accessory[0].pro_description);
        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(3).text(data.accessory[0].acc_qty);
        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(4).text(data.accessory[0].uni_name);
        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(5).text(data.accessory[0].pro_price);
        $("#acc_row_" + data.accessory[0].acc_id+ " td").eq(6).text(data.accessory[0].amount);
        //$("#modal-edit").modal("hide");
        $("#modal-acc-edit").modal("hide");

        get_cost();
    },'json');
});

//####################
// Remove Hardware Product
//####################
$(document).on("click", ".acc_delete", function(){
    
        
        var acc_id = $(this).attr("acc_id");
        $("#confirm_acc_delete").attr("acc_id", acc_id);
        $("#modal-acc-delete").modal("show");
    });
    
$("#confirm_acc_delete").click(function(){

    var json = {
        "acc_id" : $(this).attr("acc_id")
    }

    $.post("C_accessory/api_delete_accessory", json, function(){

        get_cost();
    },"json");
    $("#acc_row_" + json.acc_id).remove();
    // Run new index
    // New index
    var index = 1;
    $("#accessory_table tbody tr").each(function(){
        $(this).find("td:first").text(index++); //put elements into array
    });
    $("#modal-acc-delete").modal("hide");
    
});

//#####################
// Discount
//####################
$(document).on("click", ".discount", function(){

    var section = $(this).attr("section");
    if(section == "hardware"){

        var har_id = $(this).attr("har_id");
        localStorage.setItem("har_id", har_id);
        localStorage.setItem("section", section);
        // get data
        var json = {
            "har_id" : har_id
        };
        $.post("C_hardware/api_get_discount", json, function(resp){

            // This point continue value not set to textbox

            $("#har_discount").val(resp[0].har_discount);
        },"json");
    }else{

        var acc_id = $(this).attr("acc_id");
        localStorage.setItem("acc_id", acc_id);
        localStorage.setItem("section", section);
        // get data
        var json = {
            "acc_id" : acc_id
        };
        $.post("C_accessory/api_get_discount", json, function(resp){

            // This point continue value not set to textbox

            $("#har_discount").val(resp[0].acc_discount);
        },"json");
    }

    $("#modal-discount").modal("show");
});

$("#discount_update_btn").click(function(){
    var section = localStorage.getItem("section");
    var prj_id = localStorage.getItem("prj_id");

    if(section == "hardware"){
        var har_id = localStorage.getItem("har_id");
        var har_discount = $("#har_discount").val();
        // Clean space
        har_discount = har_discount.replace(/ /g,'');
        var json = {
            "har_id" : har_id,
            "har_discount" : har_discount
        }
        $.post("C_hardware/api_set_discount", json, function(resp){

            load_hardware({"prj_id" : prj_id}) ;
        });
    }else{
        var acc_id = localStorage.getItem("acc_id");
        var acc_discount = $("#har_discount").val();
        // Clean space
        acc_discount = acc_discount.replace(/ /g,'');
        var json = {
            "acc_id" : acc_id,
            "acc_discount" : acc_discount
        }
        $.post("C_accessory/api_set_discount", json, function(resp){

            load_accessory({"prj_id" : prj_id});
        });    
    }
    // Save data
});

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Service
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//####################
// Add service 
//####################
$("#add_services_btn").click(function(){
    var prj_id = localStorage.getItem("prj_id");
    var ser_id = $("#service_list").val();
    var sel_price = $("#service_price").val();
    var sel_unit = $("#service_unit").val();

    var json = {
        "sel_prj_id" : prj_id,
        "sel_ser_id" : ser_id,
        "sel_ser_price" : sel_price,
        "sel_ser_unit" : sel_unit
    }
    if(ser_id == 99){
        ser_value = $("#service_other").val();
        json.sel_ser_other = ser_value;
    }
    console.log(json);
    $.post("C_service_log/api_insert_service_log", json, function(data){
        var json_a = {
            "prj_id" : prj_id
        }
        load_service(json_a);
        get_cost();
    },"json");
});


//####################
// Edit Service Product
//####################

$(document).on("click", ".sel_edit", function(){
    
    localStorage.setItem("edit_sel_id", $(this).attr("sel_id"));

    var json = {
        "sel_id" : $(this).attr("sel_id")
    }

    $.post("C_service_log/api_get_service_log_by_sel_id", json, function(data){

        $("#sel_ser_id").val(data.service_log[0].sel_ser_id);
        $("#sel_ser_value").val(data.service_log[0].sel_ser_value);

        get_cost();
    },"json");

    $("#modal-sel-edit").modal("show");
});

$("#sel_update_btn").click(function(){
    
    var sel_id = localStorage.getItem("edit_sel_id");

    var json = {
        "sel_id" : sel_id,
        "sel_ser_id" : $("#sel_ser_id").val(),
        "sel_ser_value" : $("#sel_ser_value").val()
    }
    $.post("C_service_log/api_update_service_log", json, function(data){
        console.log(data);
        var row = ""
        row += "  <td>" + data.service_log.no + "</td>";
        row += "  <td>" + data.service_log[0].ser_name + "</td>";
        row += "  <td>" + data.service_log[0].sel_ser_value + "</td>";
        row += '  <td>';
        row += '      <i class="fa fa-fw fa-pencil-square-o sel_edit" style="cursor:pointer" sel_id="' + data.service_log[0].sel_id + '" ></i>';
        row += '      <i class="fa fa-fw fa-trash-o acc_delete" style="cursor:pointer; color:red"  sel_id="' + data.service_log[0].sel_id + '"></i>';
        row += '  </td>';
        $("#sel_row_" + data.service_log[0].sel_id).html(row);
        
        $("#modal-sel-edit").modal("hide");

        get_cost();
    },'json');
});

//####################
// Remove Service Product
//####################
$(document).on("click", ".sel_delete", function(){
    

    var sel_id = $(this).attr("sel_id");
    $("#confirm_sel_delete").attr("sel_id", sel_id);
    $("#modal-sel-delete").modal("show");
});
    
$("#confirm_sel_delete").click(function(){

    var json = {
        "sel_id" : $(this).attr("sel_id")
    }

    $.post("C_service_log/api_delete_service_log", json, function(){

        get_cost();
    },"json");
    $("#sel_row_" + json.sel_id).remove();

    // New index
    var index = 1;
    $("#service_log_table tbody tr").each(function(){
        $(this).find("td:first").text(index++); //put elements into array
    });
    $("#modal-sel-delete").modal("hide");
    
});

// Other case
$(".service_list").change(function(){
    var value = $(this).val();
    console.log(value);
    if(value == 99){
        $("#serivce_other_div").show();
    }else{
        $("#serivce_other_div").hide();
    }
});

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Payment Condition
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//####################
// Add condition 
//####################
$("#add_condition").click(function(){
    var prj_id = localStorage.getItem("prj_id");
    var con_id = $("#condition_list").val();


    var json = {
        "col_prj_id" : prj_id,
        "col_con_id" : con_id
    }
    if(con_id == 99){
        json.col_con_other = $("#col_con_other").val();
    }
    $.post("C_condition_log/api_insert_condition_log", json, function(data){
        var json_a = {
            "prj_id" : prj_id
        }
        load_condition(json_a);
        get_cost();
    },"json");
});

//####################
// Edit condition
//####################
$(document).on("click", ".con_edit", function(){
    
    localStorage.setItem("edit_col_id", $(this).attr("con_id"));
    //localStorage.setItem("edit_col_con_id", 0);
    //localStorage.setItem("edit_col_other", 0);

    var json = {
        "col_id" : $(this).attr("con_id")
    }

    $.post("C_condition_log/api_get_condition_log_by_col_id", json, function(data){

        var value = "";
        $("#col_con_id").val(data.condition_log[0].col_con_id);
        localStorage.setItem("edit_col_con_id", data.condition_log[0].col_con_id);

        // other case 
        if(data.condition_log[0].col_con_id == 99){

           value = data.condition_log[0].col_con_other;
           $("#col_con_other_edit").val(value);
           $("#condition_other_div_edit").show();

           // Set status
           localStorage.setItem("edit_col_other", 1);
           localStorage.setItem("edit_col_other_value", value);
        }else{

           $("#col_con_other_edit").val("");
           $("#condition_other_div_edit").hide();
        }

        get_cost();
    },"json");

    $("#modal-con-edit").modal("show");
});
    
$("#con_update_btn").click(function(){

    var col_id = localStorage.getItem("edit_col_id");
    var prj_id = localStorage.getItem("prj_id");
    var col_con_id = $("#col_con_id").val() 
    var col_con_other = $("#col_con_other_edit").val();

    var json = {
        "col_id" : col_id,
        "col_con_id" : col_con_id
    }

    // other case
    if(col_con_id == 99){

        json.col_con_other = col_con_other;
    }
    $.post("C_condition_log/api_update_condition_log", json, function(data){

        load_condition({"prj_id" : prj_id});
        get_cost();
    },'json');
});

//####################
// Remove Condition Product
//####################
$(document).on("click", ".con_delete", function(){
    

    var sel_id = $(this).attr("con_id");
    $("#confirm_con_delete").attr("con_id", sel_id);
    $("#modal-con-delete").modal("show");
});
    
$("#confirm_con_delete").click(function(){

    var prj_id = localStorage.getItem("prj_id");
    var json = {
        "col_id" : $(this).attr("con_id")
    }

    $.post("C_condition_log/api_delete_condition_log", json, function(){

        load_condition({"prj_id":prj_id});
        get_cost();
    },"json");
    
});


// Other case
$(".condition_list").change(function(){
    var value = $(this).val();
    console.log(value);
    if(value == 99){
        $(".condition_other_div").show();
    }else{
        $(".condition_other_div").hide();
    }
});
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//Scope of work
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//####################
// Add scope of work
//####################
$("#add_sow_btn").click(function(){
    var prj_id = localStorage.getItem("prj_id");
    var sol_sow_id = $("#sol_sow_id").val();


    var json = {
        "sol_prj_id" : prj_id,
        "sol_sow_id" : sol_sow_id
    }
    if(sol_sow_id == 99){
        json.sol_sow_other = $("#sol_sow_other").val();
    }
    $.post("C_scope_of_work_log/api_insert_scope_of_work_log", json, function(data){

        load_scope_of_work({ "prj_id" : prj_id});
        get_cost();
    },"json");
});

//####################
// Edit sow Product
//####################
$(document).on("click", ".sow_edit", function(){
    
    localStorage.setItem("edit_sol_id", $(this).attr("sow_id"));

    var json = {
        "sol_id" : $(this).attr("sow_id"),
    }

    $.post("C_scope_of_work_log/api_get_scope_of_work_log_by_sol_id", json, function(data){

        //console.log(data.condition[0].con_value);
        $("#sol_sow_id_edit").val(data.scope_of_work[0].sow_id);
        if(data.scope_of_work[0].sow_id == 99){

            $("#scope_of_work_div_edit").show();
            $("#sol_sow_other_edit").val(data.scope_of_work[0].sol_sow_other);
        }else{

            $("#scope_of_work_div_edit").hide();
        }
        get_cost();
    },"json");

    $("#modal-sow-edit").modal("show");
});
    
$("#sow_update_btn").click(function(){

    var sol_id = localStorage.getItem("edit_sol_id");
    var prj_id = localStorage.getItem("prj_id");
    var sol_sow_id = $("#sol_sow_id_edit").val();
    var sol_sow_other = $("#sol_sow_other_edit").val();

    var json = {
        "sol_id" : sol_id,
        "sol_sow_id" : sol_sow_id,
    }

    if(sol_sow_id == 99){
        json.sol_sow_other = sol_sow_other;
    }

    console.log(json);
    $.post("C_scope_of_work_log/api_update_scope_of_work_log", json, function(data){

        load_scope_of_work({"prj_id" : prj_id});
        get_cost();
    },'json');

});

//####################
// Remove scope of work 
//####################
$(document).on("click", ".sow_delete", function(){
    

    var sol_id = $(this).attr("sow_id");
    $("#confirm_sow_delete").attr("sow_id", sol_id);
    $("#modal-sow-delete").modal("show");
});


$("#confirm_sow_delete").click(function(){

    var prj_id = localStorage.getItem("prj_id");
    var json = {
        "sol_id" : $(this).attr("sow_id")
    }

    $.post("C_scope_of_work_log/api_delete_scope_of_work_log", json, function(){

        load_scope_of_work({"prj_id" : prj_id})
        get_cost();
    },"json");
    $("#modal-sow-delete").modal("hide");
    
});

// Other case
$(".work_list").change(function(){
    var value = $(this).val();
    console.log(value);
    if(value == 99){
        $(".scope_of_work_div").show();
    }else{
        $(".scope_of_work_div").hide();
    }
});

//########################
// PDF Generate
//########################
$("#pdf_generate").click(function(){
    
    var prj_id = localStorage.getItem("prj_id");
    var root_prj_id = localStorage.getItem("revised_prj_id");
    console.log("prj_id : " + prj_id);
    if(prj_id != ""){
        window.open("C_generate_pdf/quatation_pdf/"+prj_id+"/"+root_prj_id);
    }
});

//########################
// Discount 
//########################
$("#discount").keyup(function(){
    
    var prj_id = localStorage.getItem("prj_id");
    var discount = $(this).val();
    var json = {
        "prj_id" : prj_id,
        "prj_discount" : discount
    };
    $.post("C_project/api_discount", json, function(){});
    
});

//########################
// Add product set
//########################
$("#add_product_set_btn").click(function(){
    $("#modal-item-set").modal("show");
});

$("#confitm_add_product_set").click(function(){
    var isl_prj_id = localStorage.getItem("prj_id");
    var isl_syt_id = $("#isl_syt_id").val();
    var isl_its_id = $("#product_set_list").val();

    var json = {
        "isl_prj_id" : isl_prj_id,
        "isl_syt_id" : isl_syt_id,
        "isl_its_id" : isl_its_id
    };

    $.post("C_hardware/api_add_hardawre_by_item_set", json, function(data){

        console.log(data);
        if(data.hardware.length != 0){
            var table = "";
            var json = {
                "prj_id" : isl_prj_id
            };
            load_hardware(json);
            get_cost();
        }
    },"json");

    $("#modal-item-set").modal("hide");
});

//#########################
// Change status
//#########################

// Load status
$.post("C_status/api_get_status", "", function(resp){
    var option = "";
    for(i=0;i<resp.length;i++){
        option += "<option value='" + resp[i].sta_id + "'>" + resp[i].sta_name + "</option>";
    }
    console.log(option);
    $("#status_list").html(option);
},'json');

$(document).on("click", ".status", function(){
 
    console.log("STATUS");
    localStorage.setItem("rev_prj_id", $(this).attr("prj_id"));
    localStorage.setItem("parent", $(this).attr("parent"));
    $("#modal-sta-edit").modal("show"); 
});


$("#sta_update_btn").click(function(){
    var json = {
        "prj_id" : localStorage.getItem("rev_prj_id"),
        "prj_sta_id" : $("#status_list").val()
    }
    var prj_id = localStorage.getItem("parent"); 
    console.log(prj_id);
    $.post("C_project/api_change_status", json, function(resp){
        load_revised(prj_id);
    });
});



function check_null(str){
    if(str){
        return str;
    }else{
        return "-";
    }
}

function get_cost(){

    console.log("GET COST");
    var prj_id = localStorage.getItem("prj_id");
    var json = {
        "prj_id" : prj_id
    }
    // Quatation information
    $.post("C_quatation_mm/cost_monitor", json, function(data){
       
        // Cost percent
        var percent_cost = 0;
        if(data.sum_cost != 0){
            percent_cost = (100 * data.sum_cost) / (data.sum_price);
        }

        $("#cost_price_percent").val(percent_cost.toFixed(2)); 
        $("#cost_price").val(data.sum_cost); 
        $("#real_profit").html(data.sum_price - data.sum_cost); 
        $("#total_cost").text(data.sum_cost);

        var total_cost = 
        $("#actual_profit_price").val(data.sum_cost);

        // local storage
        localStorage.setItem("sum_price", data.sum_price);
    },"json");
}

function layor_discount(amount, discount){
    //debugger;
    var discount_list = discount.split("+");

    for(j=0;j<discount_list.length;j++){
        amount -= (amount * discount_list[j]) / 100;
    }
    return amount;
}