
function GetFullDescription(id)
{
	if(XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else
		xhr = new ActiveXObject("Microsoft.XMLHTTP");

	xhr.open('GET', 'iruzkina.php?id='+id, false);
	xhr.send('');
	document.getElementById('iruzkin' + id).innerHTML = xhr.responseText;
}