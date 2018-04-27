<?php
	if ($auth && LikesModel::liked($auth['id'], $val['id'], 'photo')) :
		$like = "dislike";
	else :
		$like = "like";
	endif;
?>
		<div class="likes <?php echo $like; ?>" id="likes<?php echo $val['id']; ?>" onclick="likes(<?php echo $val['id']; ?>, <?php echo $auth['id']; ?>, 'photo')"></div>
		<span class="count_l" id="count_l<?php echo $val['id']; ?>"><?php echo LikesModel::count_likes($val['id'], 'photo'); ?></span>
	<div class="clearfix"></div>
