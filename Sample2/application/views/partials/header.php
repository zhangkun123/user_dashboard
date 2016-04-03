<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Dashboard</title>
	<link rel="stylesheet" type="text/css" 
	      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script type="text/javascript" 
	        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
	</script>
	<style type="text/css">
		body { padding-top: 10px; }
		footer{
				padding: 10px;
				margin: 30px;
				background: #ccc;
				border-radius: 10px;
		       }
		footer p{
			font-size: 15px;
			font-weight: bold;
			font-style: italic;
			font-family: Verdana, Geneva, sans-serif;

		}
		.action_form .btn
		{
			margin: 5px;
		}

	</style>
</head>
<body class="container">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/">Test App</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	   <?php if($current_user) 
			 {?>
	        <li class="active">
				<a href="/dashboard">Dashboard<span class="sr-only">(current)</span>
	        	</a>
	        </li>
	         <li>
				<a href="/dashboard/profile">Profile<span class="sr-only">(current)</span>
	        	</a>
	        </li>
		<?php  }
			 else
			  {?>
			 <li class="active">
				<a href="/">Home<span class="sr-only">(current)</span>
	        	</a>
	        </li>
	   <?php   }?>
	      </ul>
	       
	<?php if($current_user )
	{?>
		  <ul class="nav navbar-nav navbar-right">
	        <li>
	        	 <a  href="/access/logout"><?php $user = $current_user ;
	        		echo $user['user_name'];?><br>Logout</a>
	        </li>
	      </ul>
	      <?php }
	      else
	      {?>
		  <ul class="nav navbar-nav navbar-right">
	        <li><a  href="/access/login">Sign In</a></li>
	      </ul>
	<?php }?> 
	     
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
    </nav>	
    <div>
    	<?php if($this->session->flashdata('success_message'))
	{?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('success_message');?>
	</div>	
<?php }  ?>

    </div>
    <div>
    	<?php if($this->session->flashdata('error_message'))
	{?>
	<div class="alert alert-danger">
		<?php echo $this->session->flashdata('error_message');?>
	</div>	
<?php }  ?>
    </div>
  