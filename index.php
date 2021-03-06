<?php // @start snippet
include 'twilio-php-master/Services/Twilio/Capability.php';
$accountSid = 'AC09a199fd889a454b44b0dff81480e445';
$authToken  = '0ffad56024ce0e88030c49309d480008';
$token = new Services_Twilio_Capability($accountSid, $authToken);
$token->allowClientOutgoing('AP33aff95ead9e1ac06ec19de609dbd557'); // @end snippet
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Twilio Client Call
		</title>
		<!-- @start snippet -->
		<script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		var connection=null;
		$(document).ready(function(){
			Twilio.Device.setup("<?php echo $token->generateToken();?>",{"debug":true});
			$("#call").click(function() {  
				Twilio.Device.connect();
			});
			$("#hangup").click(function() {  
  				connection.sendDigits("#");
			});

			Twilio.Device.ready(function (device) {
				$('#status').text('Ready to start recording');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('Offline');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				connection=conn;
				$('#status').text("On Air");
				$('#status').css('color', 'red');
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').html('Recording ended<br/><a href="show_recordings.php">view recording list</a>');
				$('#status').css('color', 'black');
				toggleCallStatus();
			});
			
			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}
		});
		</script>
		<!-- @end snippet -->

	</head>
	<body>
		<div align="center">
		<!-- @start snippet -->
			<h3>Create a Recording</h3>
			<input type="button" id="call" value="Begin Recording"/>
			<input type="button" id="hangup" value="Stop Recording" style="display:none;"/>
			<div id="status">
				Offline
			</div>
		<!-- @end snippet -->
		</div>

	</body>
</html>
