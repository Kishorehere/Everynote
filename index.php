
<?php
	require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?>	
<?php
	$sno = 0;
	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users WHERE username ='$userName'";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);


	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query_2 ="DELETE FROM notes WHERE id = '$id';";
		$result_2 =mysqli_query($conn, $query_2);

	}

	if(isset($_GET['idd'])){
		$idd = $_GET['idd'];
		$query_2 ="DELETE FROM todo WHERE id = '$idd';";
		$result_2 =mysqli_query($conn, $query_2);

	}

	$query_2 ="SELECT * FROM notes WHERE username ='$userName' ORDER BY dt DESC";
	$result_2 =mysqli_query($conn, $query_2);
	$notes = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
	mysqli_free_result($result_2);

	$query_2 ="SELECT * FROM todo WHERE username ='$userName'";
	$result_2 =mysqli_query($conn, $query_2);
	$tasks = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
	mysqli_free_result($result_2);

	if(isset($_POST['order'])){
		if($_POST['choice']=="Title"){
			$query_1 ="SELECT * FROM notes WHERE username ='$userName' ORDER BY title ASC;"; 
		}
		else if($_POST['choice']=="Last Update time (oldest to newest)"){
			$query_1 ="SELECT * FROM notes WHERE username ='$userName' ORDER BY dt ASC;"; 
		}
		else if($_POST['choice']=="Last Update time (newest to oldest)"){
			$query_1 ="SELECT * FROM notes WHERE username ='$userName' ORDER BY dt DESC;"; 
		}
		else if($_POST['choice']=="color"){
			$query_1 ="SELECT * FROM notes WHERE username ='$userName' ORDER BY type;"; 
		}
		$result_1 =mysqli_query($conn, $query_1);
		$notes = mysqli_fetch_all($result_1, MYSQLI_ASSOC);
		mysqli_free_result($result_1);
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

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		 

		 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: black;border-radius: 10px;border-width: 5px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">
				
				<div style="margin-left:10%;">
					<h1 style ="margin-left:30px;color:black;"><strong><u>TO-DO</u> :</strong></h1>	
				</div>

			
		

				<form method = "POST" action = "index.php" >
					<div class="row justify-content-start" style ="margin-left:130px;margin-top: 70px;">
						    <strong style="margin-top:5px;margin-left:90px;">Task :</strong>
						    <div class="col-md-3">
						          <input type="text" name = "task" class ="<?php echo $taskClass;?>" placeholder="Enter task">
						          <div class = "invalid-feedback">Enter the task to create</div>
						    </div>
						    <strong style="margin-top:5px;">color :</strong>
						    <div class="col-md-3"> 
							      <select class="custom-select mr-sm-2" name = "color">
							        <option value="Blue">Blue</option>
							        <option value="Green">Green</option>
							        <option value="Red">Red</option>
							        <option value="Yellow">Yellow</option>
							        <option value="Black">Black</option>
							        
							     </select>
						    </div>
							<div class="col-md-3">
					    		<div>
					    			<button type = "submit" class = "btn btn-primary" name ="todo" >Create</button>
					    		</div>  
					    	</div>
					</div>  	
				</form>



				
				<table class="table table-dark" style = "margin-top:5%;margin-left:10%;width:80%;">
					<thead>
						<tr>
					      <th scope="col">#</th>
					      <th scope="col">Tasks to be done</th>   
					    </tr>
					</thead>
				<tbody>
				  <?php foreach($tasks as $task) : ?>
				   <?php $sno = $sno+1;?>

				   <?php $color_1 = $task['color'];		

	    				switch($color_1){
						case 'Blue':
							$taskClass="table-primary";
							break;
						case 'Green':
							$taskClass="table-success";
							break;
						case 'Red':
							$taskClass="table-danger";
							break;
						case 'Yellow':
							$taskClass="table-warning";
							break;
						case 'Black':
							$taskClass="table-dark";
							break;
						
						}

					?>

				   <tr class="<?php echo $taskClass; ?>">
				      <th scope="row" style="width:50px;"><?php echo$sno;?></th>
				      <td style ="padding-bottom:0px;margin-bottom: 0px;" >
				      	<form class="was-validated">
					          <div class="custom-control custom-checkbox mb-3">
					            <input type="checkbox" style="margin-right:20px;" class="custom-control-input" id="customControlValidation<?php echo $sno;?>" required>
					            <label class="custom-control-label" for="customControlValidation<?php echo $sno;?>"><?php echo $task['task']; ?></label>
					          </div>
					    </form>
					    <a class = "btn btn-success" style ="margin-bottom:20px;" href="index.php?idd=<?php echo $task['id']; ?>">Completed task</a>
					  </td>
				      
				    </tr>
				   <?php endforeach ; ?>
				  </tbody>
				</table>
		



		</div>
		

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->



	<div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: black;border-radius: 10px;border-width: 5px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">	
		<div class="row justify-content-end">
			<div class="col-md-8">
				<h1 style ="margin-left:30px;color:black;"><strong><u>Notes</u> :</strong></h1>
			</div>

			<div class="col-md-3">
				<a href="create.php" class="btn btn-primary">Create Note</a>
			</div>
		</div>

		<form method = "POST" action = "index.php" >
			<div class="row justify-content-end" style ="margin-left:130px;margin-top: 100px;">
				    <strong style="margin-top:5px;">Arrange By:</strong>
				    <div class="col-md-6">
				      <select class="custom-select" name = "choice">
				        <option value="Last Update time (newest to oldest)">Last Update time (newest to oldest)</option>
				        <option value="Last Update time (oldest to newest)">Last Update time  (oldest to newest)</option>
				        <option value="color">Color</option>
				        <option value="Title">Title</option> 
				      </select> 
				      <small>By default it is - Last Update time (newest to oldest)</small> 
				    </div>
					<div class="col-md-4">
			    		<div>
			    			<button type = "submit" style="width:120px;" class = "btn btn-outline-warning" name ="order" >Apply</button>
			    		</div>  
			    	</div>
			</div>  	
		</form>


		<div style="margin:50px;">
			    <div class="card-deck" >
			    	<?php foreach($notes as $note) : ?>
			    		<?php $color = $note['type'];

			    				$cardClass='card text-white';


			    				switch($color){
								case 'Blue':
									$cardClass=$cardClass." "."bg-primary";
									break;
								case 'Green':
									$cardClass=$cardClass." "."bg-success";
									break;
								case 'Red':
									$cardClass=$cardClass." "."bg-danger";
									break;
								case 'Yellow':
									$cardClass=$cardClass." "."bg-warning";
									break;
								case 'Black':
									$cardClass=$cardClass." "."bg-dark";
									break;
								case 'White':
									$cardClass="card bg-light";
									break;

							}
			    		?>
			    		
			   
						<div class="<?php echo $cardClass ; ?>" style="min-width: 20rem;max-width: 20rem;">
						    <img class="card-img-top" src=<?php echo $note['image']; ?> alt="Image Description">
						    <div class="card-body">
						      <h5 class="card-title"><?php echo $note['title'];?></h5>
						      <p class="card-text"><?php echo $note['content'];?></p>
						    </div>
						    <div class="card-footer">
						    	<div class="row">
						    		<div class ="col-6">
							    		<a class = "btn btn-secondary" href="card.php?id=<?php echo $note['id']; ?>">Edit Note</a>
							    	</div>
							    	<div class ="col-6">
							    		<a class = "btn btn-secondary" href="index.php?id=<?php echo $note['id']; ?>">Remove Note</a>
							    	</div>
							    </div>
						      	<small>Last updated at <?php echo $note['dt'];?></small>
						    </div>
						</div>
					
					<?php endforeach;?>
				</div>
			</div>
		</div>

				
			
		
		




	
	



	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php endif; ?>