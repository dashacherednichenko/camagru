load_gallery();

function load_gallery(_page) {
	let _url = "?page=" + _page;
	let ajaxify = new XMLHttpRequest();
	ajaxify.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200){
			// console.log(xhttp.responseText);
			document.body.innerHTML = ajaxify.responseText;
		}

	};
	ajaxify.open('GET', _url, true);
	ajaxify.send();
}