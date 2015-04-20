<div>
<form method="GET" name="frmsearch" onsumit="return checkval(); return false;">
	<ul style="list-style-type:none">
		<li>Select type of searching: <input type="radio" name="type" value="file" <?=$_GET['type']=='file' ? 'CHECKED':''?>>&nbsp;Filename 
			&nbsp;&nbsp;&nbsp;<input type="radio" name="type" value="content" <?=$_GET['type']=='content' ? 'CHECKED':''?>>&nbsp;Content
		</li>
		<li><input type="text" name="keyword" value="<?=$_REQUEST['keyword']?>"></li>
		<li><input type="submit" name="btnsubmit" value=" GO "></li>
	</ul>
	<script>
		function checkval(){
			if(document.getElementsByName('keyword').value==""){
				alert('Please input keyword to search!');
				return false;
			}
			document.frmsearch.submit();
			return true;
		}
		function verify(){
			var msg = confirm('Are you sure want to remove this filename?');
			if(!msg){
				return false;
				
			} 
			document.frmsearch.submit();
			return true;
		}
	</script>
</form>	

</div>

<?php


if($_GET){
	$search_type = $_GET['type'];
	$keyword = $_GET['keyword'];
	
	echo "Searching for <b>\"$keyword\"</b> in <b>\"".$search_type."\"</b></br>";

	//define the path as relative
	$path = ".";
	$webpath ="http://www.jessej.net/emw/";

	//using the opendir function
	$dir_handle = @opendir($path) or die("Unable to open $path");

	echo "Directory Listing of $path<br/>";

	list_dir($dir_handle,$path,$keyword,$search_type);
}

function findLine($filename, $str){
	$getfile = file($filename);
	$getfile = array_map('trim', $getfile);
	$find = array_search($str, $getfile);
	return $find === false ? false:$find + 1;
}
	

function list_dir($dir_handle,$path,$keyword,$search_type)
{
    // print_r ($dir_handle);
    echo "<ol>";
    
    //running the while loop
	  

    while (false !== ($file = readdir($dir_handle))) {
		$delimeter = "\n";
        $dir =$path.'/'.$file;
        if(is_dir($dir) && $file != '.' && $file !='..' )
        {
            $handle = @opendir($dir) or die("undable to open file $file");
            list_dir($handle, $dir, $keyword,$search_type);
        }elseif($file != '.' && $file !='..')
        {
			if($search_type=='file'){
				if(strcmp("$file", "$keyword")==0){
			
					echo "<li><a href='$webpath.$dir'>$webpath.$dir</a>&nbsp;&nbsp;";
					echo "<input type=\"button\" value=\"Remove\" onClick=\"verify();\"></li>";
					//unlink($webpath.$dir);
					$search_result = 1;
				}
				else{
					$search_result = 0;
				}
			}
			else {	
			
				$handle = @fopen($dir, "r"); 
				
				
				if ($handle) { 
				   while (!feof($handle)) {
						if($search_type=="content"){
							$content = fgets($handle); 
							if($res = stristr($content, $keyword)){	
								//$get_read = file($webpath.$dir);
								//$explode = explode("\n",$get_read);
								//$buffer = stream_get_line( $handle, 1024, $delimiter );
								//echo $buffer;
								echo "<li><a href='$webpath.$dir'>$webpath.$dir</a></li>";
								
								echo str_replace($keyword,"<b>$keyword</b>",$content).'</b>' ;
								
								$search_result = 1;
							} else {
								$search_result = 0;
							}
						}					
				   } 
				   fclose($handle); 
				} 
			}
		
			
			//if(strcmp("$file", "$filename_pattern")==0){
				
			//} else {
				//echo "false strcmp";
			//}
        }
    }
	
	echo "</ol>";
	
    closedir($dir_handle); 
	return $search_result;
}
?>
