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
			console.log(test);
	// 		var comments = document.getElementById('comments' + f.img_id.value);
	// 		var div = document.createElement('div');

	// 		div.classList.add("pure-u-1");
	// 		div.classList.add("comment");
	// 		div.innerHTML = test;
	// 		comments.appendChild(div);
	// 		f.comment.value = "";
		}
	};
}