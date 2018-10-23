//Initialize Select2 Elements:
var brand_list = new Array();
$('.select2').select2().on("change", function (e) {
    var index = $(this).attr("index");
    brand_list[index] = $(this).val();
});

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
});

//Money Euro
$('[data-mask]').inputmask();

//Date picker
$('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
});


$(document).ready(function(){
    $(document).ajaxStart(function() { 
        Pace.restart(); 
    }); 


    // Load sale man 
    $.post("../C_employee/api_get_sale_man", "", function(data){
        for(var i=0;i< data.sale_man.length;i++){

            $("#prj_emp_id").append(new Option(data.sale_man[i].emp_first_name, data.sale_man[i].emp_id));
        }
    }, "json");


    // Load customer type 
    $.post("../C_customer_type/api_get_customer_type", "", function(data){

        for(var i=0;i< data.customer_type.length;i++){

            $("#prj_ctp_id").append(new Option(data.customer_type[i].ctp_name, data.customer_type[i].ctp_id));
        }
    }, "json");
    
    // Load place type 
    $.post("../C_place_type/api_get_place_type", "", function(data){

        for(var i=0;i< data.length;i++){

            $("#prj_plt_id").append(new Option(data[i].plt_name, data[i].plt_id));
        }
    }, "json");

    // Load work type 
    $.post("../C_work_type/api_get_work_type", "", function(data){
        for(var i=0;i< data.length;i++){

            $("#prj_wor_id").append(new Option(data[i].wor_name, data[i].wor_id));
        }
    }, "json");

    // Load work type 
    $.post("../C_status/api_get_status", "", function(data){
        for(var i=0;i< data.length;i++){

            $("#prj_sta_id").append(new Option(data[i].sta_name, data[i].sta_id));
        }
    }, "json");


    // Load system type 
    $.post("../C_system_type/api_get_system_type", "", function(data){
        for(var i=0;i< data.length;i++){

            var option = new Option(data[i].syt_name, data[i].syt_id);
            $(".system_type").append(option);
        }
        //$(".system_type").val(1);
    }, "json");

    // Load brand type 
    $.post("../C_brand/api_get_brand", "", function(data){
        for(var i=0;i< data.length;i++){

            $(".brand").append(new Option(data[i].bra_name, data[i].bra_id));
        }
    }, "json");

    // Load attachment
    $.post("../C_attachment/api_get_attachment", "", function(data){
        var column = Math.ceil(data.attachment.length / 3);
        var size_div = 12 / column;

        console.log(data.attachment[0]);
        html = "<div class='col-md-" + size_div + "'>";
        for(i=0;i<data.attachment.length;i++){
            html += "<p>" + "<input type='checkbox' class='minimal attachment' name='attachment' value='" + data.attachment[i].att_id + "'> " + data.attachment[i].att_name + "</p>";
            if((i+1) % 3 == 0){
                html += "</div>";
                html += "<div class='col-md-" + size_div + "'>";
            }
        }
        
        $("#attachment_blog").append(html);
    }, "json");

    // Add new row
    $(document).on("click", "#add_new_row", function(){

        var index = 0;
        $("#system_table tbody tr").each(function(){
            if(!$(this).is(":visible")){

                $(this).show();
                return false;
            }
        });

        var index = 0;
        var hide_elem = 0;
        $("#system_table tbody tr").each(function(){
            if($(this).is(":visible")){
                index++;
            }else{
                hide_elem++;
            }
        });

        var count = 0;
        $("#system_table tbody tr").each(function(){
            if($(this).is(":visible")){
                if((count+1) != index){ // check end row
                    
                    $(this).find("td:first").html("<i class='fa fa-fw fa-trash delete' style='color: red; cursor: pointer;' index='" + count + "'></i>");
                }else{

                    if(hide_elem == 0){
                        $(this).find("td:first").html("<i class='fa fa-fw fa-trash delete' style='color: red; cursor: pointer;' index='" + count + "'></i>");
                    }else{
                        $(this).find("td:first").html('<i class="fa fa-fw fa-plus" style="color: green; cursor: pointer;" id="add_new_row" index="'+ count +'"></i>');
                    }
                }
                count++;
            }
        });
    });

    $(document).on("click", ".delete", function(){
        $(this).closest("tr").hide(); 

        var index = 0;
        var hide_elem = 0;
        $("#system_table tbody tr").each(function(){
            if($(this).is(":visible")){
                index++;
            }else{
                hide_elem++;
            }
        });

        var count = 0;
        $("#system_table tbody tr").each(function(){
            if($(this).is(":visible")){
                if((count+1) != index){ // check end row
                    
                    $(this).find("td:first").html("<i class='fa fa-fw fa-trash delete' style='color: red; cursor: pointer;' index='" + count + "'></i>");
                }else{

                    if(hide_elem == 0){
                        $(this).find("td:first").html("<i class='fa fa-fw fa-trash delete' style='color: red; cursor: pointer;' index='" + count + "'></i>");
                    }else{
                        $(this).find("td:first").html('<i class="fa fa-fw fa-plus" style="color: green; cursor: pointer;" id="add_new_row" index="'+ count +'"></i>');
                    }
                }
                count++;
            }
        });
    });

    $("#reset_btn").click(function(){
        multi_select.select2("destroy");
        multi_select.select2();
    });

    var system_type_list = new Array();
    // Set default value
    system_type_list[0] = 1;
    $(".system_type").change(function(){

        var index = $(this).attr("index");
        system_type_list[index] = $(this).val();
    });

    $("#save_btn").click(function(){
        var prj_title = $("#prj_title").val();
        var prj_company = $("#prj_company").val();
        var prj_contact = $("#prj_contact").val();
        var prj_mobile = $("#prj_mobile").val();
        var prj_tel = $("#prj_tel").val();
        var prj_email = $("#prj_email").val();
        var prj_fax = $("#prj_fax").val();
        var prj_emp_id = $("#prj_emp_id").val();
        var prj_regular_customer = $("#prj_regular_customer").val();
        var prj_customer_name = $("#prj_customer_name").val();
        var prj_ctp_id = $("#prj_ctp_id").val();
        var prj_plt_id = $("#prj_plt_id").val();
        var prj_wor_id = $("#prj_wor_id").val();
        var prj_wot_date = $("#prj_wot_date").val();
        var prj_sta_id = $("#prj_sta_id").val();
        var prj_att_file = $("#prj_att_file").val();
        var prj_att_location = $("#prj_att_location").val();

        var attachment_value = new Array();
        $('input[name=attachment]:checked').map(function() {
            attachment_value.push($(this).val());
        });

        json = {
           "prj_title" : prj_title, 
           "prj_company" : prj_company,
           "prj_contact" : prj_contact,
           "prj_mobile" : prj_mobile,
           "prj_tel" : prj_tel,
           "prj_email" : prj_email,
           "prj_fax" : prj_fax,
           "prj_emp_id" : prj_emp_id,
           "prj_regular_customer" : prj_regular_customer,
           "prj_customer_name" : prj_customer_name,
           "prj_ctp_id" : prj_ctp_id,
           "prj_plt_id" : prj_plt_id,
           "prj_wor_id" : prj_wor_id,
           "prj_wot_date" : prj_wot_date,
           "prj_sta_id" : prj_sta_id,
           "prj_att_file" : prj_att_file,
           "prj_att_location" : prj_att_location,
           "prj_att_list" : attachment_value
        }


        // Insert general detail
        $.post("../C_project/api_insert_project", json, function(){
            console.log("PROJECT");
        },"json");

        // upload file
        var file_data = $('#prj_att_file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('pro_pic', file_data);
        $.ajax({
            url: '../C_project/api_upload_file', // point to server-side PHP script 
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(data){
                console.log("UPLOAD");
            }
        });


        var complete = 0;
        $(document).ajaxComplete(function() {
           console.log("COMPLETE");
           complete++;
           console.log(complete);
           if(complete == 2){

                // Insert table of system
                system_table_json = {
                    "system_type_list" : system_type_list,
                    "brand_list" : brand_list 
                };

                $.post("../C_system_log/api_insert_system_log", system_table_json, function(){
                    console.log("INSERT SYSTEM LOG");
                    
                },"json");
           }

           if(complete == 3){
                window.location.href = "../../index.php/C_project_mm";
           }
        });

    });


});


