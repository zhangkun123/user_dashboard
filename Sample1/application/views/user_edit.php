<?php require('include/header.php'); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('.edit_user').submit(function(){
					var form = $(this);

					$.post(form.attr('action'), form.serialize(), function(data){
						if(data.status){
							$('#message_box').html('<p class="alert alert-success">'+ data.success_message +'</p>').removeClass('alert alert-error')
						}
						else{
							$('#message_box').html(data.error_message).addClass('alert alert-error')
						}
					}, 'json');

					return false;
				});
			});
		</script>
<?php require('include/navigation.php')	?>
		<div class="container">
			<div class="row">
				<div class="span12">
						<h3 class="pull-left">Edit User Profile</h3>
					<div class="pull-right">	
<?php 	if($user_level == ADMIN)
		{ 	?>
						<div class="btn-group">
							<a href="#" data-toggle="dropdown" class="btn btn-mini btn-primary dropdown-toggle">Edit other users</a>
							<ul class="dropdown-menu">
<?php 		if(count($other_users) > 0)
			{
				foreach($other_users as $other_user)	
				{	
						echo'	<li>
									<a href="/users/edit/' . $other_user->id . '">' . $other_user->email . '</a>
								</li>';
		   		}	
			}
			else
			{	?>
								<li>No other users</li>
<?php 		}	?>					
							</ul>
						</div>
<?php 	}
		else
		{							
				echo '	<a href="/users/show/' . $user->id . '" class="btn btn-mini btn-link">Back to my profile</a>';
		}	?>						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div id="message_box"></div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<div class="well">
						<h3>Edit Information</h3>
						<form id="update_user_info" action="/users/update_user/<?php echo $user->id; ?>" method="post" class="edit_user form-horizontal">
							<div class="control-group">
								<label for="email">Email Address:</label>
								<input type="text" name="email" value="<?php echo $user->email; ?>">
								<label for="first_name">First Name:</label>
								<input type="text" name="first_name" value="<?php echo $user->first_name; ?>">
								<label for="last_name">Last Name</label>
								<input type="text" name="last_name" value="<?php echo $user->last_name; ?>">
							
								<label for="user_level">User Level:</label>
								<select name="user_level" id="user_level">
									<option value="1">Normal</option>														
									<option value="9" <?php echo $user->user_level == ADMIN ? "selected='selected'" : ""; ?>>Admin</option>							
								</select>								
							
							</div>
							<div class="control-group">
								<input type="submit" value="Save" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
				<div class="span6">
					<div class="well">
						<h3>Change Password</h3>
						<form id="update_user_password" action="/users/update_user/<?php echo $user->id; ?>" method="post" class="edit_user form-horizontal">
							<div class="control-group">
								<label for="password">Password:</label>
								<input type="password" name="password">
								<label for="re_password">Password Confirmation:</label>
								<input type="password" name="re_password">
							</div>
							<input type="submit" value="Update Password" class="btn btn-success">
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<div class="well">
						<h3>Edit Description</h3>
						<form id="update_user_description" action="/users/update_user/<?php echo $user->id; ?>" method="post" class="edit_user form-horizontal">
							<div class="control-group">
								<textarea name="description" placeholder=""><?php echo $user->description; ?></textarea>
							</div>
							<input type="submit" value="Save" class="btn btn-success">
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>