<?php

$js = "
var guestUserPasswordAgainText = '" . __('Password again for match') . "'; 
var guestUserPasswordsMatchText = '" . __('Passwords match!') . "'; 
var guestUserPasswordsNoMatchText = '" . __("Passwords do not match!") . "'; ";

queue_js_string($js);
queue_js_file('guest-user-password');
queue_css_file('skeleton');
// $css = "form > div { clear: both; padding-top: 10px;} .two.columns {width: 30%;}";
// queue_css_string($css);
$pageTitle = __('Update Account');
echo head(array('bodyclass' => 'update-account', 'title' => $pageTitle));
?>

<div class="section section--brown">
	<div class="l-wrap">
		<h1><?php echo $pageTitle; ?></h1>
		<?php echo flash(); ?>
	</div>
</div>
<div id='primary'>
	<div class="l-wrap">
			
			
			<div class="element-set">
				<div class="element-set_body">
					<div class="form--control">
						<?php echo $this->form; ?>
					</div>
				</div>
			</div>
	</div>
</div>
<?php echo foot(); ?>