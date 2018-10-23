$(document).ready(function(){
    $(document).ajaxStart(function() { 
        Pace.restart(); 
    }); 

    // Load table
    load_employee();
    function load_employee(){
        $.post("C_employee/api_get_employee", "", function(data){
            var table = "";
            
            for(var i=0;i< data.length;i++){
                table += add_row(i, data[i].emp_id, data[i].emp_username, data[i].emp_password, data[i].emp_first_name, data[i].emp_last_name, data[i].pos_name, data[i].emp_email, data[i].emp_create, data[i].emp_update, 1, data[i].emp_pos_id);
            }
            $("#employee_list tbody").html(table);
        }, "json");
    }

    // Load waiting approve table
    load_waiting();
    function load_waiting(){
        $.post("C_employee/api_get_waitting_approve", "", function(data){
            var table = "";
        
            if(data.length == 0 ){
                table = "<tr><td colspan='10'> No data </td></tr>";
            }else{
                for(var i=0;i< data.length;i++){
                    table += add_row(i, data[i].emp_id, data[i].emp_username, data[i].emp_password, data[i].emp_first_name, data[i].emp_last_name, data[i].pos_name, data[i].emp_email, data[i].emp_create, data[i].emp_update, 0, data[i].emp_pos_id);
                }
            }
            $("#waitting_approve tbody").html(table);
        }, "json");
    }

    // Load position dropdown
    $.post("C_position/api_get_position", "", function(data){
        option = "";

        for(var i=0;i< data.length;i++){
            if(i != 0){
                option += "<option value=" + data[i].pos_id + ">" + data[i].pos_name + "</option>";
            }
        }
        $("#emp_pos_id").append(option);
        $("#change_pos_id").append(option);
    }, "json");


    $("#btn_insert").click(function(){

        var emp_username = $("#emp_username").val();
        var emp_password = $("#emp_password").val();
        var emp_first_name = $("#emp_first_name").val();
        var emp_last_name = $("#emp_last_name").val();
        var emp_pos_id = $("#emp_pos_id").val();
        var emp_email = $("#emp_email").val();

        var table = "";

        if(!(emp_username == "" || emp_password == "" || emp_first_name == "" || emp_last_name == "" || emp_pos_id == "" || emp_email == "")){
            json = {
                'emp_username' : emp_username,
                'emp_password' : emp_password,
                'emp_first_name' : emp_first_name,
                'emp_last_name' : emp_last_name,
                'emp_pos_id' : emp_pos_id,
                'emp_email' : emp_email
            };
            $.post("C_employee/api_insert", json, function(data){
                  console.log("insert");
                  console.log(data);
                //check status
                if(data.status == 1){
                    // Close modal
                    $("#modal-success").modal("toggle");

                    // Clear data in form
                    $("#emp_username").val("");
                    $("#emp_password").val("");
                    $("#emp_first_name").val("");
                    $("#emp_last_name").val("");
                    $("#emp_pos_id").val("");
                    $("#emp_email").val("");

                    load_waiting();
                    reset_index("waitting_approve");

                    // Clear warning
                    $("#add_new_form input").each(function(){
              
                        $(this).removeClass('error');
                    });
                    $("#add_new_form select").removeClass('error');
                }
            }, "json");
        }else{
            
            alert("Pleas input all data");
            $("#add_new_form input").each(function(){
                if($(this).val() == ""){

                    $(this).addClass('error');
                }else{

                    $(this).removeClass('error');
                }
            });
        }
       
    });

    // Hide and show password
    $(document).on("click",".hide_password", function(){
        var id = $(this).attr("id");

        if($("#eye_" + id).is(":visible")){
            $("#eye_" + id).hide();
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        }else{
            $("#eye_" + id).show();
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });

    // Change Pasword
    $(document).on("click", ".change_password", function(){
        // Clear data in form
        $("#username").val("");
        $("#password").val("");
        $("#new_password").val("");
        $("#confirm_password").val("");
        $("#emp_id").val("");
        // clear Warning
        $('#new_password').removeClass('error');
        $('#confirm_password').removeClass('error');
        $('#password').removeClass('error');
        $('#error_password').text("");
        $('#error_new_password').text("");

        // Send value to modal
        var username = $(this).attr("username");
        $("#username").val(username);

        var emp_id = $(this).attr("emp_id");
        $("#emp_id").val(emp_id);
        //console.log("username : " + username);
    });

    // Change password
    $("#change_password_ok").click(function(){
        //var emp_id = $(this).attr("emp_id");
        var username = $("#username").val();
        var password = $("#password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();
        var emp_id = $("#emp_id").val();
        // Debug
        //console.log("username : " + username + ", password : " + password + ", new password : " + new_password + ", confirm password : " + confirm_password);

        json = {
            "username" : username,
            "password" : password,
            "new_password" : new_password,
            "confirm_password" : confirm_password,
            "emp_id" : emp_id
        };


        $.post("C_employee/api_change_password", json, function(data){
            //console.log("status : " + data.status);
            if(data.status == 1){

                //Close modal
                $('#modal-change_password').modal('hide');
                $('#eye_' + data.emp_id).html(confirm_password);

            }else if(data.status == 2){
                //Warning
                $('#new_password').removeClass('error');
                $('#confirm_password').removeClass('error');
                $('#password').addClass('error');
                $('#error_password').text(" *" + data.msg);
            }else if(data.status == 3){
                //WArning
                $('#password').removeClass('error');
                $('#new_password').addClass('error');
                $('#confirm_password').addClass('error');
                $('#error_new_password').text(" *" + data.msg);
            }
        }, "json");
    });

    // Change profile
    $(document).on("click", ".change_profile", function(){
        // Send value to modal
        var emp_id = $(this).attr("emp_id");
        $("#change_emp_id").val(username);

        json = {
            'emp_id' : emp_id
        };

        $.post("C_employee/api_get_profile", json, function(data){

            //console.log(data);
            // Set value to element
            $("#change_emp_id").val(emp_id);
            $("#change_first_name").val(data[0].emp_first_name);
            $("#change_last_name").val(data[0].emp_last_name);
            $("#change_email").val(data[0].emp_email);
            $("#change_pos_id").val(data[0].emp_pos_id);
            $('#modal-change_profile').modal('show');
        }, "json");
    });

    $("#change_profile_ok").click(function(){
        
        emp_id = $("#change_emp_id").val();
        emp_first_name = $("#change_first_name").val();
        emp_last_name = $("#change_last_name").val();
        emp_email = $("#change_email").val();
        emp_pos_id = $("#change_pos_id").val();

        json = {
            'emp_id' : emp_id,
            'emp_first_name' : emp_first_name,
            'emp_last_name' : emp_last_name,
            'emp_email' : emp_email,
            'emp_pos_id' : emp_pos_id
        };

        $.post("C_employee/api_change_profile", json, function(data){
           // Check Status
            if(data.status == 1){
                console.log(data);
                console.log(data.employee[0].emp_first_name);
                // Update data
                $('#'+data.employee[0].emp_id+'_field_first_name').text(data.employee[0].emp_first_name);
                $('#'+data.employee[0].emp_id+'_field_last_name').text(data.employee[0].emp_last_name);
                $('#'+data.employee[0].emp_id+'_field_email').text(data.employee[0].emp_email);
                $('#'+data.employee[0].emp_id+'_field_pos_name').text(data.employee[0].pos_name);
                $('#'+data.employee[0].emp_id+'_field_update').text(data.employee[0].emp_update);

                // Clear data in form
                $("#change_emp_id").val("");
                $("#change_first_name").val("");
                $("#change_last_name").val("");
                $("#change_email").val("");
                $("#change_pos_id").val("");

                // Close modal
                $('#modal-change_profile').modal('toggle');
            }
           
        }, "json");
    });

    // Delete Employee

    $(document).on("click", ".delete", function(){
        //console.log("DELETE");
        emp_id = $(this).attr("emp_id");
        row = $(this).closest("tr");
        $("#confirm_delete").click(function(){
            json = {
                "emp_id" : emp_id
            }
            $.post("C_employee/api_employee_delete", json, function(data){
                // New index
                var index = 1;
                $("#employee_list tbody tr").each(function(){
                    $(this).find("td:first").text(index++); //put elements into array
                });
                // Check Status
                load_employee();
                $('#modal-delete').modal('hide');
                row.remove();
             });
        });
    });

    // Show password
    $("#eye_password").click(function(){
        status = $("#emp_password").attr("type");
        if( status == "password"){

            $("#emp_password").attr("type", "text");
        }else{

            $("#emp_password").attr("type", "password");
        }
    });

    // Approve 
    $(document).on("click", ".approve_btn", function(){
        var elem = $(this).closest("tr");
        if(!alert("Are you sure to approve?")){

            var json = {
                "emp_id" : $(this).attr("emp_id") 
            }
            $.post("C_employee/api_approve", json, function(){

                elem.remove();
                load_employee();
                // elem.find(".approve_btn").remove();
                // $("#employee_list tbody").append(elem);
                // reset_index();
            });
        }
    });

    // Permission setting
    $(document).on("click", ".permission_btn", function(){

        var emp_id = $(this).attr("id");
        var checked = "";
        var json = {
            "emp_id" : emp_id
        };
        $.post("C_permission_module/api_get_permission_by_emp_id", json, function(resp){
            var table = "";
            for(i=0;i<resp.length;i++){
                table += "<tr>";
                table += "  <td>" + (i+1) + "</td>";
                table += "  <td>" + resp[i].stm_name + "</td>";

                // check permission is checked
                if(resp[i].pmm_read == 1){

                    checked = "checked";
                }else{

                    checked = "";
                }
                table += "  <td><input type='checkbox' class='pmm_read' permission='read' stm_id='" + resp[i].stm_id + "' emp_id='" + emp_id + "' " + checked + "></td>";

                if(resp[i].pmm_copy == 1){

                    checked = "checked";
                }else{
                    checked = "";
                }
                table += "  <td><input type='checkbox' class='pmm_copy' permission='copy' stm_id='" + resp[i].stm_id + "' emp_id='" + emp_id + "' " + checked + "></td>";
                table += "</tr>";
            }
            // clear table
            $("#permission_table tbody tr").remove();
            // create table
            $("#permission_table").append(table);

        },"json");
        $("#modal-permission").modal("show");
    });

    // Assign permission
    $(document).on("change", ".pmm_copy, .pmm_read", function(){

        var permission = $(this).attr("permission");
        var checked = $(this)[0].checked;
        var temp_var = "";
        console.log(checked);
        var json = {

            "pmm_emp_id" : $(this).attr("emp_id"),
            "pmm_stm_id" : $(this).attr("stm_id") 
        }
        if(permission == "read"){

            if(checked){

                console.log("checked");
                temp_var = 1;
            }else{

                console.log("uncheck");
                temp_var = 0;
            }

            json.pmm_read = temp_var;
        }else{

            if(checked){

                console.log("checked");
                temp_var = 1;
            }else{

                console.log("uncheck");
                temp_var = 0;
            }

            json.pmm_copy = temp_var;
        }
        console.log(json);
        $.post("C_permission_module/api_update_permission", json, function(){});
    });

    $(document).on("click", ".approve_doc", function(){
        console.log("APRROVE");
        var emp_id = $(this).attr("emp_id");
        if(emp_id != ""){

            window.open("C_approve_pdf/approve_document/"+emp_id);
        }
    });

    // Data table
    //$('#employee_list').DataTable();

    // Add row to table
    function add_row(index, emp_id, emp_username, emp_password, emp_first_name, emp_last_name, pos_name, emp_email, emp_create, emp_update, approve="0", emp_pos_id){
        var table = "";
        table += "<tr>";
        table += "<td>" + (index + 1) + "</td>";
        table += "<td id='"+emp_id+"_field_user'>" + emp_username + "</td>";
        table += "<td>";
        table += "  <div style='display:none;' id='eye_"+ emp_id +"'>" + emp_password + "</div>";
        if(pos_id > emp_pos_id){
        
            table += "  <i class='fa fa-eye' style='cursor:not-allowed' id='" + emp_id + "'></i> ";
            table += "  <i class='fa fa-fw fa-pencil-square-o ' emp_id='" + emp_id + "' style='cursor:not-allowed'></i>"; 
        }else{

            table += "  <i class='fa fa-eye hide_password' style='cursor:pointer' id='" + emp_id + "'></i> ";
            table += "  <i class='fa fa-fw fa-pencil-square-o change_password' emp_id='" + emp_id + "' style='cursor:pointer' data-toggle='modal' data-target='#modal-change_password' username='" + emp_username + "'></i>"; 
        }
        
        table += "</td>";
        table += "<td id='"+emp_id+"_field_first_name'>" + emp_first_name + "</td>";
        table += "<td id='"+emp_id+"_field_last_name'>" + emp_last_name + "</td>";
        table += "<td id='"+emp_id+"_field_pos_name'>" + pos_name + "</td>";
        table += "<td id='"+emp_id+"_field_email'>" + emp_email + "</td>";
        table += "<td>" + emp_create + "</td>";
        table += "<td id='"+emp_id+"_field_update'>" + emp_update + "</td>";
        table += "<td>";
        
        // Check waiting approve
        if(approve == 0){
            table += "<i class='fa fa-check approve_btn' style='cursor:pointer' emp_id='" + emp_id + "'></i>";
            table += "<i class='fa fa-print approve_doc' style='cursor:pointer' emp_id='" + emp_id + "'></i>";
        }

        // Check permission
        var del_disabled = ""; 
        console.log(pos_id + " " + emp_pos_id);
        if(pos_id > emp_pos_id){
        
            table += "<i class='fa fa-key ' style='cursor:not-allowed' id='" + emp_id + "'></i>";
            table += "<i class='fa fa-fw fa-pencil-square-o ' emp_id='" + emp_id + "' style='cursor:not-allowed'></i>"; 
        }else{
        
            table += "<i class='fa fa-key permission_btn' style='cursor:pointer' id='" + emp_id + "'></i>";
            table += "<i class='fa fa-fw fa-pencil-square-o change_profile' emp_id='" + emp_id + "' style='cursor:pointer'></i>"; 
        }
        
        if(pos_id >= emp_pos_id){
        
            table += "  <i class='fa fa-fw fa-trash-o ' emp_id='" + emp_id + "' style='cursor:not-allowed;'></i>";
        }else{
        
            table += "  <i class='fa fa-fw fa-trash-o delete' emp_id='" + emp_id + "' style='cursor:pointer; color:red' data-toggle='modal' data-target='#modal-delete'></i>";
        }
        table += "</td>";
        table += "</tr>";

        return table;
    }


    function reset_index(table_id="employee_list"){
        // New index
        var index = 1;
        $("#" + table_id + " tbody tr").each(function(){
            $(this).find("td:first").text(index++); //put elements into array
        });
    }


});



//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
});
