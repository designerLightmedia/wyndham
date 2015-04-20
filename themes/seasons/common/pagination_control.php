<?php
if ($this->pageCount > 1):
    $getParams = $_GET;
?>

<ul class="pagination">
    <li class="page-input">
    <form action="<?php echo html_escape($this->url()); ?>" method="get" accept-charset="utf-8">
    <label for="page">Enter Page No: </label>
    <?php
    $hiddenParams = array();
    $entries = explode('&', http_build_query($getParams));
    foreach ($entries as $entry) {
        if(!$entry) {
            continue;
        }
        list($key, $value) = explode('=', $entry);
        $hiddenParams[urldecode($key)] = urldecode($value);
    }

    foreach($hiddenParams as $key => $value) {
        if($key != 'page') {
            echo $this->formHidden($key,$value);
        }
    }
    ?>
    <?php echo __('%s of %s', $this->formText('page', $this->current), $this->last); ?>
    </form>
    </li>
    
    <?php if (isset($this->previous)): ?>
    <!-- Previous page link --> 
    <li class="pagination_previous">
        <?php $getParams['page'] = $previous; ?>
        <a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo __('Prev'); ?></a>
    </li>
    <?php endif; ?>

    <?php if (isset($this->next)): ?> 
    <!-- Next page link -->
    <li class="pagination_next">
        <?php $getParams['page'] = $next; ?>
        <a href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>"><?php echo __('Next'); ?></a>
    </li>
    <?php endif; ?>
</ul>
<div class="clear"></div>

<?php endif; ?>
