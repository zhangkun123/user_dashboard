 
<h1 class="page-header">Manage Users</h1>
<div class="row">
	<div class="col-md-8">
		<table class="table table-striped">
			<thead>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>User level</th>
				<th>Created At </th>
				<?php if($is_admin) 
						{?>
							<th>Actions </th>
				 <?php  }?>
			</thead>
			<tbody>
				<?php foreach ($users as $user) {?>
					 <tr>
					 	<td><?php echo $user['id']; ?></td>
					 	<td><?php echo $user['first_name']; ?></td>
					 	<td><?php echo $user['last_name']; ?></td>
					 	<td><?php echo $user['email']; ?></td>
					 	<?php if($user['user_level']=="admin") 
					 		{?>
						<td>
							<span class="label label-danger">
								<?php echo ucwords($user['user_level']); ?>
							</span>
						 </td>
						 	<?php }
					 		else { ?>
						<td>
							<span class="label label-default">
								<?php echo ucwords($user['user_level']); ?>
							</span>
						</td>
					 	<?php   } ?>
					 	<td>
					 		<?php echo $user['created_at']; ?>
					 	</td>
					 	<td>	<a href="/dashboard/view_user/<?=$user['id']?>" class="btn btn-success">View</a></td>
					 	<?php if($is_admin)  {?>
					 	<td> 
					 		<a href="/dashboard/edit_user/<?=$user['id']?>" class="btn btn-warning">Edit</a>
					 	</td>
					 	<td>
					 		<?php if($user['user_level']=="admin")
							 	  {?>
							 		<a href="/dashboard/delete_user/<?=$user['id']?>" class="btn btn-danger" disabled>Delete</a>		 
							 <?php	}
							 	   else
							 		{?>
							 			<a href="/dashboard/delete_user/<?=$user['id']?>" class="btn btn-danger">Delete</a>
								<?php   
									}?>
					 	 	</td>
					 	<?php } ?>	
					 </tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
 
					 	 

