<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '361862767338317',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script>
	function shareUrlToFacebook(element, url) {
		FB.ui({
		  method: 'share',
		  href: url,
		}, function(response){});
	}
</script>