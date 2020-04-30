<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<!-- Add post Modal -->
<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-12 scroll-sidebar" style="max-height:89vh; overflow: auto;">
			<div class="modal-body">
        <h1>Add a group</h1>
        <form action="<?php echo URLROOT; ?>/groups/add" method="post" enctype="multipart/form-data">
          <div class="form-group"><label for="group_name">Group name: <sup>*</sup></label>
            <input type="text" name="group_name" value="<?php echo $data['group_name']; ?>" class="form-control form-control-md <?php echo (!empty($data['group_name_err'])) ? 'is-invalid' : ''; ?>" class="group_name" required>
            <span class="invalid-feedback"><?php echo $data['group_name_err']; ?></span>
          </div>
          <div class="form-group"><label for="group_image">Post image: <sup>*</sup></label>
            <input type="file" name="group_image" value="<?php echo $data['group_image']['name']; ?>" class="form-control form-control-md">
          </div>
          <div class="form-group"><label for="group_b_image">Group background image: <sup>*</sup></label>
            <input type="file" name="group_b_image" value="<?php echo $data['group_b_image']['name']; ?>" class="form-control form-control-md">
          </div>
          
          <?php
          $i = 0;
          foreach ($data['friends'] as $friend) {
            if($i%6 == 0){
              echo "<div class='row mb-3'>";
            }
            echo "<div class='col-2'><label class='container'><input type='checkbox' name='members_ids[]' value='{$friend->user_id}'><span class='checkmark'></span></label><img class='friends-checkboxes-images' src='" . profile_image($friend) .  "'>{$friend->user_name}<br></div>";
            if($i%6 == 5){
              echo "</div>";
            }elseif($i == $data['count_friends']){
              echo "</div>";
            }
            $i++;
          }
          ?>
          <span><?php echo $data['members_ids_err']; ?></span>
          <input type="submit" value="Add Group" name="add_group" class="btn btn-success btn-block">
        </form>
      </div>
		</div>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>