<?php	require('include/header.php'); ?>
	<script type="text/javascript">
			$(document).ready(function(){
				//add main message or add comment
				$('#send_message, .send_reply').live('submit', function(){
					var form = $(this);

					$.post(form.attr('action'), form.serialize(), function(data){
						if(data.status){

							if(data.message_type == "reply"){
								form.siblings(".replies").append(data.message);
							}
							else{
								form.siblings("#messages").find("#message_box").prepend(data.message);
							}

							form.find("textarea").val("");
						}
						else{
							$('#message_box').addClass('alert alert-error').html(data.error_message);
						}
					}, 'json');

					return false;
				});

				$('.delete_message').live('submit', function(){
					var form = $(this);

					$.post(form.attr('action'), form.serialize(), function(data){
						if(data.status){
							form.parent().remove();
						}
					}, 'json');

					return false;
				});
			});
	</script>
<?php require('include/navigation.php') ?>
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3><?php echo $user->first_name ." ". $user->last_name; ?></h3>
					<table class="table">
						<tbody>
							<tr>
								<td><strong>Registered Date:</strong></td>
								<td><?php echo $user->created_at; ?></td>
							</tr>
							<tr>
								<td><strong>User ID:</strong></td>
								<td><?php echo $user->id; ?></td>
							</tr>
							<tr>
								<td><strong>Email address:</strong></td>
								<td><?php echo $user->email; ?></td>
							</tr>
							<tr>
								<td><strong>Description:</strong></td>
								<td><?php echo $user->description; ?></td>
							</tr>
							<tr>
<?php 			if($user_level == ADMIN || $user_id == $user->id)
				{	?>
								<td><a href="/users/edit/<?php echo $user->id; ?>" class="btn btn-mini">Edit profile</a></td>
<?php 			}	
				else
				{	?>								
								<td></td>
<?php 			}	?>								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<form id="send_message" action="/messages/send_message" method="post" class="form-horizontal row">
				<div class="span6">
					<h3>Leave a message</h3>
					<div class="control-group">
						<input type="hidden" name="recipient_user_id" value="<?php echo $user->id; ?>">
						<textarea name="message_content" placeholder="Write a message..."></textarea>
					</div>	
					<input type="submit" value="Post" class="btn btn-success">
				</div>
			</form>
			<div id="messages">
				<div class="row">
					<div id="message_box" class="span12">
<?php			
				foreach($messages as $message)
				{	?>
						<div class="well">
							<div class="pull-left">
								<h5><a href=""><?php echo $message["first_name"] ." ". $message["last_name"]; ?></a> wrote:</h5>
							</div>
<?php 				if($user_level == ADMIN || $user_id == $message['user_id'])
					{	?>
							<form action="/messages/delete_message/<?php echo $message['message_id']; ?>" class="pull-right form-horizontal delete_message">
								<input type="submit" value="Delete" class="btn">
							</form>
<?php 				}	?>
							<div class="clearfix"></div>
							<p><?php echo $message["message"]; ?></p>
							<h6 class="muted"><?php echo timespan(strtotime($message["created_at"]), time()) ." ago"; ?></h6>
							<div class="replies">
<?php				foreach($replies[$message['message_id']] as $reply)
					{	?>
								<div class="message_reply">
									<div class="pull-left">
										<h5><a href=""><?php echo $reply["first_name"] ." ". $reply["last_name"]; ?></a> replied:</h5>
										<p><?php echo $reply["message"]; ?></p>
										<h6 class="muted"><?php echo timespan(strtotime($reply["created_at"]),  time()) ." ago"; ?></h6>
									</div>	
<?php 					if($user_level == ADMIN || $user_id == $reply['user_id'])
						{	?>									
									<form action="/messages/delete_message/<?php echo $reply['message_id']; ?>" class="pull-right form-horizontal delete_message">
										<input type="submit" value="Delete" class="btn">
									</form>
<?php 					}	?>									
									<div class="clearfix"></div>
								</div>
<?php 				}	?>
							</div>	
							<form action="/messages/reply" class="form-horizontal send_reply" method="post">
								<div class="control-group">
									<input type="hidden" name="recipient_user_id" value="<?php echo $message['user_id']; ?>">
									<textarea name="message_content" placeholder="Write a reply..."></textarea>
								</div>
								<input type="hidden" name="parent_message_id" value="<?php echo $message['message_id']; ?>">
								<input type="submit" value="Post" class="btn btn-success">
								<div class="clearfix"></div>
							</form>
						</div>
<?php 			}	?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
</html>