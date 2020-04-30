<?php
if(!isset($_SESSION['user_id'])){
  redirect("users/login");
}
$core = new Core();
$url = $core->getUrl();
$user = new Users();
$online = $user->online();
$user = new Users();
$user_time = $user->userTime();
?>
<nav class="navbar navbar-expand-xl navbar-light fixed-top mb-5" style="background-color: white;-webkit-box-shadow: 0px 1px 24px -8px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 1px 24px -8px rgba(0,0,0,0.75);
box-shadow: 0px 1px 24px -8px rgba(0,0,0,0.75);">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>">
        <img src="<?php echo URLROOT; ?>/images/website_images/website_logo45.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <?php echo substr(SITENAME,0,8); ?>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo ($url[0] == "" || ($url[0] == "pages" && $url[1] == "index")) ? "active" : ""; ?>">
            <a class="nav-link" href="<?php echo URLROOT; ?>"><i class="fa fa-home"></i> Home</a>
          </li>
          <li class="nav-item <?php echo ($url[0] == "users" && $url[1] == "search_for_friends") ? "active" : ""; ?>">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/search_for_friends"><i class="fa fa-search"></i> Search for friends</a>
          </li>
            <li class="nav-item <?php echo ($url[0] == "posts" && $url[1] == "add") ? "active" : ""; ?>">
            <a class="nav-link" href="<?php echo URLROOT; ?>/posts/add" style="cursor: pointer;">
              <i class="fa fa-plus" style="font-size: 14px;"></i> Add a post
            </a>
          </li>
          <li class="nav-item <?php echo ($url[0] == "chats" && $url[1] == "read") ? "active" : ""; ?>">
              <a href="<?php echo URLROOT . "/chats/read/{$_SESSION['user_id']}/start"; ?>" class="nav-link"><i class="fa fa-comments"></i> Chat</a>
          </li>
          <li class="nav-item <?php echo ($url[0] == "users" && $url[1] == "profile") ? "active" : ""; ?>">
              <a href="<?php echo URLROOT . "/users/profile/{$_SESSION['user_id']}"; ?>" class="nav-link"><i class="fa fa-user-circle-o"></i> My profile</a>
          </li>
          <li class="nav-item <?php echo ($url[0] == "users" && $url[1] == "logout") ? "active" : ""; ?>">
              <a href="<?php echo URLROOT . "/users/logout"; ?>" class="nav-link"><i class="fa fa-sign-out"></i> logout</a>
          </li>
        </ul>
  <form action="<?php echo URLROOT ; ?>/searchs/searchMyFriendsPosts" method="post" class="form-inline my-2 my-lg-0">
        <div class="input-group input-group-sm">
        <input type="text" class="form-control" name="search_content_myfriends_posts" placeholder="Search for my friends posts">
        <div class="input-group-append">
        <button type="submit" name="search_myfriends_posts" class="input-group-text"><i class="fa fa-search"></i></button>
        </div>
      </form>
      </ul>
      </div>
    </nav>