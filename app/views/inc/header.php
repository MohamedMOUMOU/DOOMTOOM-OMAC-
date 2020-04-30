<?php ini_set("memory_limit", "16M") ?>
<?php $url = manage_urls(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="<?php echo URLROOT; ?>/node_modules\font-awesome\css\font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo URLROOT; ?>\node_modules\slick-carousel\slick\slick-theme.css">
	<link rel="stylesheet" href="<?php echo URLROOT; ?>\node_modules\slick-carousel\slick\slick.css">
	<link rel="stylesheet" href="<?php echo URLROOT; ?>\node_modules\bootstrap\dist\css\bootstrap.css">
	<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
	<?php if(($url[0] == "chats" && $url[1] == "read") || ($url[0] == "groups" && $url[1] == "read")): ?>
		<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/chat.css">
	<?php endif; ?>
	<?php if($url[0] == "groups" && $url[1] == "add"): ?>
		<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/groups_add.css">
	<?php endif; ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo URLROOT; ?>/images/website_images/website_logo45.png">
	<title><?php echo SITENAME; ?></title>
	<style type="text/css">
		<?php if(isset($_GET['url']) && $_GET['url'] == "users/register"): ?>
			body{
				background: url('<?php echo URLROOT; ?>/images/website_images/register.jpg') no-repeat center center fixed;
				background-size: cover;
			}
		<?php endif; ?>
		<?php if(isset($_GET['url']) && $_GET['url'] == "users/login"): ?>
			body{
				background: url('<?php echo URLROOT; ?>/images/website_images/login.png') no-repeat center center fixed;
				background-size: cover;
			}
		<?php endif; ?>
	</style>
</head>
<!-- <script type="text/javascript">
	$(document).ready(function(){
	var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);
jQuery('#load-screen').delay(700).fadeout(600,function(){
	$(this).remove();
});
});
</script> -->
<body style="font-family: cursive;">