<? 
function listFolderFiles($dir){
    $ffs = scandir($dir);
    echo '<ul>';
    foreach($ffs as $ff)
	{
		$path = $dir .'/'.$ff;
		if($ff != '.' && $ff != '..')
		{
            if(!is_dir($path))
			{
				echo '<li><b>'.$ff.'</b>';   
			}
            else
			{
				$info = stat($path);
				$permissions = $info['mode'];
				echo '<li>'.decoct($permissions) .' - '. $ff;
			}


            if(is_dir($path)) { 
				listFolderFiles($path);
				echo '</li>';
            }
		}
    }
    echo '</ul>';
} 


$dir = getcwd()."/upc/images";
listFolderFiles($dir, array());




?>
