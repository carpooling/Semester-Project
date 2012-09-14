<html>
    <head>
      <title>RideSynth Facebook Login</title>
    </head>
    <body>

      <div id="fb-root"></div>
      <script type="text/javascript">
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '356974527720638', // App ID
            channelUrl : 'http://carpool.pasindu.me/carsynth.php', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
          });
		  
	
		  
		  // To get the image and the name of the user
		  FB.api('/me', function(user) {
            if (user) {
              var image = document.getElementById('image');
              image.src = 'http://graph.facebook.com/' + user.id + '/picture';
              var name = document.getElementById('name');
              name.innerHTML = user.name
            }
          });
		  
		  // To post on the users wall
			
			
			  
		  
        
		
		
        
	


FB.ui({ method: 'feed', 
              message: 'Facebook for Websites is super-cool'});

 
};
		
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
		   
         }(document));
      


</script>
      <div class="fb-login-button" id ="email" scope="email,user_checkins,user_birthday,user_location" >
	  Login with Facebook
		</div>
		
		<div>
		<input id="clickMe" type="button" value="clickme" onclick="myFunction()" >
		</div>

		
	   <div class="fb-like"></div>
	   <div align="center">
        <img id="image" src="http://www.google.com" >
        <div id="name"></div>
      </div>
	  
    </body>
 </html>
 