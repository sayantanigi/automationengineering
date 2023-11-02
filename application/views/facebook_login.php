<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login With Facebook Using CodeIgniter</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">Login With Facebook Using CodeIgniter</h2>
   <br />
   <div class="panel panel-default">
 <?php if(!empty($authURL)){ ?>
    <a href="<?php echo $authURL; ?>">Facebook Login</a>
 <?php }else{ ?>
 <div class="panel-heading">Welcome User</div>
 <div class="panel-body">
 <img class="img-responsive img-circle img-thumbnail" src="<?php echo $userData['picture_url']; ?>"/>
 <p><b>Facebook ID:</b> <?php echo $userData['oauth_uid']; ?></p>
 <p><b>Name:</b> <?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
 <p><b>Email:</b> <?php echo $userData['email']; ?></p>
 <p><b>Gender:</b> <?php echo $userData['gender']; ?></p>
 <p><b><a href="<?php echo $logoutURL; ?>">Logout</a></p>
 </div>
 <?php } ?>
   </div>
  </div>
 </body>
</html>
