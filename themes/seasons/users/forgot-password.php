<?php
$pageTitle = __('Forgot Password');
echo head(array('title' => $pageTitle, 'bodyclass' => 'login'), $header);
?>
<div class="section section--brown">
	<div class="l-wrap">
		<h1><?php echo $pageTitle; ?></h1>

		<p id="login-links">
		<span id="backtologin"><?php echo link_to('users', 'login', __('Back to Log In')); ?></span>
		</p>

		<?php echo flash(); ?>
	</div>
</div>

<div class="l-wrap">
	<div class="element-set mt-2em">
		<div class="element-set_body">
			<form method="post" accept-charset="utf-8" class="form--control">
			<p class="clear"><?php echo __('Enter your email address to retrieve your password.'); ?></p>
		    <div class="field">        
		        <label for="email"><?php echo __('Email'); ?></label>
		        <?php echo $this->formText('email', @$_POST['email']); ?>
		    </div>

		    <input type="submit" class="submit" value="<?php echo __('Submit'); ?>" />
		</form>
		</div>
	</div>
</div>
<?php echo foot(array(), $footer); ?>
