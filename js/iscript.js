var gotoStep2 = function(){
	$('#step1').hide();
	$('#step2').show();
}

	function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    if (response.status === 'connected') {
	      console.log("Logado e  autorizado");
	      getUserFInformation();
	    } else if (response.status === 'not_authorized') {
	      	console.log("não autorizou aplicativo");
	    } else {
	      	console.log("deslogado logado no facebook");
	    }
	}

	function logFacebook(){
		 
		 FB.login(statusChangeCallback, {scope: 'public_profile,email'});
	}

	function getUserFInformation() {
	    console.log('getUserFInformation');
	    showLoad("Getting facebook user informations");
	    FB.api('/me', function(response) {
	    	$('#new_name').val(response.name);
	    	$('#new_email').val(response.email);
			$('#facebookId').val(response.id);
			hideLoad();
	    });
	}

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1491846201075642',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
