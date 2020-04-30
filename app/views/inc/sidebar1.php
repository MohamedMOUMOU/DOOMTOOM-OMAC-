<?php
$user = new Users();
$post = new Posts();
$last_seen_posts = $post->last_seen_posts();
$recently_liked_posts = $post->recently_liked_posts();
$wich_post = "";
$like = new Profilelikes();
$dislike = new Profiledislikes();
?>
<?php
if($like->likedprofile($_SESSION['user_id'])){
	?>
		<style>
			.like-button{
				background-color: #7c7cff;
			}
		</style>
	<?php
}else{
	?>
		<style>
			.like-button{
				background-color: gray;
			}
		</style>
	<?php
}
?>
<?php
if($dislike->dislikedprofile($_SESSION['user_id'])){
	?>
		<style>
			.dislike-button{
				background-color: #ff7a7a;
			}
		</style>
	<?php
}else{
	?>
		<style>
			.dislike-button{
				background-color: gray;
			}
		</style>
	<?php
}
?>
<div class="logged-in-user row pb-2">
	<div class="col-md-5">
		<img style="height: 100px;width: 100px;border-radius: 250px;" src="<?php echo profile_image($data['logged_in_user']);?>" alt="">
	</div>
	<div class="col-md-7 text-center">
		<div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 30px;">
			<form style="display: inline;" action="<?php echo URLROOT . "/profilelikes/likeProfile/" . $data['logged_in_user']->user_id; ?>">
				<button type="submit" class="btn btn-secondary like-button"><i class="fa fa-thumbs-up"></i> <?php echo $data['logged_in_user']->profile_likes_count ?></button>
			</form>
			<form style="display: inline;" action="<?php echo URLROOT . "/profiledislikes/dislikeProfile/" . $data['logged_in_user']->user_id; ?>">
				<button type="submit" class="btn btn-secondary dislike-button"><i class="fa fa-thumbs-down"> <?php echo $data['logged_in_user']->profile_dislikes_count ?></i></button>
			</form>
		</div>	
	</div>
</div>
<div class="b-image">
	<img src="<?php echo URLROOT . "/images/website_images/white.png"; ?>" class="b-o-image" alt="">
</div>
<a href="#" style="margin-top: 115px;" class="nav-link"><div class="loggedin"></div></a>
<h5 class="ml-3">Last seen posts</h5>
<div class="thing">
<?php
foreach ($last_seen_posts as $post) {
$wich_post = "f";
if(empty($post->post_image)){
	$max_length_title = 31;
	$post_title = substr($post->post_title,0,$max_length_title);
	if(strlen($post->post_title) > $max_length_title){
	    $post_title = substr($post->post_title,0,$max_length_title) . "...";
	}
}else{
	$max_length_title = 23;
	$post_title = substr($post->post_title,0,$max_length_title);
	if(strlen($post->post_title) > $max_length_title){
	    $post_title = substr($post->post_title,0,$max_length_title) . "...";
	}
}
if(empty($post->post_image)){
	$max_length_content = 31;
	$post_content = substr($post->post_content,0,$max_length_content);
	if(strlen($post->post_content) > $max_length_content){
	    $post_content = substr($post->post_content,0,$max_length_content) . "...";
	}
}else{
	$max_length_content = 23;
	$post_content = substr($post->post_content,0,$max_length_content);
	if(strlen($post->post_content) > $max_length_content){
	    $post_content = substr($post->post_content,0,$max_length_content) . "...";
	}
}
$url_root = URLROOT;
if(empty($post->post_image)){
	$post_image = "";
	$col3 = 0;
	$col9 = 12;
}else{
	$post_user = $user->findUserById($post->post_user_id);
	$post_user_name = $post_user->user_name;
	$post_image = "<img class='ml-2' src='{$url_root}/images/posts_images/" . $post_user_name . "_images/{$post->post_image}' style='height:60px;width:60px;border-radius:4px;'>";
	$col3 = 3;
	$col9 = 9;
}
$last_seen_posts = <<<DELIMETER
	<div class="row ml-3 mr-3 mb-2 pt-2 pb-2 slide" style="border:1px solid grey; border-radius:2px;">
		<div class="row">
			<div class="col-{$col3}">
				<a href="{$url_root}/posts/show/{$post->post_id}">{$post_image}</a>
			</div>
			<div class="col-{$col9}">
				<p class="ml-2"><a href="{$url_root}/posts/show/{$post->post_id}">{$post_title}</a><br><span class="text-muted">{$post_content}</span></p>
			</div>
		</div>
	</div>
DELIMETER;
echo $last_seen_posts;
}
?>
</div>
<h5 class="ml-3">Recently liked posts</h5>
<div class="thing1">
<?php
foreach ($recently_liked_posts as $post) {
if(empty($post->post_image)){
	$max_length_title = 31;
	$post_title = substr($post->post_title,0,$max_length_title);
	if(strlen($post->post_title) > $max_length_title){
	    $post_title = substr($post->post_title,0,$max_length_title) . "...";
	}
}else{
	$max_length_title = 23;
	$post_title = substr($post->post_title,0,$max_length_title);
	if(strlen($post->post_title) > $max_length_title){
	    $post_title = substr($post->post_title,0,$max_length_title) . "...";
	}
}
if(empty($post->post_image)){
	$max_length_content = 31;
	$post_content = substr($post->post_content,0,$max_length_content);
	if(strlen($post->post_content) > $max_length_content){
	    $post_content = substr($post->post_content,0,$max_length_content) . "...";
	}
}else{
	$max_length_content = 23;
	$post_content = substr($post->post_content,0,$max_length_content);
	if(strlen($post->post_content) > $max_length_content){
	    $post_content = substr($post->post_content,0,$max_length_content) . "...";
	}
}
$url_root = URLROOT;
if(empty($post->post_image)){
	$post_image = "";
	$col3 = 0;
	$col9 = 12;
}else{
	$post_user = $user->findUserById($post->post_user_id);
	$post_user_name = $post_user->user_name;
	$post_image = "<img class='ml-2' src='{$url_root}/images/posts_images/" . $post_user_name . "_images/{$post->post_image}' style='height:60px;width:60px;border-radius:4px;'>";
	$col3 = 3;
	$col9 = 9;
}
$recently_liked_posts = <<<DELIMETER
	<div class="row ml-3 mr-3 mb-2 pt-2 pb-1 slide" style="border:1px solid grey; border-radius:2px;">
	<div class="row">
	<div class="col-{$col3}">
		<a href="{$url_root}/posts/show/{$post->post_id}">{$post_image}</a>
		</div>
		<div class="col-{$col9}">
		<p class="ml-2"><a href="{$url_root}/posts/show/{$post->post_id}">{$post_title}</a><br><span class="text-muted">{$post_content}</span></p>
		</div>
		</div>
	</div>
DELIMETER;
echo $recently_liked_posts;
}
?>
</div>