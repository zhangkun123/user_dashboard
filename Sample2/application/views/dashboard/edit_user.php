<h1>Edit User</h1>
 
<div class="col-md-5">
	<form action="/dashboard/update_user" method="post">
	<div class="form-group">
		<label>First Name</label>
		<input type="text" name="first_name" value="<?=$user["first_name"]?>" class="form-control">
	</div>
	 <div class="form-group">
		<label>Last Name</label>
		<input type="text" name="last_name" value="<?=$user["last_name"]?>" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" value="<?=$user["email"]?>" class="form-control">
	</div>
	<div class="form-group">
		<label>User Level</label>
		<input type="text" name="user_level" value="<?=$user["user_level"]?>" class="form-control" readonly>
	</div>
	<input type="submit" name="form_action" value="Update User" class="btn btn-primary">
	<input type="hidden" name="id" value="<?=$user["id"]?>"  >
	<input type="submit" name="form_action" value="Cancel" class="btn btn-primary">
</form> 
</div>
  
 