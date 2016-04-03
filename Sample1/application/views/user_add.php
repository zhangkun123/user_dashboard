<? require_once('include/header.php');	?>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#add_user').submit(function(){
					var form = $(this);

					$.post(form.attr('action'), form.serialize(), function(data){
						if(data.status){
							$('#message_box').html('<p class="alert alert-success">'+ data.success_message +'</p>').removeClass('alert alert-error')
						}
						else{
							$('#message_box').addClass('alert alert-error').html(data.error_message)
						}
					}, 'json');

					return false;
				});
			});
		</script>
<? require('include/navigation.php')	?>
		<div class="container">
			<div class="row">
				<div class="span12">
					<div id="message_box"></div>
					<div class="pull-left">
					<h3>Add a new user</h3>
					<h3>Register</h3>
						<form id="add_user" action="/users/user_registration" class="form-horizontal">
							<div class="control-group">
								<label for="email">Email</label>
								<input type="text" name="email">
								<label for="first_name">First Name:</label>
								<input type="text" name="first_name">
								<label for="last_name">Last Name:</label>
								<input type="text" name="last_name">
								<label for="password">Password:</label>
								<input type="password" name="password">
								<label for="conf_password">Password Confirmation:</label>
								<input type="password" name="re_password">
							</div>
							<div class="control-group">
								<input type="submit" value="Add User" class="btn btn-success">
							</div>
						</form>
					</div>
					<a href="" class="btn btn-mini btn-primary pull-right">Return to Dashboard</a>
				</div>
			</div>
		</div>
	</body>
</html>