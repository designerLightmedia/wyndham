<?php
if(isset($_POST['contribute_then_now_image'])) {
	 
	 //$db = get_db();
	 // the tables used in adding items
	 //$table_items =  $db->prefix.'items';
	 //$table_files =  $db->prefix.'files';
	 
	 // how the file names are made up
	 //$_FILES['contributed_file_1']['name'] = '1_thennow_'.$_FILES['contributed_file_1']['name'];
	 //$_FILES['contributed_file_2']['name'] = '2_thennow_'.$_FILES['contributed_file_2']['name'];
	 
	// put the file on the server if it is jpg, jpeg, JPG or JPEG
	// male all extensions 'jpg'
	function putFileOnServer($_FILES,$file_form_name,$folder,$rand_name) {
		
		$file_extension = 'jpg';
		$filename = $rand_name . '.' . $file_extension;
		if (move_uploaded_file($_FILES[$file_form_name]['tmp_name'], "$folder/$filename")) {
			  $m = 1;
		} else {
			  $m = 3;
		}
		return $m;
	}
	
	// returns true if it is jpg or jpeg format, false if not
	function getValidFileExtension($titlefile) { 
		// gets the file type e.g. .'jpg' from xyz.jpg
		$titlefile = explode('.',$titlefile);
		$bits = count($titlefile);
		$key = $bits - 1;
		$ext = strtolower($titlefile[$key]);
		if(strstr($ext,'jpg') || strstr($ext,'jpeg')) {
			return true;
		} else {
			return false;
		}
		return $titlefile[$key];
 	}
	
	// get information about the original file now on the server
	function getImageInformation($file) {
		// Returns an array with 7 elements. 0 = w, 1 = h
		list($width,$height,$image_type,$image_h_w_string,$_5,$_6,$_7) = getimagesize($file);
		// if $image_type == 2 it is a type IMAGETYPE_JPG and the mime_browser column in the files table in the omeka db will be 'image/jpeg'
		//echo $width.' '.$height.' '.$image_type.' '.$image_h_w_string.' '.$_5.' '.$_6.' '.$_7;
		return array($width,$height,$image_type,$image_h_w_string,$_5,$_6,$_7);
	}
	
	function getImageFileSize() {
	
	}
	
	// return random alpha/num ready for file use
	function randomAlphaNum($length) {
		
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}
	
	// take an image, if either width or height are over the $max_width, $max_height arguments then resize the ratio, then place image in destination folder 
	function resizeImageRatio($file_location,$max_width,$max_height,$image_info,$new_location,$file_name,$folder_type) {
			
			$filename = $file_location;

			// Set a maximum height and width
			$width = $max_width;
			$height = $max_height;

			// Content type
			header('Content-Type: image/jpeg');

			// Get new dimensions
			//list($width_orig, $height_orig) = getimagesize($filename);
			$width_orig = $image_info[0];
			$height_orig = $image_info[1];
			
			// if image dimensions are over our maximum arguments then resize accordingly
			// see original http://www.php.net/manual/en/function.imagecopyresampled.php
			if($image_info[0] > $max_width || $image_info[1] > $max_height) {
				
				$ratio_orig = $width_orig/$height_orig;

				if ($width/$height > $ratio_orig) {
				   $width = $height*$ratio_orig;
				} else {
				   $height = $width/$ratio_orig;
				}
			
				// Resample
				$image_p = imagecreatetruecolor($width, $height);
				$image = imagecreatefromjpeg($filename);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				// Output
				// bool imagejpeg ( resource $image [, string $filename [, int $quality ]] )
				// e.g.
				// imagejpeg($image_p, null, 100);
				$new_path = $new_location.$file_name;
				//echo $new_path;
				imagejpeg($image_p, $new_path, 100);
				imagedestroy($image);
				imagedestroy($image_p);
			
			// just copy to new location if the image is under limits
			} else {
				$new_path = $new_location.$file_name;
				copy($file_location, $new_path);
			}
	}
	
	// do the harder make a perfect square thumbnail
	function resizeImageSquare($file_location,$max_width,$max_height,$image_info,$new_location,$file_name,$folder_type) {

			$filename = $file_location;

			// Content type
			header('Content-Type: image/jpeg');

				// see http://return-true.com/2009/02/making-cropping-thumbnails-square-using-php-gd/
				$orig_w = $image_info[0];
				$orig_h = $image_info[1];
				$new_w = 200;
				$new_h = 200;
				$w_ratio = ($new_w / $orig_w);
				$h_ratio = ($new_h / $orig_h);
				
				if ($orig_w > $orig_h ) {//landscape
				    $crop_w = round($orig_w * $h_ratio);
				    $crop_h = $new_h;
				    $src_x = ceil( ( $orig_w - $orig_h ) / 2 );
				    $src_y = 0;
				} elseif ($orig_w < $orig_h ) {//portrait
			    $crop_h = round($orig_h * $w_ratio);
				    $crop_w = $new_w;
				    $src_x = 0;
					$src_y = ceil( ( $orig_h - $orig_w ) / 2 );
				} else {//square
				    $crop_w = $new_w;
				    $crop_h = $new_h;
				    $src_x = 0;
				    $src_y = 0;
				}
				$dest_img = imagecreatetruecolor($new_w,$new_h);
				$source_img = imagecreatefromjpeg($filename);
				imagecopyresampled($dest_img, $source_img, 0 , 0 , $src_x, $src_y, $crop_w, $crop_h, $orig_w, $orig_h);
				$new_path = $new_location.$file_name;
				imagejpeg($dest_img, $new_path, 100);
	    		imagedestroy($dest_img);
	    		imagedestroy($filename);
	
	}
	
	// insert into ITEMS first and return last id
	function queryInsertItem($item_type_id) {
		
		$db = get_db();
		$table_items = $db->prefix.'items';
		$sql = "INSERT INTO 
			{$table_items}
			SET 
			item_type_id = $item_type_id,
			modified = NOW(),
			added = NOW()
			";
		$db->query($sql);
		$id = $db->lastInsertId(); 
		return $id;
	}
	
	// insert into FILES table
	function queryInsertFile($item_id, $size_byte, $folder_path, $archive_filename, $original_name, $then_now_order) {
		
		$then_now_name = $then_now_order.'_thennow_'.$original_name;
		$auth = md5_file($folder_path);
		$mime_browser = 'image/jpeg';
		$mime_os = 'image/jpeg; charset=binary';
		$type_os = 'JPEG image data, JFIF standard 1.02';
		
		$db = get_db();
		$table_files = $db->prefix.'files';
		$sql = "INSERT INTO 
			{$table_files}
			SET 
			item_id = $item_id,
			size = '$size_byte',
			has_derivative_image = 1,
			authentication = '$auth',
			mime_browser = '$mime_browser',
			mime_os = '$mime_os',
			type_os = '$type_os',
			archive_filename = '$archive_filename',
			original_filename = '$then_now_name',
			modified = NOW(),
			added = NOW(),
			stored = 1
			";
		$db->query($sql);
	}
	
	function queryInsertElementTexts($item_id,$text) {
	
		// element_id is from 'elements' table as per item 41 eq 'Description'
		// record_type_id eq 2 for item type
		$db = get_db();
		$table_element_texts = $db->prefix.'element_texts';
		$sql = "INSERT INTO 
			{$table_element_texts}
			SET 
			record_id = $item_id,
			record_type_id = 2,
			element_id = 41,
			html = '',
			text = '$text'
			";
		$db->query($sql);  
	}
	
	function queryInsertEntitiesRelations($item_id,$type) { 
	
		// relationship_id comes from relationships table and is simply to do with added = 1 and modified = 2
		// so an item is added twice to this table the only difference being relationship_id
		$db = get_db();
		$table_entities_relations = $db->prefix.'entities_relations';
		$sql = "INSERT INTO 
			{$table_entities_relations}
			SET 
			entity_id = 1,
			relation_id = $item_id,
			relationship_id = 2,
			type = '$type',
			time = NOW()
			";
		$db->query($sql);

		$sql = "INSERT INTO 
			{$table_entities_relations}
			SET 
			entity_id = 1,
			relation_id = $item_id,
			relationship_id = 1,
			type = '$type',
			time = NOW()
			";
		$db->query($sql); 		
		
	}
	
	function queryInsertContributorProfile($profile_name,$profile_email) {
	
		$db = get_db();
		$table_contribution_contributors = $db->prefix.'contribution_contributors';
		$sql = "SELECT name, email
			FROM
			{$table_contribution_contributors}
			WHERE
			name = '$profile_name'
			AND
			email = '$profile_email'
			";
		$stmt = $db->query($sql);
		// fetch single row
		$match = NULL;
		while ($row = $stmt->fetch()) {
			$match = $row['name'];
		}
		if(!$match) {
		$sql = "INSERT INTO 
				{$table_contribution_contributors}
				SET 
				name = '$profile_name',
				email = '$profile_email'
				";
				$db->query($sql);
		}
	}
	
	function escapeText($string) {
	
		$db = get_db();
		// ----- remove HTML TAGs -----
		$string = preg_replace ('/<[^>]*>/', ' ', $string);
	   
		// ----- remove control characters -----
		$string = str_replace("\r", '', $string);    // --- replace with empty space
		$string = str_replace("\n", ' ', $string);   // --- replace with space
		$string = str_replace("\t", ' ', $string);   // --- replace with space
	   
		// ----- remove multiple spaces -----
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		// mysql_real_escape_string will not work in omeka so use addslashes to get data in if quotes in string
		$string = addslashes($string);
		return $string;
	}
	
	// check if the files are jpeg or jpeg
	$ext_ok_1 = false;
	$ext_ok_2 = false;
	$ext_ok_1 = getValidFileExtension($_FILES['contributed_file_1']['name']);
	$ext_ok_2 = getValidFileExtension($_FILES['contributed_file_2']['name']);
	// get some random extension of 32 char
	$r_1 = randomAlphaNum($length = 32);
	$r_2 = randomAlphaNum($length = 32);
	// if the files are both jpeg or jpg move them over
	if($ext_ok_1 == true && $ext_ok_2 == true) {
		// upload to files folder first in original size in the encoded name and make extension 'jpg'
		$m_1 = putFileOnServer($_FILES, 'contributed_file_1', $folder = 'archive/files', $r_1);
		$m_2 = putFileOnServer($_FILES, 'contributed_file_2', $folder = 'archive/files', $r_2);
		// now the images are in 'archive/files' we can make the other 3 versions
		if($m_1 == 1 && $m_2 == 1) {
			$file_name_1 = $r_1.'.jpg';
			$file_name_2 = $r_2.'.jpg';
			$file_original_1 = 'archive/files/'.$r_1.'.jpg';
			$file_original_2 = 'archive/files/'.$r_2.'.jpg';
			$image_info_1 = getImageInformation($file = $file_original_1);
			$image_info_2 = getImageInformation($file = $file_original_2);
			resizeImageRatio($file_original_1,$width = 800,$height = 800,$image_info_1,'archive/fullsize/',$file_name_1,'fullsize');
			resizeImageRatio($file_original_2,$width = 800,$height = 800,$image_info_2,'archive/fullsize/',$file_name_2,'fullsize');
			resizeImageRatio($file_original_1,$width = 200,$height = 200,$image_info_1,'archive/thumbnails/',$file_name_1,'thumbnails');
			resizeImageRatio($file_original_2,$width = 200,$height = 200,$image_info_2,'archive/thumbnails/',$file_name_2,'thumbnails');
			resizeImageSquare($file_original_1,$width = 200,$height = 200,$image_info_1,'archive/square_thumbnails/',$file_name_1,'square_thumbnails');
			resizeImageSquare($file_original_2,$width = 200,$height = 200,$image_info_2,'archive/square_thumbnails/',$file_name_2,'square_thumbnails');
			// now call omeka items insert
			$item_id = queryInsertItem($item_type_id = 6);
			// file insert
			queryInsertFile($item_id, $size = $_FILES['contributed_file_1']['size'], $file_original_1, $file_name_1, $name = $_FILES['contributed_file_1']['name'], 1);
			queryInsertFile($item_id, $size = $_FILES['contributed_file_2']['size'], $file_original_2, $file_name_2, $name = $_FILES['contributed_file_2']['name'], 2);
			// element texts single item entry
			echo $_POST['description'];
			$text = escapeText($_POST['description']);
			queryInsertElementTexts($item_id, $text);
			// relations
			queryInsertEntitiesRelations($item_id, $type = 'Item');
			// contributor details
			$profile_name = escapeText($_POST['contributor_then_now_name']);
			$profile_email = escapeText($_POST['contributor_then_now_email']);
			queryInsertContributorProfile($profile_name,$profile_email);
		}
	}
	
}
?>
<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Contribution
 */

