<?php
	require('server.php');
?>
<?php if(isset($_SESSION['userName'])) : ?> 
<?php

	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users WHERE username ='$userName'";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
	
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
		    <a href="#" class="navbar-brand">Note-Pad</a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		        <li class="nav-item"><a href="index.php" class = "nav-link">Home</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
		        </ul>
		    </div>
		</nav>
	

 <div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%;border: solid;border-color: yellow;border-radius: 10px; margin: auto;margin-top: 5%;margin-bottom: 5%; align-self: center;">
      <form method = "POST" style = "width: 60%; margin:auto;" action ="editProfile.php">
      	<div class = "form-group" style = "color:black;text-align: center;margin-bottom:10%;font-weight: bolder;">
      		<h2><strong>Edit Profile</strong></h2>
      	</div>
        <div class = "row">
          <div class = "col-md-6">
            <div class = "form-group">
              <label>First Name : </label>
              <input type="text" name = "firstName" class ="<?php echo $firstClass;?>" placeholder="First Name" value="<?php echo isset($_POST['firstName']) ? $firstName : $value['firstName'];?>">
              <div class = "invalid-feedback"><?php echo $firstComment; ?></div>
              <div class = "valid-feedback">Looks Good!</div>
            </div>
          </div>
          <div class = "col-md-6">
            <div class = "form-group">
              <label>Last Name : </label>
              <input type="text" name = "lastName" value="<?php echo isset($_POST['lastName']) ? $lastName : $value['lastName'];?>" class ="<?php echo $lastClass;?>" placeholder="Last Name">
              <div class = "invalid-feedback"><?php echo $lastComment; ?></div>
              <div class = "valid-feedback">Looks Good!</div>
              
            </div>
          </div>
        </div>
        <div class = "form-group">
          <label>Email : </label>
          <div class="input-group">
	          <div class="input-group-prepend">
	          	<span class="input-group-text" id="inputGroupPrepend">@</span>
	          </div>
	          <input type="text" name = "email" value="<?php echo isset($_POST['email']) ? $email : $value['email']; ?>" class ="<?php echo $emailClass;?>" placeholder="example.com">
	          <!--Not using type="email" for server side validation -->
	          <div class = "invalid-feedback"><?php echo $emailComment; ?></div>
	          <div class = "valid-feedback">Looks Good!</div>
          </div>
        </div>
        
        <div class="row">
        	<div class = "col">
        		<div style = "margin-left: 34%;margin-top: 30px;">
        			<button type = "submit" class = "btn btn-warning" style="width:200px;" name ="update" >Update Profile</button>
        		</div>
        	</div>
        </div>
       
        
      </form>
	


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
</body>
</html>
<?php endif; ?>