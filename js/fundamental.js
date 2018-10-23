
    

    load_system_type();
    load_place();
    load_brand();
    // Load system type table 
    function load_system_type(){
        $.post("C_system_type/api_get_system_type", "", function(data){

            Pace.restart();
            var table = "";
            if(data.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='2'> No data</td>";
                table += "</tr>"; 
            }else{
                for(var i=0;i< data.length;i++){
                    table += add_mini_table_row("syt", data[i].syt_id, data[i].syt_name);
                }
            }
            $("#system_type_table tbody").html(table);
        }, "json");
    }

    // Load brand table 
    function load_brand(){
        $.post("C_brand/api_get_brand", "", function(data){
            var table = "";
            if(data.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='2'> No data</td>";
                table += "</tr>"; 
            }else{
                for(var i=0;i< data.length;i++){
                    table += add_mini_table_row("bra", data[i].bra_id, data[i].bra_name);
                    
                    $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
                }
            }
            $("#brand_table tbody").html(table);
        }, "json");
    }

    // Load place table 
    function load_place(){
        $.post("C_place_type/api_get_place_type", "", function(data){
            var table = "";
            if(data.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='2'> No data</td>";
                table += "</tr>"; 
            }else{
                for(var i=0;i< data.length;i++){
                    table += add_mini_table_row("plt", data[i].plt_id, data[i].plt_name);
                }
            }
            $("#place_type_table tbody").html(table);
        }, "json");
    }


    // Load page
    localStorage.setItem("page", 1);
    localStorage.setItem("pri_search", "");

    load_paging(0,"",1);
    function load_paging(page=0, search="", pro_bra_id){
        console.log("LOAD PAGE");
        var json = {
            "limit" : "",
            "page" : "",
            "search" : search,
            "pro_bra_id" : pro_bra_id
        };
        $.post("C_product/api_get_product_by_brand_id", json, function(data){
            
            var btn = "";
            var count = Math.ceil(data.length / 10);

            // check rang
            var current_page = parseInt(localStorage.getItem("page"));
            var start = current_page - 3;
            var stop = current_page + 3;
            var display = "";

            // avtive btn
            var active = "";
            for(i=0;i<count;i++){
                
                if((i + 1) <= stop && (i + 1) >= start){

                    display = "block";
                }else{
                    
                    display = "none";
                }

                // active current page
                console.log((i+1) + "==" + page);
                if((i+1) == page){
                    console.log("ACTIVE");
                    active = "active";
                }else{

                    active = "";
                }
                btn += "<li class='" + active + "' style='cursor: pointer;'><a class='page_btn' style='display: " + display + "' page='" + (i + 1) + "'>"+ (i + 1) + "</a></li>";
            }
            $(".paging_project").html(btn);
        },"json");
    }

    // action click page
    $(document).on("click", ".page_btn", function(){
        
        var current_page = $(this).attr("page");
        var search = localStorage.getItem("pro_search");
        var pro_bra_id = $("#brand_filter").val();

        // Set page to global
        localStorage.setItem("page", current_page);
        
        load_product_by_brand(10, current_page - 1, search, pro_bra_id);
        load_paging(current_page, search, pro_bra_id);
        //$(this).closest("li").addClass("active");
    });

    // Load product table 
    load_product_by_brand(10,0,"",1);
    function load_product_by_brand(limit=10, page=0, search="", pro_bra_id){

        var json = {
            'limit' : limit,
            'page' : page,
            'search' : search,
            'pro_bra_id' : pro_bra_id
        };
        $.post("C_product/api_get_product_by_brand_id", json, function(data){
            var table = "";

            if(data.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='8'> No data</td>";
                table += "</tr>"; 
                
            }else{
                for(var i=0;i< data.length;i++){

                    table += add_product_table_row((i+1) + (page * limit), data[i].pro_id, data[i].pro_model, data[i].pro_pic, data[i].pro_description, data[i].pro_cost, data[i].pro_price, data[i].pro_profit, data[i].bra_name);
                }
            }
            $("#product_table tbody").html(table);
        }, "json");
    }

    // Load unit 
    $.post("C_unit/api_get_unit", "", function(data){
        var table = "";
        for(var i=0;i< data.length;i++){

            $("#unit").append(new Option(data[i].uni_name, data[i].uni_id));
        }
        $("#product_table").append(table);
    }, "json");

    // Produc filter
    $("#brand_filter").change(function(){

        var json = {
            'pro_bra_id' : $(this).val()
        };
        load_product_by_brand(10, 0, "", json.pro_bra_id);
        load_paging(0, "", json.pro_bra_id);

    });

    // Add row to table
    function add_mini_table_row(name, data_id, data_value){
        var table = "";
        table += "<tr>";
        table += "<td id='" + name + "_" + data_id + "_field_name'>" + data_value + "</td>";
        table += "<td>";
        table += "  <i class='fa fa-fw fa-pencil-square-o change_name_" + name + "' "+name+"_id='" + data_id + "' style='cursor:pointer' data-toggle='modal' data-target='#modal-name_update'></i>"; 
        table += "  <i class='fa fa-fw fa-trash-o delete_" + name + "' data_id='" + data_id + "' style='cursor:pointer; color:red' data-toggle='modal' data-target='#modal-delete'></i>";
        table += "</td>";
        table += "</tr>";
        return table;

    }

    // Add row to product table
    function add_product_table_row(index, id, model, picture, descript, cost, price, profit){

        if(picture == null){
            picture = "no-image.png";
        }

        table = "";
        table += "<tr>";
        table += " <td>" + index + "</td>";
        table += " <td>" + model + "</td>";
        table += " <td>" + "<img src='../assert/product/" + picture + "' class='img-responsive'>" + "</td>";
        table += " <td>" + descript + "</td>";
        table += " <td>" + cost + "</td>";
        table += " <td>" + price + "</td>";
        table += " <td>" + profit + "</td>";
        table += " <td>" + "<i class='fa fa-fw fa-pencil-square-o change_product' product_id='" + id + "' style='cursor:pointer'></i>" + "<i class='fa fa-fw fa-trash-o delete_pro' data_id='" + id + "' style='cursor:pointer; color:red' data-toggle='modal' data-target='#modal-delete'></i>" + "</td>";
        table += "</tr>";

        return table;

    }

    //#############################
    // INSERT
    //#############################
    $("#add_syt").click(function(){
        var name = $("#new_name_syt").val();

        console.log(name);
        if(name){
	        var json = {
	            'syt_name' : name
	        };

	        $.post("C_system_type/api_insert_system_type", json, function(resp){
	            if(resp.status){

	                // var table = "";
	                // table = add_mini_table_row("syt", resp.system_type[0].syt_id, resp.system_type[0].syt_name);
                    // $("#system_type_table").append(table);
                    load_system_type();
	            }else{

                }
                $("#new_name_syt").val("");
	        }, "json");
	    }else{
	    	alert("Please input name");
	    }

    });

    // Brand
    $("#add_bra").click(function(){
        var name = $("#new_name_bra").val();

        if(name){
	        var json = {
	            'bra_name' : name
	        };

	        $.post("C_brand/api_insert_brand", json, function(resp){
	            if(resp.status){

	                // var table = "";
	                // table = add_mini_table_row("bra", resp.brand[0].bra_id, resp.brand[0].bra_name);
                    // $("#brand_table").append(table);
                    
                    // $.post("C_brand/api_get_brand", "", function(data){
                    //     var table = "";
                    //     for(var i=0;i< data.length;i++){
                            
                    //         $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
                    //     }
                    // }, "json");
                    load_brand();

                    // Update brand dropdown
                    $.post("C_brand/api_get_brand", "", function(data){
                        var table = "";
                        $("#brand_filter").html("");
                        for(var i=0;i< data.length;i++){

                            $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
                        }
                    }, "json");

	            }else{

                }
                $("#new_name_bra").val("");
            }, "json");
            
	    }else{
	    	alert("Please input name");
	    }

    });

    // Place type
    $("#add_plt").click(function(){
        var name = $("#new_name_plt").val();



        if(name){
	        var json = {
	            'plt_name' : name
	        };

	        $.post("C_place_type/api_insert_place_type", json, function(resp){
	            if(resp.status){

	                // var table = "";
	                // table = add_mini_table_row("plt", resp.place_type[0].plt_id, resp.place_type[0].plt_name);
                    // $("#place_type_table").append(table);
                    load_place();
	            }else{

                }
                
                $("#new_name_plt").val("");
	        }, "json");
	    }else{
	    	alert("Please input name");
	    }
    });

    // Product
    $("#btn_add_new_product").click(function(){

        $("#add_product_btn").attr("mode", "insert");    
        $("#modal-product_add").modal("show");
    });


    $("#add_product_btn").click(function(){

        var model = $("#model").val();
        var desc = $("#desc").val();
        var unit = $("#unit").val();
        var cost = $("#cost").val();
        var price = $("#price").val();
        var product_image = $("#product_image").val();
        var brand = $("#brand_filter").val();
        var profit = price - cost;

        
        var file_data = $('#product_image').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('pro_model', model);
        form_data.append('pro_description', desc);
        form_data.append('pro_uni_id', unit);
        form_data.append('pro_cost', cost);
        form_data.append('pro_price', price);
        form_data.append('pro_profit', profit);
        form_data.append('pro_bra_id', brand);
        form_data.append('pro_pic', file_data);


        if($(this).attr("mode") == "insert"){
            $.ajax({
                url: 'C_product/api_insert_product', // point to server-side PHP script 
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    if(data.status){
                        //load_product_by_brand(brand);
                        load_product_by_brand(10, 0, "", brand);
                        load_paging(0, "", brand);
                        
                        $("#modal-product_add").modal("hide");
                        $("#warning_file").html("");

                        $("#model").val("");
                        $("#desc").val("");
                        $("#unit").val("");
                        $("#cost").val("");
                        $("#price").val("");
                        $("#product_image").val("");
                    }else{

                        $("#warning_file").html(data.upload.error);
                    }
                }
            });
        }else{

            var pro_id = $(this).attr("pro_id");
            form_data.append('pro_id', pro_id);
            $.ajax({
                url: 'C_product/api_update_product', // point to server-side PHP script 
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(data){
                    if(data.status){

                        //load_product_by_brand(brand);
                        load_product_by_brand(10, 0, "", brand);
                        load_paging(0, "", brand);

                        // Clear
                        $("#model").val("");
                        $("#desc").val("");
                        $("#unit").val("");
                        $("#cost").val("");
                        $("#price").val("");
                        $("#product_image").val("");
                        $("#brand_filter").val("");

                        $("#modal-product_add").modal("hide");
                    }else{
    
                        $("#warning_file").html(data.upload.error);
                    }
                }
            });
        }
    });

    //------------ Delete
        
    $(document).on("click", ".delete_syt", function(){
        //console.log("DELETE");
        var data_id = $(this).attr("data_id");
        var row = $(this).closest("tr");
        $("#confirm_delete").click(function(){
            json = {
                "syt_id" : data_id
            }
            $.post("C_system_type/api_system_type_delete", json, function(data){

                // Check Status
                $('#modal-delete').modal('hide');
                row.remove();
            });
        });
    });

    $(document).on("click", ".delete_bra", function(){
        //console.log("DELETE");
        var data_id = $(this).attr("data_id");
        var row = $(this).closest("tr");
        $("#confirm_delete").click(function(){
            json = {
                "bra_id" : data_id
            }
            $.post("C_brand/api_brand_delete", json, function(data){

                // Check Status
                $('#modal-delete').modal('hide');
                row.remove();
            });
            // Update brand dropdown
            $.post("C_brand/api_get_brand", "", function(data){
                var table = "";
                $("#brand_filter").html("");
                for(var i=0;i< data.length;i++){

                    $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
                }
            }, "json");
        });
    });

    $(document).on("click", ".delete_plt", function(){
        //console.log("DELETE");
        var data_id = $(this).attr("data_id");
        var row = $(this).closest("tr");
        $("#confirm_delete").click(function(){
            json = {
                "plt_id" : data_id
            }
            $.post("C_place_type/api_place_type_delete", json, function(data){

                // Check Status
                $('#modal-delete').modal('hide');
                row.remove();
            });
        });
    });


    $(document).on("click", ".delete_pro", function(){
        //console.log("DELETE");
        var data_id = $(this).attr("data_id");
        var row = $(this).closest("tr");
        $("#confirm_delete").click(function(){
            json = {
                "pro_id" : data_id
            }
            $.post("C_product/api_product_delete", json, function(data){

                // Check Status
                $('#modal-delete').modal('hide');
                row.remove();

                // New index
                var index = 1;
                $("#product_table tbody tr").each(function(){
                    $(this).find("td:first").text(index++); //put elements into array
                });
            });
        });
    });
    //---------- Update

    $(document).on("click", ".change_name_syt", function(){
        var data_id = $(this).attr("syt_id");
        var data_value = $("#syt_" + data_id + "_field_name").text();

        $("#new_name").val(data_value);
        $("#new_id").val(data_id);
        $("#table").val("system_type");
    });


    $(document).on("click", ".change_name_bra", function(){
        var data_id = $(this).attr("bra_id");
        var data_value = $("#bra_" + data_id + "_field_name").text();

        $("#new_name").val(data_value);
        $("#new_id").val(data_id);
        $("#table").val("brand");
    });


    $(document).on("click", ".change_name_plt", function(){
        var data_id = $(this).attr("plt_id");
        var data_value = $("#plt_" + data_id + "_field_name").text();
        $("#new_name").val(data_value);
        $("#new_id").val(data_id);
        $("#table").val("place_type");
    });
    

    $("#update_name").click(function(){

        var type = $("#table").val();

        if(type == "place_type"){

            var json = {
                "plt_id" : $("#new_id").val(),
                "plt_name" : $("#new_name").val()
            };

            $.post("C_place_type/api_place_type_update", json, function(data){
                
                console.log(data);
                if(data.status == 1){
                    $("#plt_"+data.place_type[0].plt_id+"_field_name").text($("#new_name").val());
                }
            }, "json");
        }else if(type == "brand"){

            var json = {
                "bra_id" : $("#new_id").val(),
                "bra_name" : $("#new_name").val()
            };

            $.post("C_brand/api_brand_update", json, function(data){
                
                if(data.status == 1){
                    $("#bra_"+data.brand[0].bra_id+"_field_name").text($("#new_name").val());
                }
            }, "json");

            // Update brand dropdown
            $.post("C_brand/api_get_brand", "", function(data){
                var table = "";
                $("#brand_filter").html("");
                for(var i=0;i< data.length;i++){

                    $("#brand_filter").append(new Option(data[i].bra_name, data[i].bra_id));
                }
            }, "json");
        }else if(type == "system_type"){

            var json = {
                "syt_id" : $("#new_id").val(),
                "syt_name" : $("#new_name").val()
            };
    
            $.post("C_system_type/api_system_type_update", json, function(data){
                
                if(data.status == 1){
                    $("#syt_"+data.system_type[0].syt_id+"_field_name").text($("#new_name").val());
                }
            }, "json");
        }
    });

    $(document).on("click", ".change_product", function(){
        var json = {"pro_id" : $(this).attr("product_id")};
        $.post("C_product/api_get_product_by_id", json, function(data){
            
            $("#model").val(data[0].pro_model);
            $("textarea#desc").val(data[0].pro_description);
            $("#unit").val(data[0].pro_uni_id);
            $("#cost").val(data[0].pro_cost);
            $("#price").val(data[0].pro_price);
            //$("#product_image").val(data[0].pro_pic);
            $("#modal-product_add").modal("toggle");
            $("#add_product_btn").attr("pro_id", data[0].pro_id);

        }, "json");
        $("#add_product_btn").attr("mode", "update");
        $("#add_product_btn").attr("pro_id", $(this).attr("product_id"));
    });

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
});
