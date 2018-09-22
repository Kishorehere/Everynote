<?php
	define ('DB_Host','localhost');
	define ('DB_User','root');
	define ('DB_Password','123456');

	$conn = mysqli_connect(DB_Host,DB_User,DB_Password,'registration');
	if(!$conn){
		die("connection error".mysql_error());
		$dbcr="create database registration";
		if(!(mysqli_query($conn,$dbcr))){
			echo "Error creating the Database";
		}
	}
	$table="select * from users";
	if(!(mysqli_query($conn,$table))){
		$create1="create table users(id int(11) NOT NULL AUTO_INCREMENT,username varchar(255) NOT NULL,email varchar(255) NOT NULL, password varchar(255) NOT NULL, name varchar(255), firstName varchar(255), lastName varchar(255), PRIMARY KEY(id))";
		$ok1=mysqli_query($conn,$create1);
		$create2="create table notes(id int(11) NOT NULL AUTO_INCREMENT,username varchar(255) NOT NULL, title text NOT NULL, content text NOT NULL, dt timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,image varchar(255), type varchar(255), PRIMARY KEY(id))";
		$ok2=mysqlia_query($conn,$create2);
		$create3="create table todo(id int(11) NOT NULL AUTO_INCREMENT,username varchar(255) NOT NULL,task text NOT NULL, color varchar(255) NOT NULL, PRIMARY KEY(id))";
		$ok3=mysqli_query($conn,$create3);
		if((!ok1)||(!ok2)||(!ok3)){
			echo "Error in creating tables";
		}

	}
?>