const fileInput = document.getElementById('file_input');
const target = document.getElementById('target');
const player = document.getElementById('player');
const downloaded_img = document.getElementById('downloaded_img');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
context.translate(640, 0);
context.scale(-1, 1);
const captureButton = document.getElementById('capture');
const saveButton = document.getElementById('save_picture_btn');
const filters = document.querySelectorAll('.filter');
const overlay = document.getElementById('overlay');
const previevImg = document.getElementById('previev_img');
const user_id = document.getElementById('user_id').innerHTML;
var is_video = false;
var is_downloaded = false;
const previev_txt = document.getElementById('previev_txt');

navigator.getMedia = ( navigator.getUserMedia ||
	navigator.webkitGetUserMedia ||
	navigator.mozGetUserMedia ||
	navigator.msGetUserMedia);

navigator.getMedia(
	{
		video: true,
		audio: false
	},
	function(stream) {
		if (navigator.mozGetUserMedia) {
			player.mozSrcObject = stream;
		} else {
			player.srcObject = stream;
		}
		player.play();
		is_video = true;
	},
	function(err) {
		is_video = false;
		captureButton.disabled = true;
		captureButton.classList.add('disabled');
		player.classList.add('none');
		target.classList.remove('none');
	}
);

captureButton.addEventListener("click", ft_capture);

function ft_capture()
{
	if (is_video)
		context.drawImage(player, 0, 0, 640, 480);
	else
		context.drawImage(downloaded_img, 0, 0, 640, 480);

	var image = canvas.toDataURL("image/png");
	var data = "overlay=" + overlay.src + "&photo=" + image;
	var error = document.getElementsByClassName("error");
	var phttp = new XMLHttpRequest();
	error = error[0];

	phttp.open("POST", "/profile/make_photo/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;

			previevImg.src = test;
			previevImg.classList.remove('none');
			saveButton.disabled = false;
			saveButton.classList.remove('disabled');
			previev_txt.classList.add("none");
		}
	};
}

function file_handler(fileList)
{
	var error = document.getElementsByClassName("error");
	error = error[0];

	if (fileList[0].type.match(/^image\//) && fileList[0].size < 10000000)
	{
		if (fileList[0] !== null)
		{
			var file = fileList[0];
			if(file.type !== '' && !file.type.match('image.*'))
			{
				error.innerHTML = "not an image";
				return;
			}
			window.URL = window.URL || window.webkitURL;
			var imageURL = window.URL.createObjectURL(file);

			is_downloaded = true;

			captureButton.disabled = false;
			captureButton.classList.remove('disabled');

			target.classList.add('none');
			downloaded_img.src = imageURL;  
			downloaded_img.classList.remove('none');
			context.drawImage(downloaded_img, 0, 0, 640, 480);
		}
	}
}

function filter_handler()
{
	var error = document.getElementsByClassName("error");
	error = error[0];

	if (is_video == false && is_downloaded == false)
	{
		error.innerHTML = "Please upload image.";
		return;
	}
	if (this.classList.contains('selected_filter'))
	{
		this.classList.remove('selected_filter');
		overlay.classList.add('none');
		overlay.src = "";
		captureButton.disabled = true;
		captureButton.classList.add('disabled');

	} else {
		filters.forEach(function(elem) {
			elem.classList.remove('selected_filter');
		});
		this.classList.add('selected_filter');
		overlay.classList.remove('none');
		overlay.src = this.src;
		captureButton.disabled = false;
		captureButton.classList.remove('disabled');
	}
}

saveButton.addEventListener("click", photo_saver);

function photo_saver() {
	var data = "id_user=" + user_id + "&pic=" + previevImg.src;
	var error = document.getElementsByClassName("error");
	var phttp = new XMLHttpRequest();
	error = error[0];

	phttp.open("POST", "/profile/save_photo/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;
			if (test === "Success") {
				previevImg.removeAttribute("src");
				previevImg.classList.add('none');
				previev_txt.innerHTML = "Photo saved";
				previev_txt.classList.remove("none");
				saveButton.disabled = true;
				saveButton.classList.add('disabled');
			} else if (test === "notloginned") {
				window.location.href = '/login/';
			} else {
				error.innerHTML = test;
			}
		}
	};
}

target.addEventListener('drop', (e) => {
	e.stopPropagation();
	e.preventDefault();
	file_handler(e.dataTransfer.files);
});

target.addEventListener('dragover', (e) => {
	e.stopPropagation();
	e.preventDefault();
	e.dataTransfer.dropEffect = 'copy';
});

fileInput.addEventListener('change', (e) => file_handler(e.target.files));

filters.forEach(function(elem) {
	elem.addEventListener('click', filter_handler);
});
