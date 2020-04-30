<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT . '/css/profile.css'; ?>">
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<?php flash("not change profile image"); ?>
<?php flash("not change pbi image"); ?>
<?php flash("not change self description"); ?>
    <div class="container-fluid">
        <div class="row first-row">
        	<?php
        	if($data['user_info']->user_pbi == "default-pbi.png"){
        		$pbi = URLROOT . "/images/website_images/" . $data['user_info']->user_pbi;
        	}else{
        		$pbi = URLROOT . "/images/users_images/" . $data['user_info']->user_name . "_images/pbi_images/" . $data['user_info']->user_pbi;
        	}
        	?>
            <a href="" style="width: 96%;" data-toggle="modal" data-target="#change_pbi"><img style="width:100%;height:51.5vh;" class="img-responsive" src="<?php echo $pbi; ?>" alt=""></a>
            <div class="modal fade" id="change_pbi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Change your profile background image</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="<?php echo URLROOT; ?>/users/change_pbi_image/<?php echo $data['user_info']->user_id; ?>" method="post" enctype="multipart/form-data">
						<input type="file" name="pbi_image" class="form-control">
						<input type="submit" value="Save changes" name="change_pbi_image" class="btn btn-primary pull-right">
					</form>
			      </div>
			    </div>
			  </div>
			</div>
        	<?php
        	if($data['user_info']->user_image == "unknown-profile.jpg" || $data['user_info']->user_image == 'unknown-profile-woman.jpg'){
        		$user_image = URLROOT . "/images/website_images/" . $data['user_info']->user_image;
        	}else{
        		$user_image = URLROOT . "/images/users_images/" . $data['user_info']->user_name . "_images/profile_images/" . $data['user_info']->user_image;
        	}
        	?>
            <a href="" data-toggle="modal" data-target="#exampleModal"><img class="profile-image" src="<?php echo $user_image; ?>"></a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Change your profile image</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="<?php echo URLROOT; ?>/users/change_profile_image/<?php echo $data['user_info']->user_id; ?>" method="post" enctype="multipart/form-data">
						<input type="file" name="profile_image" class="form-control">
						<input type="submit" value="Save changes" name="change_profile_image" class="btn btn-primary pull-right">
					</form>
			      </div>
			    </div>
			  </div>
			</div>
						<?php
				$user = new Users();
				$message = $user->userInProfile($data['user_info']->user_id);
				?>
				<div class="buttons-section" style="">
				<?php
				if($message == "accept"):
					?>
					<div class="text-center">
						<form action="<?php echo URLROOT; ?>/users/accept/<?php echo $users->user_id; ?>" method="post" class="">
							<input type="submit" class="btn btn-primary btn-block" name="accept_request<?php echo $users->user_id ; ?>" value="confirm">
						</form>
						<form action="<?php echo URLROOT; ?>/users/deny/<?php echo $users->user_id; ?>" method="post" class="">
							<input type="submit" class="btn btn-warning btn-block" name="deny_request<?php echo $users->user_id; ?>" value="deny">
						</form>
					</div>
					<?php
				elseif($message == "not friend"):
					if($data['user_info']->user_id !== $_SESSION['user_id']):
					?>
					<form style="display: inline;" action="<?php echo URLROOT; ?>/users/add/<?php echo $data['user_info']->user_id; ?>" method="post">
						<input type="submit" class="btn btn-primary" name="send_request<?php echo $data['user_info']->user_id; ?>" value="Add as a friend">
					</form>
					<?php
					endif;
				elseif($message == "block"):
						?>
						<form style="display: inline;" action="<?php echo URLROOT; ?>/users/block/<?php echo $data['user_info']->user_id; ?>" method="post">
							<input type="submit" class="btn btn-danger" name="block<?php echo $data['user_info']->user_id ; ?>" value="block">
						</form>
						<a href="<?php echo URLROOT . "/chats/read/{$_SESSION['user_id']}/{$data['user_info']->user_id}"; ?>" class="btn btn-primary">Send a message</a>
					<?php
				else:
					echo "<p class='ml-1 mr-1 text-muted' style='font-size: 12px;'>" . $message . "</p>";
				endif;
			?>
			<?php
			if($data['liked']){
				?>
					<style>
						.like_button{
							background-color: #7c7cff;
						}
					</style>
				<?php
			}else{
				?>
					<style>
						.like_button{
							background-color: gray;
						}
					</style>
				<?php
			}
			?>
			<?php
			if($data['disliked']){
				?>
					<style>
						.dislike_button{
							background-color: #ff7a7a;
						}
					</style>
				<?php
			}else{
				?>
					<style>
						.dislike_button{
							background-color: gray;
						}
					</style>
				<?php
			}
			?>
			<form style="display: inline;" action="<?php echo URLROOT . "/profilelikes/likeProfile/" . $data['user_info']->user_id; ?>" onsubmit="return likeSubmit();">
				<button class="btn btn-primary like_button" style="border-color:transparent;"><i class="fa fa-thumbs-up"><span style="margin-left:4px;"><?php echo $data['user_info']->profile_likes_count ?></span></i></button>
			</form>
			<form style="display: inline;" action="<?php echo URLROOT . "/profiledislikes/dislikeProfile/" . $data['user_info']->user_id; ?>" onsubmit="return likeSubmit();">
				<button class="btn btn-danger dislike_button" style="border-color:transparent;"><i class="fa fa-thumbs-down"><span style="margin-left:4px;"><?php echo $data['user_info']->profile_dislikes_count ?></span></i></button>
			</form>
			</div>
			<div class="self-desc-card"><h5>Self description :<i style="cursor: pointer;" data-toggle="modal" data-target="#self-description" class="fa fa-edit pull-right"></i></h5><div class="scroll-self-desc self-desc-text"><?php echo (!empty($data['user_info']->user_self_description)) ? $data['user_info']->user_self_description : "<h3 class='text-center' style='padding-top: 37px;'>this field is empty</h3>"; ?></div></div>
            <div class="modal fade" id="self-description" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Edit yourself description</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<form action="<?php echo URLROOT; ?>/users/edit_self_description/<?php echo $data['user_info']->user_id; ?>" method="post">
						<textarea type="text" id="editor" name="self_description" class="form-control"><?php echo $data['user_info']->user_self_description; ?></textarea><br>
						<input type="submit" value="Save changes" name="submit_self_description" class="btn btn-primary pull-right">
					</form>
			      </div>
			    </div>
			  </div>
			</div>
            <div class="left-first-row-bar">
            	<div class="text-center left-first-row-bar-items">
            		<i class="fa fa-file items-icons"></i>
            		<span style="display: block;"><?php echo $data['count_posts'] ?></span>
            	</div>
            	<div class="text-center left-first-row-bar-items">
            		<i class="fa fa-users items-icons"></i>
            		<span style="display: block;"><?php echo $data['count_friends'] ?></span>
            	</div>
				<div class="text-center left-first-row-bar-items">
            		<i class="fa fa-comments items-icons"></i>
            		<span style="display: block;">?</span>
            	</div>
            </div>
        </div>
	</div>
	<div class="container mt-5">
		<div class="row">
			<div class="col-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident a quibusdam, illum. Pariatur tempora harum repudiandae, nihil iste impedit, obcaecati inventore iusto quisquam blanditiis accusamus in quod ipsa porro, unde!</div>
			<div class="col-9">
				
			</div>
		</div>
	</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>