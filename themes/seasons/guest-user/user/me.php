<?php
$user = current_user();
$pageTitle =  get_option('guest_user_dashboard_label');
echo head(array('title' => $pageTitle));
?>

<div class="section section--brown">
	<div class="l-wrap">
		<h1><?php echo $pageTitle; ?></h1>
		<?php echo flash(); ?>
	</div>
</div>

<div class="primary">
	<div class="l-wrap">
		<div class="element-set element-box panel-my-account">
			<div class="element-set_body">
				<?php foreach($widgets as $index=>$widget): ?>
				<div class='guest-user-widget <?php if($index & 1): ?>guest-user-widget-odd <?php else:?>guest-user-widget-even<?php endif;?>'>
				<?php echo GuestUserPlugin::guestUserWidget($widget); ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php echo foot(); ?>
