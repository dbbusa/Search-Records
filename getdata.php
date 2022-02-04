<?php 
$data="";
$count=0;
	include 'include/connect.php';

if (isset($_GET['key'])) {

	$key=(($_GET['key'] != 'all')?"LIKE '%".$_GET['key']."%'":"");
	$query="SELECT dept.department_id, dept.department_name, dept.manager_id, emp.first_name  FROM departments dept  INNER JOIN employees emp ON dept.manager_id = emp.employee_id WHERE CONCAT_WS('',dept.department_id, dept.department_name,dept.manager_id,emp.first_name)".$key;
	if ($res=$con->query($query)){
		if ($res->num_rows != 0) {
		while ($row=$res->fetch_assoc())
			$data.='<tr class="odd gradeX"><td>'. ++$count .'</td> <td>'.$row['department_id'].'</td> <td>'.$row['department_name'].'</td> <td>'.$row['manager_id'].'</td><td>'.$row['first_name'].'</td></tr>';
		echo $data;
		}
		else{
			echo "error";
		}
	}
	else
		echo "error";
}
?>