function save_comment(f) {
	var data = "comment=" + f.comment.value + "&img_id=" + f.img_id.value;
	var phttp = new XMLHttpRequest();

	phttp.open("POST", "/profile/saveComment/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;
			var comments = document.getElementById('comments' + f.img_id.value);
			var div = document.createElement('div');

			div.classList.add("pure-u-1");
			div.classList.add("comment");
			div.innerHTML = test;
			comments.appendChild(div);
			f.comment.value = "";
		}
	};
}

function likes(img_id, user_id, type)
{
	var data = "user_id=" + user_id + "&img_id=" + img_id + "&type=" + type;
	var phttp = new XMLHttpRequest();

	phttp.open("POST", "/home/likes/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;
			var like = document.getElementById("likes" + img_id);
			var count = document.getElementById("count_l" + img_id);
			num = Number(count.innerHTML);
			if (test === "liked") {
				like.classList.remove("like");
				like.classList.add("dislike");
				count.innerHTML = num + 1;
			}
			else if (test === "disliked") {
				like.classList.remove("dislike");
				like.classList.add("like");
				count.innerHTML = num - 1;
			}
		}
	};
}

function login(f) {
	var data = "email=" + f.email.value + "&password=" + f.password.value;
	var error = document.getElementsByClassName("error");
	var error = error[0];
	var phttp = new XMLHttpRequest();

	phttp.open("POST", "/login/auth/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;
			if (test === "Success" || test === "loginned") {
				window.location.href = '/';
			} else {
				error.innerHTML = test;
			}
		}
	};
}

function register(f) {
	var data = "first_name=" + f.first_name.value + "&last_name=" + f.last_name.value + "&email=" + f.email.value + "&password=" + f.password.value + "&conf_password=" + f.conf_password.value;
	var error = document.getElementsByClassName("error");
	var error = error[0];
	var phttp = new XMLHttpRequest();

	phttp.open("POST", "/register/save/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var test = this.responseText;
			if (test === "Success") {
				window.location.href = '/login/';
			} else if (test === "loginned") {
				window.location.href = '/';
			} else {
				error.innerHTML = test;
			}
		}
	};
}
