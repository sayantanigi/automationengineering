<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js" charset="utf-8"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.min.js" charset="utf-8"></script>


  <div id="videos">
    <div id="subscriber"></div>
    <div id="publisher"></div>
  </div>

  <style>
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
    width: 220px;
    height: 150px;
    bottom: 10px;
    left: 10px;
    z-index: 100;
    border: 3px solid white;
    border-radius: 3px;
  }
 /* #publisher {
    position: absolute;
    width: 360px;
    height: 240px;
    bottom: 10px;
    left: 10px;
    z-index: 100;
    border: 3px solid white;
    border-radius: 3px;
  }*/
</style>

  <script>
    /* global OT API_KEY TOKEN SESSION_ID SAMPLE_SERVER_BASE_URL */
    // (optional) add server code here

    var SERVER_BASE_URL = '<?= base_url('livevideo/liveVideoSession/'.@$friendId) ?>';
    var API_KEY;
    var SESSION_ID;
    var TOKEN;

    function handleError(error) {
      if (error) {
        console.error(error);
      }

    }

    function initializeSession() {
      var session = OT.initSession(apiKey, sessionId);
      // Subscribe to a newly created stream
      session.on('streamCreated', function streamCreated(event) {
        var subscriberOptions = {
          insertMode: 'append',
          width: '100%',
          height: '100%',
          name:'<?php echo @$subscriber->name; ?>'
        };
        session.subscribe(event.stream, 'subscriber', subscriberOptions, handleError);
      });

      session.on('sessionDisconnected', function sessionDisconnected(event) {
        console.log('You were disconnected from the session.', event.reason);

      });

      // initialize the publisher
      var publisherOptions = {
        insertMode: 'append',
        width: '100%',
        height: '100%',
        name:'<?php echo @$profile->name; ?>'
      };

      var publisher = OT.initPublisher('publisher', publisherOptions, handleError);
      // Connect to the session
      session.connect(token, function callback(error) {
        if (error) {
          handleError(error);
        } else {
          // If the connection is successful, publish the publisher to the session
          session.publish(publisher, handleError);
        }
      });
    }
    // See the config.js file.

    if (API_KEY && TOKEN && SESSION_ID) {
      apiKey = API_KEY;
      sessionId = SESSION_ID;
      token = TOKEN;
      initializeSession();
    } else if (SERVER_BASE_URL) {
      // Make an Ajax request to get the OpenTok API key, session ID, and token from the server
      fetch(SERVER_BASE_URL).then(function fetch(res) {
        return res.json();
      }).then(function fetchJson(json) {
        apiKey = json.apiKey;
        sessionId = json.sessionId;
        token = json.token;
        initializeSession();
      }).catch(function catchErr(error) {
        handleError(error);
        alert('Failed to get opentok sessionId and token.');

      });

    }
  </script>
