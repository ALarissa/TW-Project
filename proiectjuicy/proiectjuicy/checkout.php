<html>
<?php 
	include "back/connect.php";
	include "back/is_logged.php";
	$logged=is_logged();
	if($logged==0){
		header('Location: http://localhost/login.php');
	} ?>
<head>
<link rel="stylesheet" href="css/style.css">
<script src="scripts/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="css/checkout.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script>
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function delcheckout(prod){
	var i=0;
	var id;
	var nume;
	var cantitate;                         
	var pret;
	var idarray;
	var numearray;
	var cantarray;
	var pretarray;
	if(getCookie("produs")!=""){
		id=getCookie("id");
		nume=getCookie("produs");
		cantitate=getCookie("cantitate");
		pret=getCookie("pret");
		idarray=id.split(",");
		numearray=nume.split(",");
		cantarray=cantitate.split(",");
		pretarray=pret.split(",");
		while(numearray[i]){
			if(idarray[i]==prod){
				idarray.splice(i, 1);
				numearray.splice(i, 1);
				cantarray.splice(i, 1);
				pretarray.splice(i, 1);
			}
			i++;
		}
	}
	if(numearray[0]){
		document.cookie="id="+idarray[0]+"; path=/";
		document.cookie="produs="+numearray[0]+"; path=/";
		document.cookie="cantitate="+cantarray[0]+"; path=/";
		document.cookie="pret="+pretarray[0]+"; path=/";
	}else{
		document.cookie="id=; expires=Thu, 10 Dec 2010 12:00:00 UTC; path=/";
		document.cookie="produs=; expires=Thu, 10 Dec 2010 12:00:00 UTC; path=/";
		document.cookie="cantitate=; expires=Thu, 10 Dec 2010 12:00:00 UTC; path=/";
		document.cookie="pret=; expires=Thu, 10 Dec 2010 12:00:00 UTC; path=/";
	}
	i=1;
	while(numearray[i]){
		document.cookie="id="+getCookie("id")+","+idarray[i]+"; path=/";
		document.cookie="produs="+getCookie("produs")+","+numearray[i]+"; path=/";
		document.cookie="cantitate="+getCookie("cantitate")+","+cantarray[i]+"; path=/";
		document.cookie="pret="+getCookie("pret")+","+pretarray[i]+"; path=/";
		i++;
		}
	showcheckout();
}
var ids;
var cants;
function showcheckout(){
	$("#checkout").html("");
	var id;
	var nume;
	var cantitate;                         
	var pret;
	var idarray;
	var numearray;
	var cantarray;
	var pretarray;
	var i=0;
	if(getCookie("produs")!=""){
		id=getCookie("id");
		nume=getCookie("produs");
		cantitate=getCookie("cantitate");
		pret=getCookie("pret");
		idarray=id.split(",");
		numearray=nume.split(",");
		cantarray=cantitate.split(",");
		pretarray=pret.split(",");
		while(numearray[i]){
			$("#checkout").html($("#checkout").html()+"<span class='textcart'>"+numearray[i]+" "+cantarray[i]+"buc. "+pretarray[i]+"RON "+"</span><span class='stergecart' onclick='delcheckout("+idarray[i]+")'>Sterge</span><br>");
			i++;
		}
	}
}
function addtocheckout(){
	var idnou=$("#idprod").html();
	var numenou=$("#nume").html();
	var cantitatenou=$("#cant").val();
	var pretnou=$("#pret").html()*cantitatenou;
	var id;
	var nume;
	var cantitate;                         
	var pret;
	var idarray;
	var numearray;
	var cantarray;
	var pretarray;
	var i=0;
	var exista=0;
	if(getCookie("produs")!=""){
		id=getCookie("id");
		nume=getCookie("produs");
		cantitate=getCookie("cantitate");
		pret=getCookie("pret");
		idarray=id.split(",");
		numearray=nume.split(",");
		cantarray=cantitate.split(",");
		pretarray=pret.split(",");
		while(numearray[i]){
			if(idarray[i]==idnou){
				exista=1;
				cantarray[i]=parseInt(cantarray[i])+parseInt(cantitatenou);
				pretarray[i]=parseInt(pretarray[i])+parseInt(pretnou);
			}
			i++;
		}
		if(exista==0){
			idarray.push(idnou);
			numearray.push(numenou);
			cantarray.push(cantitatenou);
			pretarray.push(pretnou);
		}
		document.cookie="id="+idarray[0]+"; path=/";
		document.cookie="produs="+numearray[0]+"; path=/";
		document.cookie="cantitate="+cantarray[0]+"; path=/";
		document.cookie="pret="+pretarray[0]+"; path=/";
		i=1;
		while(numearray[i]){
			document.cookie="id="+getCookie("id")+","+idarray[i]+"; path=/";
			document.cookie="produs="+getCookie("produs")+","+numearray[i]+"; path=/";
			document.cookie="cantitate="+getCookie("cantitate")+","+cantarray[i]+"; path=/";
			document.cookie="pret="+getCookie("pret")+","+pretarray[i]+"; path=/";
			i++;
			}
	}else{
		document.cookie="id="+idnou+"; path=/";
		document.cookie="produs="+numenou+"; path=/";
		document.cookie="cantitate="+cantitatenou+"; path=/";
		document.cookie="pret="+pretnou+"; path=/";
	}
	showcheckout();
}
var coordonate;
function comanda(){
	var adresa=$("#adress").val();
	if(getCookie("produs")!=""){
		if(adresa){
			window.location.href = "comanda.php?adresa="+adresa+"&coordonate="+coordonate;
		}else{
			alert("Completati campul adresa inainte de comanda!");
		}
	}else{
		alert("Nu exista produse in cart!");
	}
}
function getLocation() {
    navigator.geolocation.getCurrentPosition(showPosition);
}
function showPosition(position) {
	coordonate=position.coords.latitude+','+position.coords.longitude;
}
$("document").ready(function(){
	showcheckout();
	getLocation();
});
</script>
</head>
<body>

	<div id="meniu">
		<div id="meniu_inside">
			<img id="logo" src="images/logo.jpg" />
			<div id="meniu_items">
				<a href="/" >Home</a>
				<a href="catalog.php" style="color:#F39C12">Produse</a>
				<a href="contact.php">Contact Us</a>
				<a href="back/logout.php">Log out</a>
			</div>
			
		</div>
	</div>
	<div id="content">
	<div style="position:relative;float:left;">
	<div id="checkout"></div>
	<div><input type="text" placeholder="Adresa livrare" id="adress"/></div>
	<div onclick="comanda()" id="sendc">Trimite comanda</div>

	</div>
	</div>
</body>
</html>