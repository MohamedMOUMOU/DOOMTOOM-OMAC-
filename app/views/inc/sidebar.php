<?php
$user = new Users();
$friendship_requests = $user->selectFriendshipRequests();
$friendship_requests_count = $user->selectFriendshipRequestsCount();
$like = new Profilelikes();
$dislike = new Profiledislikes();
?>
<h5>Online Friends : <span style="border-radius: 250px;background-color: #7aff7a;" class="badge badge-success pull-right onlinefriendscount"></span></h5>
<div class="onlinefriends" style="margin-right: 15px;">
</div>
<h5 class="">Offline Friends : <span style="border-radius: 250px;background-color: #ff7a7a;" class="badge badge-success pull-right offlinefriendscount"></span></h5>
<div class="offlinefriends" style="margin-right: 15px;">
</div>
<h5 class="">Friendship requests : <span style="border-radius: 250px;background-color: #7c7cff;" class="badge badge-success pull-right"><?php echo $friendship_requests_count; ?></span></h5>
<div class="friendship_requests">
<?php
foreach($friendship_requests as $f_r):
?>
<div class="card card-body bg-light mt-2 ml-3 mr-3 mb-2" style="padding: 8px;border-style:solid;border-width:1px;border-color:#7c7cff;">
	<div class="row">
		<div class="col-6" style="position: relative;">
			<div style="position: absolute;top:10%;left:20%;">
			<?php if($f_r->user_image == "unknown-profile.jpg" || $f_r->user_image == 'unknown-profile-woman.jpg'):
				$profile_image_request_fship = URLROOT . "/images/website_images/" . $f_r->user_image;
			else:
				$profile_image_request_fship = URLROOT . "/images/users_images/" . $f_r->user_name . "_images/profile_images/" . $f_r->user_image;
			endif;
			?>
			<span style="display: block;"><img src="<?php echo $profile_image_request_fship; ?>" alt="" style="height: 45px;width: 45px;border-radius:250px;border-style:solid;border-width:2px;border-color:#7c7cff;"></span>
			<span style="display: block;" class="mt-1"><?php echo $f_r->user_name ?></span>
		</div>
</div>
<div class="col-6">
	<form action="<?php echo URLROOT; ?>/users/accept/<?php echo $f_r->friend_id; ?>" method="post" class="pull-right ml-1">
		<input type="submit" style="" class="btn btn-primary mt-1" name="accept_request<?php echo $f_r->friend_id ; ?>" value="confirm">
	</form>
	<form action="<?php echo URLROOT; ?>/users/deny/<?php echo $f_r->friend_id; ?>" method="post" class="pull-right">
		<input type="submit" class="btn btn-warning mt-1" name="deny_request<?php echo $f_r->friend_id; ?>" value="deny">
	</form>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php if($friendship_requests_count == 0): ?>
<p class="text-muted">--You have not any friendship request--</p>
<?php endif; ?>
<?php if($friendship_requests_count > 4): ?>
<a href="#" class="pull-right">see more &raquo;</a>
<?php endif;
$groups = new Groups();
?>
<a href="<?php echo URLROOT . "/groups/add" ?>" class="btn btn-primary" style="position: fixed;right:1%;bottom: 2%;z-index: 2;"><i class="fa fa-plus"></i> Create my group</a>
<h5 class="mb-3">My groups <span class="badge badge-primary pull-right"><?php echo count($groups->my_groups()); ?></span></h5>
<div class="" style="max-height: 200px;overflow-y: auto;overflow-x: hidden;">
<?php
if(count($groups->my_groups()) >= 1){
	for ($i=0; $i < count($groups->my_groups()); $i++) {
		$group = $groups->find_group_by_id($groups->my_groups()[$i]);
		$user_info = $user->findUserById($group->creator_id);
		$creator_name = $user_info->user_name;
		echo "<div class='row mb-2'><div class='col-md-2'>";
		echo "<a href='" . URLROOT . "/groups/read/" . $group->group_id . "'><img style='height:50px;width:50px;border-radius:50px;' src='" . group_images($group,$creator_name) . "' alt=''></a>";
		echo "</div><div class='col-md-10' style='margin-top:10px;'>";
		echo "<p >" . $group->group_name . "</p>";
		echo "</div></div>";
	}
}else{
	echo "<p class='text-muted text-center' style='margin:auto;'>--You are not a member in any group--</p>";
}
?>
</div>