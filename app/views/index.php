<h1 class="title">Camagru</h1>
<div class="test">
	<p>
		Hello world
	</p>
	<?php foreach ($data as $k => $v) : ?>
		<?php echo $v['first_name'] . " " . $v['last_name'] . " " . $v['email']; ?><br>
	<?php endforeach; ?>

	<pre>
		<?php print_r($auth); ?>
	</pre>

	<video id="video">Video stream not available.</video>
	<button id="startbutton">Take photo</button>
	<canvas id="canvas"></canvas>
	<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
</div>
<script src="/public/js/cams.js"></script>
