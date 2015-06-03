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
function delcart(prod){
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
	showcart();
}
function showcart(){
	$("#cart").html("");
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
			$("#cart").html($("#cart").html()+"<span class='textcart'>"+numearray[i]+" "+cantarray[i]+"buc. "+pretarray[i]+"RON "+"</span><span class='stergecart' onclick='delcart("+idarray[i]+")'>Sterge</span><br>");
			i++;
		}
		$("#cart").html($("#cart").html()+"<a id='chk' href='checkout.php'>Checkout</a>");
	}
}
function addtocart(){
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
	showcart();
	displaycart('added');
}
var cartshow=0;
function displaycart(a){
	if(cartshow==0){
		$("#cart").css("display","block");
		cartshow=1;
	}else{
		$("#cart").css("display","none");
		cartshow=0;
	}
	if(a=='added'){
		$("#cart").css("display","block");
		cartshow=0;
	}
}
$("document").ready(function(){
	showcart();
});