$head = array('title' => 'Contribute Then & Now Images',
              'bodyclass' => 'contribution');
head($head); ?>
<?php echo js('contribution-public-form'); ?>
<script type="text/javascript">
// <![CDATA[
enableContributionAjaxForm(<?php echo js_escape(uri('then-now-image/type-form')); ?>);
// ]]>
</script>

<div id="primary">
<?php echo flash(); ?>
    
    <h1><?php echo $head['title']; ?></h1>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <fieldset>
			<label>Upload Image 1</label><input type="file" name="contributed_file_1" id="contributed_file_1" />
			<label>Upload Image 2</label><input type="file" name="contributed_file_2" id="contributed_file_2" />
		</fieldset>
		
		<fieldset>
			<label>Description</label><input type="textarea" name="description" style="width: 300px; height: 240px; display: block; vertical-align: top" />
		</fieldset>
		
		<fieldset>
			<label>Name</label><input type="text" name="contributor_then_now_name" style="display: block" />
			<label>Email</label><input type="text" name="contributor_then_now_email" style="display: block" />
		</fieldset>
		
		<fieldset id="contribution-confirm-submit" style="display: block;">
            <div id="captcha" class="inputs"></div>
            <div class="inputs">
                <input type="hidden" name="contribution-public" value="0"><input type="checkbox" name="contribution-public" id="contribution-public" value="1">                <label for="contribution-public">Publish my contribution on the web.</label>            </div>
            <p>In order to contribute, you must read and agree to the <a href="/omekawyn/contribution/terms" target="_blank">Terms and Conditions.</a></p>
            <div class="inputs">
                <input type="hidden" name="terms-agree" value="0"><input type="checkbox" name="terms-agree" id="terms-agree" value="1">                <label for="terms-agree">I agree to the Terms and Conditions.</label>            </div>
                   
		</fieldset>
		
		<fieldset>
			<input type="submit" name="contribute_then_now_image" value="SUBMIT" style="display: block" />
		</fieldset>
    </form>
</div>
<?php foot();
