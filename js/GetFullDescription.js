function GetFullDescription(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("home-anuntzio" + id + "-deskripzio").innerHTML =
				this.responseText;
		}
	};
	xhttp.open("GET", '../php/GetAdDescription.php?ad_id=' + id, true);
	xhttp.send();
}