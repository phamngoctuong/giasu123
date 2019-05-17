<?php
//This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser. This helps prevent poorly written scripts from tying up the server. The default setting is 30. When running PHP from the command line the default setting is 0.
ini_set('max_execution_time', 0);

//Initial settings, Just specify Source and Destination Image folder.
//$ImageFolder = 'upload/'; //Source Image Directory End with Slash
$MoveImgeToHere = 'pictures/news/2018/'; //Destination Image Directory End with Slash

//Open Source Image directory, loop through each Image and resize it.

//$filelist = glob("upload/*", GLOB_ONLYDIR);
/*
foreach ($filelist as $dir) {	
	opz($dir.'/');
	$dir_sub = end(explode('/', $dir));		
	$list = glob("upload/".$dir_sub."/*", GLOB_ONLYDIR);
	if(count($list)>0){
		opz($list.'/');
	}
}
*/
//opz('upload/');
//opz('upload/news/');
//opz('upload/news/resized/');
function opz($ImageFolder){
	
	if($dir = opendir($ImageFolder)){
	while(($file = readdir($dir))!== false){

	$imagePath = $ImageFolder.$file;
	
	$checkValidImage = @getimagesize($imagePath);
	$type = strtolower(substr(strrchr($imagePath,"."),1));

	if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
	{
	    $type = strtolower($type);
	    if($type=='png'){
	        exec('optipng '.$imagePath);          
	    }
	    if($type=='jpg' or $type=='jpeg'){          
	        exec('jpegoptim '.$imagePath);
	    }

	}
	//var_dump($file);die;
	}
	closedir($dir);
	}
	
}

opz("/upload/donxinviec/");

echo "done";
?>