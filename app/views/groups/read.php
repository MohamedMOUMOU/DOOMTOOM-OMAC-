<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div role="main" class="container-fluid" style="margin-top: 70px;">
	<div class="row">
		<div class="col-3 scroll-sidebar1" style="overflow: auto;height: 87vh;margin-right: 10px;">	
		<?php require APPROOT . '/views/inc/groups_sidebar.php'; ?>
		</div>
		<style type="text/css">
			.chat-section{
				background-image: url('<?php echo group_b_images($data['group'],$data['creator']->user_name); ?>');
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
			}
		</style>
		<div class="col-9 offset-md-3 chat-section">
			<?php
			$d = 1;
			$e = 1;
			foreach ($data['messages'] as $message) {
				$me = false;
				$other = false;
				if(!$me){
					$i = 0;
				}
				if(!$other){
					$c = 0;
				}
				if($message->sender_id === $_SESSION['user_id']){
					echo "<div class='row blue-row'>";
					$me = true;
					if(!$other){
						$i = 1;
						$e = 1;
					}
					if($d == 1){
						echo "<div message-id='{$message->id}' id='my-message-{$message->id}' data-toggle='modal' data-target='#my_message_{$message->id}' class='offset-4 col-7 message message-blue message-blue-relative'>" . $message->message . "<span class='pull-right chat-date-blue'>" . chat_dates($message->creation_time) . "</span></div>";
					}else{
						echo "<div message-id='{$message->id}'id='my-message-{$message->id}' data-toggle='modal' data-target='#my_message_{$message->id}' class='offset-4 col-7 message message-blue'>" . $message->message . "<span class='pull-right chat-date-blue'>" . chat_dates($message->creation_time) . "</span></div>";
					}
					echo "<div class='col-1'><img class='chat-image' src='" . profile_image($data['logged_in_user']) . "'></div>";
					if($me){
						$d ++;
					}
					echo "</div>";
				}else{
					echo "<div class='row green-row'>";
					$other = true;
					if(!$me){
						$c = 1;
						$d = 1;
					}
					echo "<div class='col-1'><img class='chat-image' src='" . profile_image($user->findUserById($message->sender_id)) . "'></div>";
					if($e == 1){
						echo "<div message-id='{$message->id}' id='message-{$message->id}' data-toggle='modal' data-target='#message_{$message->id}' class='col-7 message message-green message-green-relative'>" . $message->message . "<span class='pull-right chat-date-green'>" . chat_dates($message->creation_time) . "</span></div>";
					}else{
						echo "<div message-id='{$message->id}' id='message-{$message->id}' data-toggle='modal' data-target='#message_{$message->id}' class='col-7 message message-green'>" . $message->message . "<span class='pull-right chat-date-green'>" . chat_dates($message->creation_time) . "</span></div>";
					}
					if($other){
						$e ++;
					}
					echo "</div>";
				}
			}
			?>
		</div>
		<form action="<?php echo URLROOT . "/groupsmessages/send_message/" . $_SESSION['user_id'] . "/" . $data['group']->group_id; ?>" method="post" class="message-input" enctype="multipart/form-data">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="The group is waiting for your message" name="group_message" required>
				<div class="input-group-append">
					<div class="custom-file">
				    <input type="file" name="group_file" style="display: none;" class="custom-file-input" id="inputGroupFile01">
				    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
				  </div>
				</div>
				<div class="input-group-append">
				<button type="submit" class="btn btn-primary" type="button"><i class="fa fa-send"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="change_group_image" tabindex="91" role="dialog" aria-labelledby="change_group_image">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_image">Change your group image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="<?php echo URLROOT; ?>/groups/update_g_image/<?php echo $data['group']->group_id; ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="group_image" class="form-control">
			<br>
			<input type="submit" value="Save changes" name="change_group_image" class="btn btn-primary pull-right">
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_group_b_image" tabindex="91" role="dialog" aria-labelledby="change_group_b_image">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_b_image">Change your group background image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="<?php echo URLROOT; ?>/groups/update_g_b_image/<?php echo $data['group']->group_id; ?>" method="post" enctype="multipart/form-data">
			    <input type="file" name="group_b_image">
			  <br>
			<br>
			<input type="submit" value="Save changes" name="change_group_b_image" class="btn btn-primary pull-right">
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="change_group_name" tabindex="91" role="dialog" aria-labelledby="change_group_name">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_name">Change your group name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="<?php echo URLROOT; ?>/groups/update_group_name/<?php echo $data['group']->group_id; ?>" method="post">
			<input type="text" name="group_name" class="form-control">
			<br>
			<input type="submit" value="Save changes" name="change_group_name" class="btn btn-primary pull-right">
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal blue-message-modal" tabindex="91" role="dialog" aria-labelledby="change_group_name">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_name">Delete message options</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form class="text-center" uncomplete-action="<?php echo URLROOT; ?>/groupsmessages/delete_for_me/" id="delete_for_me" method="post">
			<button class="delete-options" type="submit">Delete for me</button>
		</form>
		<form class="text-center" uncomplete-action2="<?php echo URLROOT; ?>/groupsmessages/delete_for_everyone/" id="delete_for_everyone" method="post">
			<button class="delete-options" type="submit">Delete for every_one</button>
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal green-message-modal" tabindex="91" role="dialog" aria-labelledby="change_group_name">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_name">Delete message options</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form class="text-center" uncomplete-action="<?php echo URLROOT; ?>/groupsmessages/delete_o_for_me/" id="delete_o_for_me" method="post">
			<button class="delete-options" type="submit">Delete for me</button>
		</form>
      </div>
    </div>
  </div>
