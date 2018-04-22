<?php
		$dirsize = sizeof(scandir("../allketuploads"));
        $dirstatus = "notempty";
        if($dirsize<7){
            $dirstatus = "empty";
        }
        echo $dirstatus;
?>