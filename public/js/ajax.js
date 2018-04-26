function ajaxGet(url) {
	var ghttp = new XMLHttpRequest();
	ghttp.open("GET", url, true);
	ghttp.send();
	// 4. Если код ответа сервера не 200, то это ошибка
	if (ghttp.status != 200) {
		// обработать ошибку
		alert( ghttp.status + ': ' + ghttp.statusText ); // пример вывода: 404: Not Found
	} else {
		// вывести результат
		alert( ghttp.responseText ); // responseText -- текст ответа.
	}
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
	// 4. Если код ответа сервера не 200, то это ошибка
	if (xhttp.status != 200) {
		// обработать ошибку
		alert( phttp.status + ': ' + phttp.statusText ); // пример вывода: 404: Not Found
	} else {
		// вывести результат
		alert( phttp.responseText ); // responseText -- текст ответа.
	}
	phttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return this;
		}
	};
}