</div>
<div class="modal delete-member-modal" id="delete_member" tabindex="91" role="dialog" aria-labelledby="change_group_name">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_name">Delete a group member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="<?php echo URLROOT; ?>/groups/delete_members/<?php echo $data['group']->group_id; ?>" id="delete_member" method="post">
			<div class="" style="overflow: auto;height: 150px;overflow-x: hidden;">
			<?php
			$user = new Users();
			for ($i=0; $i < $data['members_count']; $i++) {
				$user_info = $user->findUserById($data['members_ids'][$i]);
				echo "<div class='row mb-2'><div class='col-12'>";
				echo "<input type='checkbox' name='members_ids[]' value='{$user_info->user_id}'><span class='checkmark'>";
				echo "<img class='profile-image-delete' src='" . profile_image($user_info) . "'>";
				echo $user_info->user_name . "<br>";
				echo "</div></div>";
			}
			?>
			</div>
			<br>
			<button type="submit" name="delete_members" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete members</button>
		</form>
      </div>
    </div>
  </div>
</div>
<?php if($data['not_members_count']): ?>
<div class="modal delete-member-modal" id="add_member" tabindex="91" role="dialog" aria-labelledby="change_group_name">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_group_name">Delete a group member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="<?php echo URLROOT; ?>/groups/add_members/<?php echo $data['group']->group_id; ?>" id="delete_member" method="post">
			<div class="" style="overflow: auto;max-height: 150px;overflow-x: hidden;">
			<?php
			for ($i=0; $i < $data['not_members_count']; $i++) {
				$not_member_info = $user->findUserById($data['not_members_ids'][$i]);
				echo "<div class='row mb-2'><div class='col-12'>";
				echo "<input type='checkbox' name='not_members_ids[]' value='{$not_member_info->user_id}'><span class='checkmark'>";
				echo "<img class='profile-image-delete' src='" . profile_image($not_member_info) . "'>";
				echo $not_member_info->user_name . "<br>";
				echo "</div></div>";
			}
			?>
			</div>
			<br>
			<button type="submit" name="add_members" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add members</button>
		</form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php flash("not change g image"); ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>