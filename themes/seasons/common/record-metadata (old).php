<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <h2 class="element-set_title"><?php echo html_escape(__($setName)); ?></h2>
    <div class="element-set_body">
	    <?php foreach ($setElements as $elementName => $elementInfo): ?>
	    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
	    	<table border="0">
				<tr>
					<td><span class="element-title"><?php echo html_escape(__($elementName)); ?>: </span></td>
					<td>
						<?php foreach ($elementInfo['texts'] as $text): ?>
		            		<span class="element-text"><?php echo $text; ?></span>
		        		<?php endforeach; ?>
		        	</td>
				</tr>
	        </table>
	    </div><!-- end element -->
	    <?php endforeach; ?>
    </div>
</div><!-- end element-set -->
<?php endforeach;
