 
<h2 class="header"><?php echo $user["first_name"]." ".$user["last_name"]; ?></h2>
<div class="row">
	<div class="well col-md-4">
		<ul class="list-unstyled">
			<li>Email : <?php echo $user["email"]?></li>
			<li>User Level :<?php echo $user["user_level"]?></li>
			<li>Created At : <?php echo $user["created_at"]?></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-1">
		<h3>Leave a comment for <?php echo $user["first_name"]." ".$user["last_name"]; ?></h3>	 
		<form action="/dashboard/create_post" method="post">
			<div class="form-group">
				<textarea name="comment" cols="100" rows="3"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" name="form_action" value="Post" class="btn btn-primary">
			</div>
			<input type="hidden" name="post_created_for"    value="<?=$user["id"]?>">
			<input type="hidden" name="post_created_by"     value="<?=$current_user['user_id']?>">
	    </form>	
	    <div class="row">
	    	<h1>Posts</h1>
	    	 <?php 
		    if(count($posts ) >0)
		    	 {
		    	 	foreach ($posts as $post)  
		    	 	 {?>
		    	 	<div class="row">
		    	 		<div> 
							 <?php foreach ($all_users as $user) {
						    	 	if($user['id']==$post['created_by']){
						    	 		echo "<h4>".$user['first_name']." ".$user['last_name'];
						    	 	}
						    	 }?> wrote : on <?php echo $post['created_at'] ?></h4>
							<div class="col-md-offset-1"> 
			    	 			<p class="well"><?php echo $post['content'];?></p>

			    	 			<div class="col-md-offset-1"> 
						    	 	<?php    
						    	 	foreach ($comments as $comment)  
						    	 	 {?>
									
						    	 	<?php if($post['id']==$comment['post_id'])
							    	 	  {
							    	 	  	 foreach ($all_users as $user) 
							    	 	  	 {
							    	 	  	  if($comment['created_by'] == $user['id'])
							    	 	  	  {
							    	 	  	  	echo "<h5>".$user['first_name']." ".$user['last_name'].
							    	 	  	  	      " replied"."</h5>"."on".$comment['created_at'] ;
							    	 	  	  }
							    	 	  	 }
							    	 		 echo "<p class='well'>".$comment['content']."</p>";
							   	 	 	 }    	 	
									}?>
					            </div>
			    	 			<div class="col-md-offset-1">
			    	 				<h3>Reply</h3>
			    	 				<form action="/dashboard/create_comment" method="post">
										<div class="form-group">
											<textarea name="reply" cols="100" rows="3"></textarea>
										</div>
										<div class="form-group">
											<input type="submit" name="form_action" value="Reply" class="btn btn-primary">
										</div>
										<input type="hidden" name="post_id"                value="<?=$post["id"]?>">
										<input type="hidden" name="comment_created_by"     value="<?=$current_user['user_id']?>">
	    							</form>	
			    	 			</div>
			    	 		</div>
		    	 	    </div>
		    	 	  </div>
					
		    	<?php  }
		    	 }?>

		    	 </dl>
	    </div> 
	    	 
	</div>
</div>

 
