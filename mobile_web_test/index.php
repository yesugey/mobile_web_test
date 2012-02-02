<html>
<head>
  <title>Hello World</title>
  <meta name="viewport" 
        content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
</head>

	<body>



<div id="fb-root"></div>
<script>

// add Facebook Javascript SDK
  (function() {
    var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
        }());

// identify user in order to make API calls on their behalf
  window.fbAsyncInit = function() {


    // init() is called in order to initialize the Facebook JS SDK
    FB.init({ appId: '354979144526634', 
      status: true, 
      cookie: true,
      xfbml: true,
      oauth: true});

    // we need to know whenever a Facebook has authenticated with your app, so we subscribe to the auth.authResponseChange event
      FB.Event.subscribe('auth.authResponseChange', handleResponseChange);  
    };

// need to know whenever Facebook has authenticated with the app
// define the handleResponseChange callback function to handle the response

  function handleResponseChange(response) {
      document.body.className = response.authResponse ? 'connected' : 'not_connected';
      if (response.authResponse) {
        console.log(response);

        updateUserInfo(response);
      }
    }
 </script>

<!-- If a user doesn't come to your web app via Facebook,
they will not see this auth dialog -->

<div id="login">
   <p><button onClick="loginUser();">Login</button></p>
 </div>
 <div id="logout">
   <p><button  onClick="FB.logout();">Logout</button></p>
 </div>

 <script>
   function loginUser() {    
     FB.login(function(response) { }, {scope:'user_about_me, user_activities, user_birthday, user_hometown'});     
     }
 </script>



	</body>
</html>

<style>
  body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
      body.not_connected #logout { display: none; }
</style>

 <div id="user-info"></div>
 <script>
   function updateUserInfo(response) {
     FB.api('/me', function(response) {
       document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
     });
   }
 </script>
