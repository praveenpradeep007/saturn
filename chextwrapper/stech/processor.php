<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php include('phpdatabases/connect-db.php'); ?>
<?php $msgback = "..."; ?>

<?php
$folderpath = '../../allsites/';//slash should be present at the end ..
if(isset($_POST['phpsetdata'])){
	$tolowerpsrc = strtolower(mysqli_real_escape_string($conn, $_POST['phpsetdata']));

	if(strpos($tolowerpsrc, "project")!==false){
		$foldername = array_pop(explode(' ', $tolowerpsrc));
		if(!file_exists($folderpath.$foldername.'')){
			createfolder($foldername,$folderpath);
			createfolder('img',$folderpath.$foldername.'/');
			createfolder('css',$folderpath.$foldername.'/');
			createfolder('js',$folderpath.$foldername.'/');
			createfile("index.php",$folderpath.$foldername.'/');
			createfile("styles.css",$folderpath.$foldername.'/css/');
			createfile("scripts.js",$folderpath.$foldername.'/js/');
			copysourcecode("http://www.bstemplates.co.nf/bootstrapcdn.txt",$folderpath.$foldername.'/index.php',$foldername);
			$msgback = "project $foldername created ...";
		}
		else{
			$msgback = "folder $foldername already exists...";
		}	
	}
	else if(strpos($tolowerpsrc, "images")!==false && strpos($tolowerpsrc, "add")!==false){
    	$imagename = explode(' ',trim($tolowerpsrc))[1];
    	$indirname = array_pop(explode(' ', $tolowerpsrc));
    	$msgback = "https://www.pixabay.com/en/photos/".$imagename."?infol=".$indirname."#chextmesscan";
	}
	else if(strpos($tolowerpsrc, "file")!==false && strpos($tolowerpsrc, "add")!==false){
    	$newfilename = explode(' ',trim($tolowerpsrc))[1];
    	$indirname = array_pop(explode(' ', $tolowerpsrc));
    	createfile($newfilename,$folderpath.$indirname.'/');
    	$msgback = "file $newfilename been added";
	}
	else if(strpos($tolowerpsrc, "zip")!==false){
		$zipfoldername = array_pop(explode(' ', $tolowerpsrc));
		addtozipfile($folderpath.$zipfoldername);
		$msgback = "It's been zipped";
	}
}
else if(isset($_POST['phpsetimagedatapix']) && isset($_POST['phpsetimagepath'])){
	$dataArr=json_decode($_POST['phpsetimagedatapix']);
	$phpimgname=$_POST['phpimgname'];
	$my_save_dir = $folderpath.$_POST['phpsetimagepath'].'/img/';
	for($k=0;$k<sizeof($dataArr)-1;$k++){
		$url_to_image = $dataArr[$k];
		$extname = explode('.',trim(basename($url_to_image)))[1];
		$complete_save_loc = $my_save_dir ."image-".$phpimgname.$k.'.'.$extname;
		file_put_contents($complete_save_loc, file_get_contents($url_to_image)); 
	}
}
?>

<?php
function createfolder($foldername,$folderpath){   
    	mkdir($folderpath.$foldername.'', 0777, true);
}
function createfile($filename,$filepath){
		$handle = fopen($filepath.$filename, 'w') or die('Cannot open file:  '.$filename);
}
function copysourcecode($fromfilepath,$tofilepath,$foldername){
		$data = file_get_contents($fromfilepath);
		$data = str_replace("@chexttitle012",$foldername,$data);
		$tohandle = fopen($tofilepath, 'a') or die('Cannot open file:  '.$tofilepath);
		fwrite($tohandle, $data);
}
function addtozipfile($zipfolderpath){
	//Amir Md Amiruzzaman(https://stackoverflow.com/questions/4914750/how-to-zip-a-whole-folder-using-php)
	class FlxZipArchive extends ZipArchive{
 		public function addDir($location, $name){
			$this->addEmptyDir($name);
			$this->addDirDo($location, $name);
 		} 
 		private function addDirDo($location, $name){
    		$name .= '/';
			$location .= '/';
    		$dir = opendir ($location);
    		while ($file = readdir($dir)){
    	    	if ($file == '.' || $file == '..') continue;
    	    		$do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
    	    		$this->$do($location . $file, $name . $file);
    		}
 		} 
	}
	$the_folder = $zipfolderpath.'/';
	$zip_file_name = $zipfolderpath.'.zip';
	$za = new FlxZipArchive;
	$res = $za->open($zip_file_name, ZipArchive::CREATE);
	if($res === TRUE){
    	$za->addDir($the_folder, basename($the_folder));
    	$za->close();
	}
}
?>

<?php echo $msgback; ?>   
