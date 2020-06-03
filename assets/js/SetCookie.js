$(document).ready(function(){  
	cookieAgreement = getCookie('userConsent');
	if(cookieAgreement==""){
		setTimeout(function () {
	        $("#cookieConsent").fadeIn(100);
	     }, 1000);
		// setCookie("userConsent","Accepted",30);
	}
	// else{ //for testing purpose only
	// 	alert("Deleting Cookie");
	// 	document.cookie = "userConsent=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	// }
	function getCookie(cname) {
		  var name = cname + "=";
		  var decodedCookie = decodeURIComponent(document.cookie);
		  var ca = decodedCookie.split(';');
		  for(var i = 0; i <ca.length; i++) {
		    var c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}
    $("#closeCookieConsent, .cookieConsentOK").click(function() {
    	// Set a cookie
		setCookie("userConsent","Accepted",30,"Strict");
		$("#cookieConsent").fadeOut(200);
    });

}); 
function setCookie(cname, cvalue, exdays,SameSiteValue) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	
	if(SameSiteValue == 'None'){
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;SameSite=" + SameSiteValue;
	}else{
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;SameSite=" + SameSiteValue;
	}

}