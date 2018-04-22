<?php  
    if(isset($_POST['phppostsrcpix'])){
        include('phpdatabases/connect-db.php');
        $phppostsrc = mysqli_real_escape_string($conn, $_POST['phppostsrcpix']);
        $phpfacthead = mysqli_real_escape_string($conn, $_POST['phpfactheader']);
        $setpostinfo = "UPDATE fbketfacts SET facthead='$phpfacthead',facts='$phppostsrc',status='undone'";
        $conn->query($setpostinfo);
        $content = file_get_contents("http://localhost/chextwrapper/stech/imagecreator.php");
        $concstr = rand(100,9000);
        $fp = fopen("../allketuploads/chimage".$concstr.".jpg", "w");
        fwrite($fp, $content);
        fclose($fp);
        $setpostinfo = "UPDATE fbketfacts SET status='done'";
        $conn->query($setpostinfo);
        include('phpdatabases/close-connect-db.php');
        exit(0);
    }
?>

<html>
<head>
    <title>fbimgprocessor</title>
    <link rel="shortcut icon" type="image/x-icon" href="../chextsurf/img/chextsurf.png" />
    <script src="../chextsurf/js/jquery-3.2.1.min.js"></script>
    <script>
    function ajaxcall(){    
        $.ajax({ 
            type:"POST",
            url:"checkdirstatus.php",
            data:{},
            cache:false,
            success:function(data){
                if(encodeURI(data) != "%0D%0A%0D%0A"){
                    if(data == "empty"){
                        var allalpha = "abcdefghijklmnopqrstuvwxyz"; 
                        var x = Math.floor((Math.random() * 25) + 0);    
                        var openedwindow  = window.open("http://www.hobbyprojects.com/computer-terms-dictionary/computer-dictionary-"+allalpha[x]+"#chextlinkscan",
                            "_blank","width=300,height=200");
                        setTimeout(function(){ openedwindow.close(); }, 30000);
                    }             
                }
            }
        });
    } 

    var refinterval = 60;
    var trimtosec = refinterval*1000;
    setInterval(ajaxcall, trimtosec);
    </script>
</head>   
<body style="overflow-x:hidden;">
    <img src="../chextsurf/img/chextsurf.png" style="margin:19% 45%;"/>
</body>
</html>