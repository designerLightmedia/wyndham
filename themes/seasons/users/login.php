<?php
queue_js_file('login');
$pageTitle = __('Log In');
echo head(array('bodyclass' => 'login', 'title' => $pageTitle), $header);
?>
<div class="section section--brown">
	<div class="l-wrap">
			<h1><?php echo $pageTitle; ?></h1>

			<p id="login-links">
			<span id="backtosite"><?php echo link_to_home_page(__('Go to Home Page')); ?></span>  |  <span id="forgotpassword"><?php echo link_to('users', 'forgot-password', __('Lost your password?')); ?></span>
			</p>

        <?php echo flash(); ?>
	</div>

</div>

    
<div class="l-wrap">
	<div class="element-set">
		<div class="element-set_body">
			<div class="form--control">
				<?php echo $this->form->setAction($this->url('users/login')); ?>
			</div>
		</div>
	</div>
</div>

<?php echo foot(array(), $footer); ?>