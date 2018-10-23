
    load_set();
    // Load product set 
    function load_set(){
        $.post("C_item_set/api_get_item_set", "", function(data){
            
            //Pace.restart();
            var table = "";
            if(data.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='2'> No data</td>";
                table += "</tr>"; 
            }else{
                for(var i=0;i< data.length;i++){
                    table += add_mini_table_row("its", data[i].its_id, data[i].its_name);
                }
            }
            $("#item_set_table tbody").html(table);
        }, "json");
    }

    // Load brand table 
    $.post("C_brand/api_get_brand", "", function(data){
        var table = "";
        for(var i=0;i< data.length;i++){
            
            $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
        }
        $("#brand_table").append(table);
    }, "json");

    // Produc filter
    $("#brand_filter").change(function(){
    
        $("#model_list").prop("disabled", false);
        $("#quantity").prop("disabled", false);

        $("#model_list").html("");
        var json = {
            'pro_bra_id' : $(this).val(),
            "limit" : 0,
            "page" : 0,
            "search" : ""
        };
        $.post("C_product/api_get_product_by_brand_id", json, function(data){
    
            for(var i=0;i< data.length;i++){
    
                $("#model_list").append(new Option(data[i].pro_model, data[i].pro_id));
            }
        }, "json");
    });



    // Produc filter
    $(document).on("click",".product_list", function(){
        // enable form
        $("#btn_add_product").prop("disabled", false);
        $("#brand_filter").prop("disabled", false);

        // local storage
        var its_id = $(this).attr("its_id");
        localStorage.setItem("its_id", its_id);
        
        var json = {
            'isl_its_id' : $(this).attr("its_id")
        };

        // Clear table
        $("#product_table tbody ").html("");

        // Load data from api
        $.post("C_product/api_get_product_by_item_set_id", json, function(data){
            var table = "";
            for(var i=0;i< data.length;i++){
  
               table += add_product_table_row("isl",(i+1), data[i].isl_id, data[i].pro_model, data[i].pro_description, data[i].isl_qty );
            }

            // Show if no data in table
            if(data.length == 0){
                table = "<tr><td colspan='6'> No data</td></tr>";
            }
            $("#product_table").append(table);
        }, "json");
    });

    // Add row to table
    function add_mini_table_row(name, data_id, data_value){
        var table = "";
        table += "<tr id='its_row_"+data_id+"'>";
        table += "<td id='" + name + "_" + data_id + "_field_name'>" + data_value + "</td>";
        table += "<td>";
        table += "  <i class='fa fa-fw fa-pencil-square-o change_name_" + name + "' "+name+"_id='" + data_id + "' style='cursor:pointer' ></i>"; 
        table += "  <i class='fa fa-fw fa-file-text product_list' "+name+"_id='" + data_id + "' style='cursor:pointer'></i>";
        table += "  <i class='fa fa-fw fa-trash-o delete_" + name + "' data_id='" + data_id + "' style='cursor:pointer; color:red'></i>";
        table += "</td>";
        table += "</tr>";
        return table;

    }

    // Add row to product table
    function add_product_table_row(name, index, id, model, descript, qty){

        var table = "";
        table += "<tr id='isl_row_"+ id + "'>";
        table += "<td>" + index + "</td>";
        table += "<td>" + model + "</td>";
        table += "<td>" + descript + "</td>";
        table += "<td>" + qty + "</td>";
        table += "<td>";
        table += "  <i class='fa fa-fw fa-trash-o delete_" + name + "' data_id='" + id + "' style='cursor:pointer; color:red' data-toggle='modal' data-target='#modal-delete'></i>";
        table += "</td>";
        table += "</tr>";
        return table;

    }

    function load_product(){

        console.log(" FUNCTION");
        var json = {
            'isl_its_id' :  localStorage.getItem("its_id")
        };

        $.post("C_product/api_get_product_by_item_set_id", json, function(data){
            console.log(data);
            $("#product_table tbody").html("");

            // Show if no data in table
            var table = "";
            if(data.length == 0){

                table = "<tr><td colspan='6'> No data</td></tr>";
            }else{

                console.log(data.length);
                for(var i=0;i< data.length;i++){
                    
                    table += add_product_table_row("isl",(i+1), data[i].isl_id, data[i].pro_model, data[i].pro_description, data[i].isl_qty );
                }
            }
            $("#product_table tbody").append(table);
        },'json');
    }

    //#############################
    // INSERT ITEM SET
    //#############################
    $("#add_its").click(function(){
        var name = $("#new_name_its").val();

        if(name){
	        var json = {
	            'its_name' : name
	        };

	        $.post("C_item_set/api_insert_item_set", json, function(resp){
	            if(resp.status){

                    load_set();
                    $("#new_name_its").val("");
	            }else{

	            }
	        }, "json");
	    }else{
	    	alert("Please input name");
	    }
    });

    //################################
    // Add product
    //################################
    $("#btn_add_product").click(function(){

        var isl_its_id = localStorage.getItem("its_id");
        var isl_qty = $("#quantity").val();
        var isl_pro_id = $("#model_list").val();

        var json = {
            "isl_pro_id" : isl_pro_id,
            "isl_qty" : isl_qty,
            "isl_its_id" : isl_its_id 
        }

        $.post("C_item_set_log/api_insert_item_set_log", json, function(data){

            console.log("ADD PRODUCT");
            load_product();
        },"json");
    });

    //################################
    // Delete product
    //################################
    $(document).on("click", ".delete_isl", function(){
        
        var isl_id = $(this).attr("data_id");
        localStorage.setItem("del_isl_id", isl_id);
        $("#modal-isl-delete").modal("show");
    });
    
    $("#confirm_delete").click(function(){
    
        var isl_id = localStorage.getItem("del_isl_id");
        var json = {
            "isl_id" : isl_id
        }
    
        $.post("C_item_set_log/api_delete_item_set_log", json, function(){
        },"json");

        $("#isl_row_" + isl_id).remove();

        // Run new index
        // New index
        var index = 1;
        $("#product_table tbody tr").each(function(){
            $(this).find("td:first").text(index++); //put elements into array
        })
        $("#modal-isl-delete").modal("hide");
    });

    //################################
    // Delete Item Set
    //################################
    $(document).on("click", ".delete_its", function(){
        
        var its_id = $(this).attr("data_id");
        localStorage.setItem("del_its_id", its_id);
        $("#modal-its-delete").modal("show");
    });
    
    $("#confirm_delete_its").click(function(){
    
        var its_id = localStorage.getItem("del_its_id");
        var json = {
            "its_id" : its_id
        }
    
        $.post("C_item_set/api_item_set_delete", json, function(){
        },"json");

        $("#its_row_" + its_id).remove();

        // Run new index
        // New index
        var index = 1;
        $("#product_table tbody tr").each(function(){
            $(this).find("td:first").text(index++); //put elements into array
        });
        $("#modal-its-delete").modal("hide");
    });

    //################################
    // Update name
    //################################

    $(document).on("click", ".change_name_its", function(){
        var json = {
            "its_id" : $(this).attr("its_id")  
        };

        localStorage.setItem("its_id", json.its_id);
        $.post("C_item_set/api_get_item_set_by_id", json, function(data){

            $("#new_name").val(data.item_set[0].its_name);
        },'json');
        $("#modal-name_update").modal("show");
    
    });

    $(document).on("click", "#update_name", function(){
        var json = {
            "its_id": localStorage.getItem("its_id"),
            "its_name" : $("#new_name").val()
        };
        $.post("C_item_set/api_item_set_update", json, function(){
        },"json");

        $("#its_" + json.its_id + "_field_name").text(json.its_name);
    });