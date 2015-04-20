<?php echo head();  ?>
<div class="section section--default">

    <div class="section section--brown">
            <div class="l-wrap">
                <div class="site-title t-left">
				    <h1><?php echo html_escape(get_option('simple_contact_form_contact_page_title')); ?></h1>
                    <span class="title-desc"><p id="simple-pages-breadcrumbs"><?php echo simple_pages_display_breadcrumbs(); ?></p></span>
                </div>
                <div class="t-right">
                    <div class="search search--spread">
                       <?php echo search_form(array('show_advanced' => true)); ?>               
                    </div>
                </div>
            </div>
    </div>
    <div class="l-wrap">

        <div id="primary">
            
            <div id="simple-contact">
                <div id="form-instructions">
                    <?php echo get_option('simple_contact_form_contact_page_instructions'); // HTML ?>
                </div>
                <?php echo flash(); ?>
                <div class="element-set">
                    <div class="element-set_body">
                        <form name="contact_form" id="contact-form"  method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form--control">
                        
                        <fieldset>
                            
                        <div class="field">
                        <?php 
                            echo $this->formLabel('name', 'Your Name: ');
                            echo $this->formText('name', $name, array('class'=>'textinput')); ?>
                        </div>
                        
                        <div class="field">
                            <?php 
                                    echo $this->formLabel('email', 'Your Email: ');
                            echo $this->formText('email', $email, array('class'=>'textinput'));  ?>
                        </div>
                        
                        <div class="field">
                          <?php 
                            echo $this->formLabel('message', 'Your Message: ');
                            echo $this->formTextarea('message', $message, array('class'=>'textinput', 'rows' => '10')); ?>
                        </div>    
                        
                        </fieldset>
                
                        <fieldset>
                        <?php if ($captcha): ?>
                        <div class="field">
                            <?php echo $captcha; ?>
                        </div>
                        <?php endif; ?>
                
                        <div class="field">
                          <?php echo $this->formSubmit('send', 'Send Message'); ?>
                        </div>
                        
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        
        </div>
	</div>
</div>            
    
<?php echo foot();
