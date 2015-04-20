<?php
queue_js_file('guest-user-password');
queue_css_file('skeleton');
// $css = "form > div { clear: both; padding-top: 10px;} .two.columns {width: 30%;} ";
// queue_css_string($css);
$pageTitle = get_option('guest_user_register_text') ? get_option('guest_user_register_text') : __('Register');
echo head(array('bodyclass' => 'register', 'title' => $pageTitle));
?>
	<div class="section section--brown">
		<div class="l-wrap">
			<h1><?php echo $pageTitle; ?></h1>
		</div>
	</div>

	<div id='primary'>
		<div class="l-wrap">
			<div id='capabilities'>
			<p>
			<?php echo get_option('guest_user_capabilities'); ?>
			</p>
		</div>
		
		<?php echo flash(); ?>
		<div class="element-set">
			<div class="element-set_body">
				<div class="form--control">
					<?php echo $this->form; ?>
				</div>
		<p id='confirm'></p>
			</div>
		</div>
		</div>
	</div>
<?php echo foot(); ?>
