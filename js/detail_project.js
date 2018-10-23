
$(document).ready(function(){
    $(document).ajaxStart(function() { 
        Pace.restart(); 
    }); 

    // Load sale man 
    $.post("../../C_employee/api_get_sale_man", "", function(data){
        for(var i=0;i< data.sale_man.length;i++){

            $("#prj_emp_id").append(new Option(data.sale_man[i].emp_first_name, data.sale_man[i].emp_id));
        }
    }, "json");


    // Load customer type 
    $.post("../../C_customer_type/api_get_customer_type", "", function(data){

        for(var i=0;i< data.customer_type.length;i++){

            $("#prj_ctp_id").append(new Option(data.customer_type[i].ctp_name, data.customer_type[i].ctp_id));
        }
    }, "json");
    
    // Load place type 
    $.post("../../C_place_type/api_get_place_type", "", function(data){

        for(var i=0;i< data.length;i++){

            $("#prj_plt_id").append(new Option(data[i].plt_name, data[i].plt_id));
        }
    }, "json");

    // Load work type 
    $.post("../../C_work_type/api_get_work_type", "", function(data){
        for(var i=0;i< data.length;i++){

            $("#prj_wor_id").append(new Option(data[i].wor_name, data[i].wor_id));
        }
    }, "json");

    // Load work type 
    $.post("../../C_status/api_get_status", "", function(data){
        for(var i=0;i< data.length;i++){

            $("#prj_sta_id").append(new Option(data[i].sta_name, data[i].sta_id));
        }
    }, "json");

    // Load attachment
    $.post("../../C_attachment/api_get_attachment", "", function(data){
        var column = Math.ceil(data.attachment.length / 3);
        var size_div = 12 / column;

        html = "<div class='col-md-" + size_div + "'>";
        for(i=0;i<data.attachment.length;i++){
            html += "<p>" + "<input type='checkbox' class='minimal attachment' name='attachment' value='" + data.attachment[i].att_id + "' disabled> " + data.attachment[i].att_name + "</p>";
            if((i+1) % 3 == 0){
                html += "</div>";
                html += "<div class='col-md-" + size_div + "'>";
            }
        }
        
        $("#attachment_blog").append(html);
    }, "json");

    var json = {
        "prj_id" : prj_id
    };
    $.post("../../C_project/api_get_project_by_id", json, function(data){
        $("#prj_title").val(data.project[0].prj_title);
        $("#prj_company").val(data.project[0].prj_company);
        $("#prj_contact").val(data.project[0].prj_contact);
        $("#prj_mobile").val(data.project[0].prj_mobile);
        $("#prj_tel").val(data.project[0].prj_tel);
        $("#prj_email").val(data.project[0].prj_email);
        $("#prj_fax").val(data.project[0].prj_fax);
        $("#prj_emp_id").val(data.project[0].prj_emp_id);
        console.log(data.project[0].prj_emp_id);
        $("#prj_customer").val(data.project[0].prj_customer);
        $("#prj_customer_name").val(data.project[0].prj_customer_name);
        $("#prj_regular_customer").val(data.project[0].prj_regular_customer);
        $("#prj_ctp_id").val(data.project[0].prj_ctp_id);
        $("#prj_wor_id").val(data.project[0].prj_wor_id);
        $("#prj_wot_date").val(data.project[0].prj_wot_date);
        $("#prj_sta_id").val(data.project[0].prj_sta_id);

        // Empty file
        var disabled = "";
        if(data.project[0].prj_att_file == ""){
            disabled = "disabled";
        }else{
            disabled = "";
        }
        $("#prj_att_file").replaceWith('<a href="../../../assert/project/'+data.project[0].prj_att_file+'"><button type="button" class="btn btn-block btn-primary btn-sm" style="width:100px" '+ disabled +'><i class="fa fa-fw fa-download"></i> Download</button></a>');
        $("#prj_att_location").val(data.project[0].prj_att_location);
    }, "json");

    $.post("../../C_attachment_log/api_get_attachment_log_by_prj_id", json, function(data){
        $(".attachment").each(function(){

            for(i=0;i<data.attachment_log.length;i++){

                if($(this).val() == data.attachment_log[i].atl_att_id){
                    $(this).attr('checked','checked');
                    break;
                }
            }
        });
    }, "json");

    $.post("../../C_system_log/api_get_system_log_by_prj_id", json, function(data){
        // add data to table
        console.log(data);
        $("#system_table tbody").html("");
        table = "";
        for(i=0;i<data.system_log.length;i++){
           table += "<tr>"; 
           table += " <td></td>";
           table += " <td><input type='text' class='form-control' value='" + data.system_log[i].syt_name + "' disabled></td>";
           brand = "";
           for(j=0;j<data.system_log[i].brand_log.length;j++){
               brand += data.system_log[i].brand_log[j].bra_name;
               if(j != data.system_log[i].brand_log.length-1){
                    brand += ", ";
               }
           }
           table += " <td><input type='text' class='form-control' value='"+ brand +"' disabled></td>";
           table += " <td></td>";
           table += "</tr>"; 
        }
        $("#system_table tbody").append(table);

    },"json");

    $("input").attr("disabled", "disabled");
    $("select").attr("disabled", "disabled");
    $("#save_btn").hide();
    $("#reset_btn").hide();

});


