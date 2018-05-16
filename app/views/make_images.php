<h1 class="title">Make a picture</h1>
<div style="display: none" id="user_id"><?php echo $auth['id']; ?></div>
<div class="error"></div>
<div id="photo_wrap">
	<div id="filter_section">
		<img class="filter" src="/public/img/filters/1.png">
		<img class="filter" src="/public/img/filters/2.png">
		<img class="filter" src="/public/img/filters/3.png">
		<img class="filter" src="/public/img/filters/4.png">
		<img class="filter" src="/public/img/filters/5.png">
		<img class="filter" src="/public/img/filters/6.png">
	</div>
	<div id="photo_section">
		<div id="camera_wrap">
			<img id="overlay" width="640" height="480" class="none" src="/public/img/filters/1.png">
			<img id="downloaded_img" width="640" height="480" class="none" src="">
			<div id="target" class="none">
				<p>You can drag an image file here</p>
				<p>or upload manualy</p>
				<input type="file" accept="image/*" id="file_input">
			</div>
			<video id="player" width="640" height="480" video id="" autoplay></video>
			<canvas id="canvas" width="640" height="480"></canvas>
		</div>
		
		
			<div id="previev_section">
				<div class="previev_box">
					<img id="previev_img" class="none">
					<p id="previev_txt">Previev</p>
				</div>
				<div id="previev_btn">
					<button id="capture" disabled="true" class="disabled">Take photo</button>
					<button id="save_picture_btn" disabled="true" class="disabled">Save photo</button>
				</div>
			</div>
	</div>
</div>
<!-- <video id="video">Video stream not available.</video> -->
<!-- <button id="startbutton">Take photo</button> -->
<!-- <canvas id="canvas"></canvas> -->
<!-- <img src="http://placekitten.com/g/320/261" id="photo" alt="photo"> -->

<script src="/public/js/cams.js"></script>
