<!DOCTYPE html>
<html>
<head>
	<title>Chatbot</title>
	<script src="https://unpkg.com/rivescript@latest/dist/rivescript.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="main.js"></script> -->
</head>
<body>
	<center>
	<input type="text" name="msg" id="msg">
	<p>tips: Enter to send message</p>
	<div id="wrapper">
	<div id="bot"></div>
	</div>
	<br>
	<div id="d1" style="display: none">
	<form action='index.php' method="post">
	<input type="text" id="data" name="data" value=""/>
	<input type="submit" name="btn1" value="Confirm">
	</form>
	</div>
	</center>
	<script type="text/javascript">
		var num=0;
		$(document).ready(function(){

	let btn = $("#btn");
	let div = $("#bot");
let bot = new RiveScript();

// Load a directory full of RiveScript documents (.rive files). This is for
// Node.JS only: it doesn't work on the web!
bot.loadFile("bot.rive", loading_done, loading_error);

function loading_done(){
	console.log("Loaded Successfully");
	bot.sortReplies();
}
function loading_error(){
	console.log("Loading Failed");
}

$(document).keypress(function(e) {
if(e.which == 13) {
	let input = $("#msg").val();
	let reply = bot.reply("local-user",input);
	div.html(reply);
	$("#msg").val('');
	$("#msg").focus();
	let n = reply.search("id.");
	if(n!=-1){
		var num = reply.substring(5,7);
		$('#data').val(num);
		$('#d1').css('display','block');
	}
}
});

});
	</script>
	<style media="screen">
#wrapper{
	border: 2px solid green;
    border-radius: 5px;
		margin-left:500px;
		margin-right: 500px;
		padding-bottom: 200px;
}
	</style>
</body>
</html>
<?php
include('connection.php');
if(isset($_REQUEST['data'])){
	$a = $_REQUEST['data'];
	$query = "SELECT status FROM `O-rder` WHERE id=$a";
	$b = mysqli_query($connect, $query);
	$c = mysqli_fetch_array($b);
	$d = mysqli_num_rows($b);
	if($d!=0){
	if($c['status'] == 0){
		echo "Your order is placed";
	}
	else if($c['status'] == 1){
		echo "Your order is on the way";
	}
	else if($c['status'] == 2){
		echo "Your order is Delivered";
	}
}
	else{
		echo "Your order detail is invalid";
	}
}
?>
