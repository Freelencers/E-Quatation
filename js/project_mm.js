$(document).ready(function(){

    // Load project table 
    load_project(5, 0, "");
    function load_project(limit=10, page=0, search=""){
        var json = {
            "limit" : 10,
            "page" : page,
            "search" : search
        };
        console.log(limit + " : " + page);
        $.post("C_project/api_get_project", json, function(data){
            var table = "";
            if(data.project.length == 0){
                var table = "";
                table += "<tr>";
                table += "  <td colspan='7'> No data</td>";
                table += "</tr>"; 
            }else{
                for(var i=0;i< data.project.length;i++){
                    table += add_project_row(((page * limit) + i + 1), data.project[i].prj_title, data.project[i].prj_company, data.project[i].prj_customer_name, data.project[i].ctp_name, data.project[i].sta_name, data.project[i].prj_id);
                }
            }
            $("#project_table tbody").html(table);
        }, "json");
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
            var count = Math.round(data.project.length / 10);
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
        
        load_project(10, current_page - 1, search);
        load_paging(current_page, search);
        $(this).closest("li").addClass("active");
    });
    //######################

    $(document).on("click", ".delete", function(){
        $("#confirm_delete").attr("prj_id", $(this).attr("prj_id"));
        $("#modal-delete").modal("show");
    });
    
    $(document).on("click", "#confirm_delete", function(){
        console.log("REMOVE");
        var json = {
            "prj_id" : $(this).attr("prj_id")
        };
        $.post("C_project/api_delete_project", json, function(){

        }, "json");
        $("#"+json.prj_id+"_field_name").closest("tr").remove();
        reset_index();
        $("#modal-delete").modal("hide");
    });

    function add_project_row(index, project_name, company, customer, type, status, data_id){
        console.log("ADD ROW");
        var table = "";
        table += "<tr>";
        table += "<td>" + index + "</td>";
        table += "<td id='" + data_id + "_field_name'>" + project_name + "</td>";
        table += "<td id='" + data_id + "_field_type'>" + company + "</td>";
        table += "<td id='" + data_id + "_field_location'>" + customer + "</td>";
        table += "<td id='" + data_id + "_field_company'>" + type + "</td>";
        table += "<td id='" + data_id + "_field_company'>" + status + "</td>";
        table += "<td>";
        table += "  <a href='C_project_mm/detail_project/" + data_id +"'><i class='fa fa-fw fa-file-text' style='cursor:pointer' data-toggle='modal' data-target='#modal-detail'></i></a>";
        table += "  <a href='C_project_mm/edit_project/" + data_id +"'><i class='fa fa-fw fa-pencil-square-o' style='cursor:pointer' data-toggle='modal' data-target='#modal-brand_update'></i></a> "; 
        table += "  <i class='fa fa-fw fa-trash-o delete' prj_id="+data_id+" style='cursor:pointer; color:red'></i> ";
        table += "</td>";
        table += "</tr>";
        return table;
    }

    function reset_index(table_id="project_table"){

        console.log("reset index");
        // New index
        var index = 1;
        $("#" + table_id + " tbody tr").each(function(){
            $(this).find("td:first").text(index++); //put elements into array
        });
    }

});
