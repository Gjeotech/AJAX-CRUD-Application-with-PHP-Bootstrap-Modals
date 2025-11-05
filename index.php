
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width-device-width, inital-scale=1">

<title>PHP PDO CRUDE</title>
   <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

<style>

@keyframes fade-out{
    0%{
        opacity:1;
    }
    100%{
        opacity:0;
    }
}

#fade-in-out {
    animation: fade-out 10s infinite alternate;
    text-align: center;
    color: navy;
}

.btn btn-danger{
    animation: fade-out 10s infinite alternate;
    text-align: center;
    color: navy;
}


</style>
</head>
<body>


<!-- INSERT Modal -->
<div class="modal fade" id="completModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Staff Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="completname">Enter Nmae</label>
			<input type="text" class="form-control" id="completname" placeholder="Enter your  name" required>
			
		</div>
		<div class="form-group">
			<label for="completemail">Enter Email</label>
			<input type="text" class="form-control" id="completemail" placeholder="Enter your email" required>
			
		</div>
		<div class="form-group">
			<label for="completmobile">Phone Number</label>
			<input type="text" class="form-control" id="completmobile" placeholder="Enter your mobile number" required>
			
		</div>
		<div class="form-group">
			<label for="completlocation">Location</label>
			<input type="text" class="form-control" id="completlocation" placeholder="Enter your Location" required>
			
		</div>
      </div>
      <div class="modal-footer" >
	  
        <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		
      </div>
    </div>
  </div>
</div>

<!-- Updata Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Updata Staff Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="updatename">Enter Nmae</label>
			<input type="text" class="form-control" id="updatename" placeholder="Enter your  name">
			
		</div>
		<div class="form-group">
			<label for="updateemail">Enter Email</label>
			<input type="text" class="form-control" id="updateemail" placeholder="Enter your email">
			
		</div>
		<div class="form-group">
			<label for="updatphone">Phone Number</label>
			<input type="text" class="form-control" id="updatphone" placeholder="Enter your mobile number">
			
		</div>
		<div class="form-group">
			<label for="updatplace">Location</label>
			<input type="text" class="form-control" id="updatplace" placeholder="Enter your Location">
			
		</div>
      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-dark" onclick="updateDetails()" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>


<div class="container my-3">
<h2 class="text-center" id="fade-in-out">Ajax CRUD operator using Bootstrap Modal</h2>

<button type="button" class="btn btn-dark my-5" data-toggle="modal" data-target="#completModal" style="float:right">
  Add New Staff
</button>
	<div id="displayDataTable"></div>
</div>


<!--js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>


<script>
// to prevent disaperance of table when refresh the page
$(document).ready(function(){
	displayData()
})

//display data function
function displayData(){
	var displayDatal ="true";
	$.ajax({
		url:"display.php",
		type:"post",
		data:{
			displaySend:displayDatal
		},
		success:function(data,status){
			$('#displayDataTable').html(data)
		}
	})
}



function adduser(){
var nameAdd = $('#completname').val()
var emailAdd = $('#completemail').val()
var mobileAdd = $('#completmobile').val()
var placeAdd  = $('#completlocation').val()

//conditional insert statement 
if(nameAdd === "" || emailAdd === "" || mobileAdd === "" || placeAdd === "") {
	alert("Please fill in all fields.");
} else {

$.ajax({
	url:"insert.php",
	type:"post",
	data:{
		nameSend:nameAdd,
		emailSend:emailAdd,
		mobilSend:mobileAdd,
		placeSend:placeAdd
	},
	success:function(data,status){
		$('#completModal').modal("show")
				
		// Clear input fields
		$("#completname").val('');
		$("#completemail").val('');
		$("#completmobile").val('');
		$("#completlocation").val('')
		
		alert("Data Inserted successfully!");
		displayData()
	}
			
})

}
}

//delete data

function DeleteUsa(deleteid){
	//conditional delete statement 
	if(confirm("Are you sure you want to delete this data?")) {
	$.ajax({
		url:"delete.php",
		type:"post",
		data:{
			deleteSend:deleteid
		},
	   success:function(data,status){
			displayData()
		}
	})
	}
}


//update function

function UpdateData(updateid){
	$('#hiddendata').val(updateid)
	$.post("update.php",{updateID:updateid},
	function(data,status){
		var userid=JSON.parse(data)
		$('#updatename').val(userid.name)
		$('#updateemail').val(userid.email)
		$('#updatphone').val(userid.phone)
		$('#updatplace').val(userid.place)
		})
		
	
	$('#updateModal').modal("show")
}

// onclick calling update button
 function updateDetails(){
	 var updatename = $('#updatename').val()
	 var updateemail = $('#updateemail').val()
	 var updatphone = $('#updatphone').val()
	 var updatplace = $('#updatplace').val()
	 var hiddendata = $('#hiddendata').val()
	 
	 $.post("update.php",{
		 updatename:updatename,
		 updateemail:updateemail,
		 updatphone:updatphone,
		 updatplace:updatplace,
		 hiddendata:hiddendata
		 
	 },function(data,status){
		 $('#updateModal').modal("hide")
		 
		alert("Data updated successfully!");
		 displayData()
	 })
 }


</script>

</body>
</html>