load_gallery();

function load_gallery(_page) {
	let _url = "?page=" + _page;
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200){
			console.log(xhttp.responseText);
			document.body.innerHTML = xhttp.responseText;
		}

	};
	xhttp.open('GET', _url, true);
	xhttp.send();
}