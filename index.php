<?php include 'include/connect.php'; ?>
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Details</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome-master/css/font-awesome.min.css">
</head>

<body>

    <div id="wrapper" class="container">
            <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Details</h1>
                    
                </div>
                 <div id="errormsg">
                     
                 </div>             
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                
                            <div class="col-md-6">
	                    	<span>Details</span>
                            </div>
                            <div class="col-md-6">
                            <div class="pull-right">
                                <form action="" method="post">
                                    <div class="form-group input-group" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </span>
                                        <input type="text" name="key" placeholder="Search" id="key" class="form-control">
                                    </div>
                                </form>
                            </div>
                            </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body" style="overflow: auto !important;">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="tableData">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>department_id</th>
                                        <th>department_name</th>
                                        <th>manager_id</th>
                                        <th>first_name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query="SELECT dept.department_id, dept.department_name, dept.manager_id, emp.first_name  FROM departments dept  INNER JOIN employees emp ON dept.manager_id = emp.employee_id";
                                        $count=0;
                                        $res=$con->query($query);
                                        while ($row=$res->fetch_assoc()) {
                                    ?>
                            	    <tr class="odd gradeX">
										<td><?=++$count?></td>
										<td><?=$row['department_id']?></td>
                                        <td><?=$row['department_name']?></td>
                                        <td><?=$row['manager_id']?></td>
										<td><?=$row['first_name']?></td>
                                    </tr>
                                <?php } ?>	   
							</tbody>
                            </table>
                        </div>
                        </form>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
  </div>

<script src="assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#key").on("change past keyup",function(){
        var val=($("#key").val())?$("#key").val():"all";
        var route='getdata.php?key='+val;
        if (val){
            $.post({
                type: 'GET',
                url: route,
                data: null,
                contentType: false,
                cache: false,
                processData:false,
                
                success: function(msg){
                            $("#tableData tbody tr").css("display","none");
                    if (msg!="error"){
                        var tbody=$("#tableData tbody");
                            $("#tableData tbody").append(msg);
                    }
                    if (msg=="error"){
                        var element='<tr class="odd gradeX text-center"><td colspan="5"> No Record Found </td></tr>';
                            $("#tableData tbody").append(element);
                    }       
                }
            });
        }
    });
});
</script>
</body>
</html>