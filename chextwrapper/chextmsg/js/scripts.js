if(window.location.href.indexOf('whatsapp')!=-1){
	if(location.hash == "#chextscan"){
		setInterval(replybackmessage, 5000);
		setInterval(searchoneliner, 21600000);
		setInterval(sendoneliner, 21620000);
	}	
}
else if(location.href.indexOf('pixabay.com')!=-1){
	if(location.hash == "#chextmesscan"){
		setTimeout(extractimages,10000);
	}
}
else if($('title').html().indexOf('OneLineFun.com')!=-1){
	if(location.search == "?chextonscan"){
		var articleno = Math.floor((Math.random() * $('div.o p').length) + 1);
		var postsrc= $($('div.o p')[articleno]).html();
		var pagearticle = window.location.href + '/'+ articleno;
		$.ajax({ 
    		type:"POST",
    		url:"http://127.0.0.1/chextwrapper/stech/processor.php",
    		data:{phppostsrcsup:postsrc,phppagearticlesup:pagearticle},
    		cache:false,
    		success:function(){	
    		}
		});   
	}
}



//LOC for all functions(do not cross, you will be shot)
function replybackmessage(){
	if($($('#main div.vW7d1:last  div')[0]).hasClass('message-in')){
		lastmessage = $('#main div.message-in:last span.selectable-text')[0].innerText;
		$.ajax({
   			type:"POST",
   			url:"http://127.0.0.1/chextwrapper/stech/processor.php",
   			data:{phpsetdata:lastmessage},
   			cache:false,
   			success:function(data){
   				var chatmessage = "";
   				if(encodeURI(data) != "%0D%0A%0D%0A"){
   					chatmessage = data.replace(/'/g,"").replace(/"/g,"");
   					if(chatmessage.indexOf('pixabay')!=-1){
   						var openedwindow  = window.open(chatmessage,"_blank","width=300,height=200");
						setTimeout(function(){ openedwindow.close(); }, 60000);
						chatmessage = "Adding you can continue ...";
   					}
   					chrome.runtime.sendMessage({redirect: "javascript:function go(){window.InputEvent = window.Event || window.InputEvent;var event = new InputEvent('input', {bubbles: true});var textbox = document.querySelector('#main  footer  div._2S1VP');textbox.textContent = '"+chatmessage+"';textbox.dispatchEvent(event);document.querySelector('._2lkdt').click();} go();"});
				}
   			}
		});	
	}	
}
function searchoneliner(){
	var pageno = Math.floor((Math.random() * 421) + 1);     
   	var opwindow  = window.open("https://www.onelinefun.com/"+pageno+"/?chextonscan","_blank","width=300,height=200");
   	setTimeout(function(){ opwindow.close(); }, 30000);
}
function sendoneliner(){
	if($($('#main')[0]).length){
		if($($('#main div.vW7d1:last  div')[0]).hasClass('message-out') || !$($('#main div.vW7d1:last')[0]).length ){
			$.ajax({
   			type:"POST",
   			url:"http://127.0.0.1/chextwrapper/stech/processor.php",
   			data:{phpsetonelinedata:'democheck'},
   			cache:false,
   			success:function(data){
   				var chatmessage = "";
   				if(data){
   					if(encodeURI(data) != "%0D%0A%0D%0A"){
   						chatmessage = data.replace(/'/g,"").replace(/"/g,"");
   						chrome.runtime.sendMessage({redirect: "javascript:function go(){window.InputEvent = window.Event || window.InputEvent;var event = new InputEvent('input', {bubbles: true});var textbox = document.querySelector('#main  footer  div._2S1VP');textbox.textContent = '"+chatmessage+"';textbox.dispatchEvent(event);document.querySelector('._2lkdt').click();} go();"});
					}
				}
   			}
			});
		}	
	}
}
function extractimages(){
	var mainfol = location.search.split('infol=')[1];
	var imgname = location.pathname.split('/')[3];
	var k;var imgsrc;var t=[];
	for(k=0;k<10;k++){
		if($('img').length && $($('div.credits img')[k])['0'].currentSrc.length>0){
			imgsrc = $($('div.credits img')[k])['0'].currentSrc;
			t.push(imgsrc);
		}
	}
	imgsrc = JSON.stringify(t);
	$.ajax({
    	type:"POST",
    	url:"http://127.0.0.1/chextwrapper/stech/processor.php",
    	data:{phpsetimagedatapix:imgsrc,phpsetimagepath:mainfol,phpimgname:imgname},
    	cache:false,
    	success:function(data){
    	}
	});
}
//(bammmm !!!!!)