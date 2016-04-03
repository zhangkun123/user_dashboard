<? require_once('include/header.php')  ?>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#signin_form').submit(function(){
					var form = $(this);

					$.post(form.attr('action'), form.serialize(), function(data){
						if(data.status){
							window.location = data.redirect_url
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
					<form id="signin_form" action="/users/user_login" method="post" class="form-horizontal">
						<h3>Sign in</h3>
						<div class="control-group">
							<label for="email">Email Address:</label>
							<input name="email" type="text" name="email">
						</div>
						<div class="control-group">
							<label for="password">Password:</label>
							<input name="password" type="password" name="password">
						</div>
						<div class="control-group">
							<input type="submit" value="Sign In" class="btn btn-success">
						</div>
					</form>
					<a href="/users/register">Don't have an account? Register.</a>
				</div>
			</div>
		</div>
	</body>
</html>