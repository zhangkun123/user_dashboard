<h1 class="page-header">Register</h1>
<div class="row">
	<div class="col-md-5">
		<form action="/access/user_login" method="post">
			<div class="form-group">
				<label>First name</label>
				<input type="text" name="first_name" class="form-control" >
			</div>
			<div class="form-group">
				<label>Last name</label>
				<input type="text" name="last_name" class="form-control" >
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" >
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label>Password Confirmation</label>
				<input type="password" name="password_conf" class="form-control">
			</div>
			<input type="submit" name="form_action" value="Register" class="btn btn-primary">
		</form>
	    </div>
</div>