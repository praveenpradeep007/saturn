if(window.location.href.indexOf('whatsapp')!=-1){
	var seaoneliner;
	var senoneliner;
	function replybackmessage(){
		if(location.hash == "#chextscan"){
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
    							var openedwindow  = window.open(chatmessage);
								setTimeout(function(){ openedwindow.close(); }, 60000);
								chatmessage = "Adding you can continue ...";
    						}
    						chrome.runtime.sendMessage({redirect: "javascript:function go(){window.InputEvent = window.Event || window.InputEvent;var event = new InputEvent('input', {bubbles: true});var textbox = document.querySelector('#main  footer  div._2S1VP');textbox.textContent = '"+chatmessage+"';textbox.dispatchEvent(event);document.querySelector('._2lkdt').click();} go();"});
						}
    			}
			});	
			}	
		}
	}
	setInterval(replybackmessage, 5000);
}

/* images for whatsapp chat from pixabay */
else if(location.href.indexOf('pixabay.com')!=-1){
	if(location.hash == "#chextmesscan"){
		setTimeout(extractimages,10000);
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
    				//do nothing ...
    			}
			});
		}
	}
}
/* images for whatsapp chat from pixabay */