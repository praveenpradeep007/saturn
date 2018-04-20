<?php  
    if(isset($_POST['phppostsrcpix'])){
        include('phpdatabases/connect-db.php');
        $phppostsrc = mysqli_real_escape_string($conn, $_POST['phppostsrcpix']);
        $phpfacthead = mysqli_real_escape_string($conn, $_POST['phpfactheader']);
        $setpostinfo = "UPDATE fbketfacts SET facthead='$phpfacthead', facts='$phppostsrc', status='undone'";
        $conn->query($setpostinfo);
        $content = file_get_contents("http://localhost/chextwrapper/stech/imagecreator.php");
        $concstr = rand(100,9000);
        $fp = fopen("../../allketuploads/chimage".$concstr.".jpg", "w");
        fwrite($fp, $content);
        fclose($fp);
        $setpostinfo = "UPDATE fbketfacts SET status='done'";
        $conn->query($setpostinfo);
        include('phpdatabases/close-connect-db.php');
        exit(0);
    }
    else{
        $dirsize = sizeof(scandir("../../allketuploads"));
        $dirstatus = "notempty";
        if($dirsize<4){
            $dirstatus = "empty";
        }
    }
?>

<html>
<head>
    <title>fbimgprocessor</title>
</head>   
<body>
</body>
<script src="../chextsurf/js/jquery-3.2.1.min.js"></script>
<script>   
var refinterval = 900;
var trimtosec = refinterval*1000;
var dirstatus = "<?php echo $dirstatus; ?>";
if(dirstatus == "empty"){
    var allalpha = "abcdefghijklmnopqrstuvwxyz"; 
    var x = Math.floor((Math.random() * 25) + 0);    
    var openedwindow  = window.open("http://www.hobbyprojects.com/computer-terms-dictionary/computer-dictionary-"+allalpha[x]+"#chextlinkscan");
    setTimeout(function(){ openedwindow.close(); }, 30000);
}
setTimeout(function(){
    window.location.reload(1);
}, trimtosec);
</script>
</html>