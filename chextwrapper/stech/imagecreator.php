<?php
include('phpdatabases/connect-db.php');
date_default_timezone_set("Asia/Kolkata");
?>
<?php
$poststatusinfo = "SELECT facthead,facts FROM fbketfacts WHERE status='undone' LIMIT 1";
$poststatusinforesult = $conn->query($poststatusinfo);
if($poststatusinforesult->num_rows > 0){
      $poststatusinforow = $poststatusinforesult->fetch_assoc();
      $phppostsrc = $poststatusinforow['facts'];
      $phpfacthead = $poststatusinforow['facthead']." :";
      $newtext = wordwrap($phppostsrc, 40, "\n");
      $newtextsize = calculatefontsize($newtext);
      header('Content-type: image/jpeg');
      $jpg_image = imagecreatefromjpeg('ketfiles/navyblue.jpg');
      $white = imagecolorallocate($jpg_image, 255, 255, 255);
      $font_path = 'ketfiles/caviar.ttf';
      imagettftext($jpg_image, 26, 0, 75, 200, $white, $font_path, $phpfacthead);
      imagettftext($jpg_image, $newtextsize, 0, 75, 300, $white, $font_path, $newtext);
      imagejpeg($jpg_image);
      imagedestroy($jpg_image);
}
function calculatefontsize($newtext){
      $strlength = strlen($newtext);
      if($strlength > 400){
            return 15;
      }
      else{
            return 25;
      }
}
?> 
<?php include('phpdatabases/close-connect-db.php'); ?>