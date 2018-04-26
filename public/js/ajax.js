function ajaxGet(url) {
	var ghttp = new XMLHttpRequest();
	ghttp.open("GET", url, true);
	ghttp.send();
	ghttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return this;
		}
	};
}

function ajaxPost(url, data) {
	var phttp = new XMLHttpRequest();
	phttp.open("POST", url, true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return this;
		}
	};
}
