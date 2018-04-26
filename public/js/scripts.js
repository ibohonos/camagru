function save_comment(f) {
	var data = "comment=" + f.comment.value + "&img_id=" + f.img_id.value;
	console.log(data);


	var phttp = new XMLHttpRequest();
	phttp.open("POST", "/profile/saveComment/", true);
	phttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	phttp.send(data);
	// 4. Если код ответа сервера не 200, то это ошибка
	if (phttp.status != 200) {
		// обработать ошибку
		alert( phttp.status + ': ' + phttp.statusText ); // пример вывода: 404: Not Found
	} else {
		// вывести результат
		alert( phttp.responseText ); // responseText -- текст ответа.
	}
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this);
		}

	};

	// console.log(res);
	// console.log(f.img_id.value);
}