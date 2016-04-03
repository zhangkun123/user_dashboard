<? require_once('include/header.php') ?>
<? require('include/navigation.php')	?>
		<div class="container">
			<div class="row">
				<div id="users_table" class="span12">
<?php 	if($user_level == ADMIN)
		{	?>
					<h3 class="pull-left">Manage Users</h3>
					<a href="/users/new_user" class="btn btn-mini btn-primary pull-right">Add New User</a>
<?php 	}
		else
		{	?>
					<h3 class="pull-left">All Users</h3>	
<?php 	}	?>						
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<table class="table tablesorter">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created At</th>
								<th>User Level</th>
<?php 	if($user_level == ADMIN) 
		{	?>									
								<th>Actions</th>
<?php 	}	?>									
							</tr>
						</thead>
						<tbody>
<?php 	foreach($users as $user)							
		{	
			if($user->id != $user_id)
			{	
					echo '	<tr>
								<td>' . $user->id . '</td>
								<td><a href="/users/show/'. $user->id . '">' . $user->first_name . ' ' . $user->last_name . '</a></td>
								<td>' . $user->email . '</td>
								<td>' . $user->created_at . '</td>
								<td>' . $user->user_level . '</td>';
			if($user_level == ADMIN) 
			{								
					echo '		<td>
									<a href="/users/edit/' . $user->id . '">edit</a>
									<span>|</span>
									<a href="/users/delete_user/' . $user->id . '" class="delete_user">delete</a>
								</td>';
 			}										
					echo '	</tr>';
 		}
		}	?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>