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
			var num = reply.substring(5,9);
			$.ajax({
				url: 'index.php',
				method: 'post',
				data: {data:num}
			});
		}
	});

});