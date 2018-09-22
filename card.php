<?php
	
	$imageLink = "picture.jpg";
	require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?>	
<?php


	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users WHERE username ='$userName'";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);
	$id = $_GET['id'];
	$edit = 0;

	if(isset($_GET['edit'])){
		$edit = $_GET['edit'];
	}
	
	$userName = $_SESSION['userName'];
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		//echo $id;
		$query_2 ="SELECT * FROM notes WHERE id = '$id';";
		$result_2 =mysqli_query($conn, $query_2);
		$value_1 = mysqli_fetch_assoc($result_2);

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Note-Pad</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>

	

		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		    <a href="#" class="navbar-brand">Note-Pad</a>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      	 <li class="nav-item"><a href="index.php"class = "nav-link">Home</a></li>
		        <li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link">Profile</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
		        </ul>
		    </div>
		</nav>
		

		<div class="modal fade" id = "demo">
	      <div class ="modal-dialog">
	        <div class = "modal-content">
	          
	          <div class = "modal-header">
	            <h2 class = "modal-title">Profile</h2>
	            <span type ='button' class = "close" data-dismiss = "modal">&times;</span>
	          </div>
	          <div class = "modal-body">
	          	
	          	<table class="table table-dark">
				  <tbody>
				    <tr >
				      <th scope="row">Name: </th>
				      <td ><?php echo $value['name']; ?></td>
				      
				    </tr>
				    <tr class="bg-primary">
				      <th scope="row">E-mail: </th>
				      <td><?php echo $value['email']; ?></td>
				     
				    </tr>
				    <tr class="bg-danger">
				      <th scope="row">Username: </th>
				      <td><?php echo $userName; ?></td>
				      
				    </tr>
				  </tbody>
				</table>
	         
	          </div>
	          <div class = "row" style ="padding-top: 0;padding-bottom: 1.5rem;padding-left: 1rem;">
		        <div class = "col-md-6 col-sm-6 col-xs-6">
		           <a href="editProfile.php"><button type = "button" class = "btn btn-success" >Edit Profile</button></a>
		        </div>
		        <div class = "col-md-6 col-sm-6 col-xs-6">
	            	 <a href="changePass.php"><button type = "button" class = "btn btn-success" >Change Password</button></a>
	          	</div>
	          </div>

	        </div>
	      </div>
	    </div>
		

		<div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: yellow;border-radius: 10px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">
      
		      <form method = "POST" style = "width: 60%; margin:auto;" action ="card.php?edit=1&id=<?php echo $id; ?>">
		      	
			      	<div class = "form-group" style = "text-align: center;margin-bottom:10%;">
			      		<h2><strong>Edit Note</strong></h2>
			      	</div>
		        	
		            <div class = "form-group">
		              <label>Title</label>
		              <input type="text" name = "title" class ="<?php echo $titleClass;?>" placeholder="Title" value="<?php echo isset($_POST['title']) ? $title : $value_1['title'];?>">
		              <div class = "invalid-feedback"><?php echo $titleComment; ?></div>
		              <div class = "valid-feedback">Looks Good!</div>
		            </div>

		            <div class="form-group">
					    <label>Content</label>
					    <textarea class="<?php echo $contentClass;?>" name="content" rows="3"  placeholder="Note to be stored" ><?php echo isset($_POST['content']) ? $content : $value_1['content'];?></textarea>
					    <div class = "invalid-feedback"><?php echo $titleComment; ?></div>
		              	<div class = "valid-feedback">Looks Good!</div>
					</div>

					<div class = "form-group">
		              <label>Image</label>
		              <input type="text" name = "image" class ="form-control" placeholder="image name with extension" value="<?php echo isset($_POST['image']) ? $imageLink : $value_1['image'];?>">
		              <small>If left empty, default image will be used</small>
		            </div>


					<div class="form-row align-items-center">
					    <div class="col-auto my-1">
					      <label class="mr-sm-2">Note Color</label>
					      <select class="custom-select mr-sm-2" name = "type">
					        <option selected><?php echo isset($_POST['type']) ? $color : $value_1['type'];?></option>
					        <option value="Blue">Blue</option>
					        <option value="Green">Green</option>
					        <option value="Red">Red</option>
					        <option value="Yellow">Yellow</option>
					        <option value="Black">Black</option>
					        <option value="White">White</option>
					      </select>
					      
					    </div>
					</div>
		         
			        <div class="row">
			        	<div class = "col">
			        		<div style = "margin-left: 34%;margin-top: 30px;">
			        			<button type = "submit" class = "btn btn-outline-warning" style="width:200px;" name ="create" >Save Changes</button>
			        		</div>
			        	</div>
			        </div>
		   
		      	</form>
  		</div>
	    
		
		




	
	



	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>