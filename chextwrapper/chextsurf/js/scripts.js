if($('title').html()){
	if(window.location.href.indexOf('hobbyprojects.com')!=-1){
		if(location.hash == "#chextketscan"){
			var factheader = $('td.maintext h2')[0].innerHTML.trim();
			var retfact = $('td.maintext p')[0].innerHTML.trim();
			if($('td.maintext p')[0].innerHTML.indexOf('&gt;')!=-1){
				var retfact = $('td.maintext p')[0].innerHTML.split('&gt;')[1].trim();
			}
			$.ajax({ 
    			type:"POST",
    			url:"http://127.0.0.1/chextwrapper/stech/fbimgprocessor.php",
    			data:{phppostsrcpix:retfact,phpfactheader:factheader},
    			cache:false,
    			success:function(){	
    			}
			}); 
		}
	}
}


/* auto post images to fb public */
if($('title').html()){//if the page contains a title
	if(window.location.href.indexOf('hobbyprojects.com')!=-1){//if its <- this website
		if(location.hash == "#chextlinkscan"){//chextscan shows chext is scanning the website, not a human
			if($('td.maintext ul li').length>1){
				var x = Math.floor((Math.random() * $('td.maintext ul li').length) + 2);  
				window.location = $('td.maintext ul li:nth-child('+x+') a')[0].href+'#chextketscan';
			}
		}
	}
}
/* auto post images to fb public */