<? require('include/header.php')	?>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#register_form').submit(function(){
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
				<div class="span4">
					<div id="message_box"></div>
					<form id="register_form" action="/users/user_registration" method="post" class="form-horizontal">
						<h3>Register</h3>
						<div class="control-group">
							<label for="email">Email Address:</label>
							<input type="text" name="email" id="email">
						</div>
						<div class="control-group">
							<label for="first_name">First Name:</label>
							<input type="text" name="first_name" id="first_name">
						</div>
						<div class="control-group">
							<label for="last_name">Last Name:</label>
							<input type="text" name="last_name" id="last_name">
						</div>
						<div class="control-group">
							<label for="password">Password:</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="control-group">
							<label for="conf_password">Password Confirmation:</label>
							<input type="password" name="re_password" id="re_password">
						</div>
						<div class="control-group">
							<input type="submit" value="Register" class="btn btn-success">
						</div>
					</form>
					<a href="/users/signin">Already have an account? Login</a>
				</div>
			</div>
		</div>
	</body>
</html>