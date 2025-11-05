<?php
include("dbcon/dbcon.php");
if(isset($_POST['displaySend'])){
	
  $table ='<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
	  <th scope="col">Location</th>
	  <th scope="col">Operation</th>
    </tr>
  </thead>';
  $sql = "SELECT * from crud ";
  $result = mysqli_query($con,$sql);
  $number =1;
  while($row = mysqli_fetch_assoc($result)){
	$id = $row['id'];
	$table .='<tr>
	  <td scope="row">'.$number.'</td>
	  <td>'.$row['name'].'</td>
	  <td>'.$row['email'].'</td>
	  <td>'.$row['phone'].'</td>
	  <td>'.$row['place'].'</td>
	  <td>
	  <button class="btn btn-dark" onclick="UpdateData('.$id.')">View/Update</button>
	  <button class="btn btn-danger" onclick="DeleteUsa('.$id.')" ">Deltete</button>
	  </td>
	 </tr>';
	 $number++;
 }
	$table.='</table>';
	echo $table;
}	
?>