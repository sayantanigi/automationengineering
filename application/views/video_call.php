
<html>
<head>
    <title> OpenTok Getting Started </title>
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
</head>
<style type="text/css">
	body, html {
    background-color: gray;
    height: 100%;
}

#videos {
    position: relative;
    width: 100%;
    height: 100%;
    margin-left: auto;
    margin-right: auto;
}

#subscriber {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
}

#publisher {
    position: absolute;
    width: 360px;
    height: 240px;
    bottom: 10px;
    left: 10px;
    z-index: 100;
    border: 3px solid white;
    border-radius: 3px;
}

</style>
<body>
	<h1>Video Calling</h1>
    <div id="videos">
        <div id="subscriber"></div>
        <div id="publisher"></div>
    </div>

    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>


<script type="text/javascript">
	// replace these values with those generated in your TokBox Account
var apiKey = "47384371";
var sessionId = "2_MX40NzM4NDM3MX5-MTYzOTQ2NTMxMjYzMn5YbzBKbXFFWktzSTg3NDVUSUkzcHQ1c3N-fg";
var token = "T1==cGFydG5lcl9pZD00NzM4NDM3MSZzaWc9ZGY4MGY2NDIyOTA3MTdiMzJlYmY1NjE5ZGFjNTliMmMxODMyODcwNzpzZXNzaW9uX2lkPTJfTVg0ME56TTRORE0zTVg1LU1UWXpPVFEyTlRNeE1qWXpNbjVZYnpCS2JYRkZXa3R6U1RnM05EVlVTVWt6Y0hRMWMzTi1mZyZjcmVhdGVfdGltZT0xNjM5NDY1MzEzJm5vbmNlPTAuNTgxMzk1OTI3MDgyNTQ1MyZyb2xlPW1vZGVyYXRvciZleHBpcmVfdGltZT0xNjM5NDY3MTEzJmluaXRpYWxfbGF5b3V0X2NsYXNzX2xpc3Q9";

// (optional) add server code here
initializeSession();

// Handling all of our errors here by alerting them
function handleError(error) {
  if (error) {
    alert(error.message);
  }
}

// (optional) add server code here
// initializeSession();

function initializeSession() {
  var session = OT.initSession(apiKey, sessionId);

  // Subscribe to a newly created stream
  session.on('streamCreated', function(event) {
    session.subscribe(event.stream, 'subscriber', {
      insertMode: 'append',
      width: '100%',
      height: '100%'
    }, handleError);
  });

  // Create a publisher
  var publisher = OT.initPublisher('publisher', {
    insertMode: 'append',
    width: '100%',
    height: '100%'
  }, handleError);

  // Connect to the session
  session.connect(token, function(error) {
    // If the connection is successful, initialize a publisher and publish to the session
    if (error) {
      handleError(error);
    } else {
      session.publish(publisher, handleError);
    }
  });
}


</script>