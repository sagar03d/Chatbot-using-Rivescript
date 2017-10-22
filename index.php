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
	<input type="submit" name="reply" id="btn" value="Reply">
	<div id="bot"></div>
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

	btn.click(function(){
		let input = $("#msg").val();
		let reply = bot.reply("local-user",input);
		div.html(reply);
		let n = reply.search("id.");
		if(n!=-1){
			var num = reply.substring(5,7);
			$('#data').val(num);
			$('#d1').css('display','block');
		}

	});
});
	</script>
</body>
</html>
<?php
include('connection.php');
if(isset($_REQUEST['data'])){
	$a = $_REQUEST['data'];
	$query = "SELECT email FROM admin WHERE id=$a";
	$b = mysqli_query($connect, $query);
	$c = mysqli_fetch_array($b);
	print_r($c);
}
?>