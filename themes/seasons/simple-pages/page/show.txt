<?php echo head(array(
    'title' => metadata('simple_pages_page', 'title'),
    'bodyclass' => 'page simple-page '. metadata('simple_pages_page', 'slug') .'',
    'bodyid' => metadata('simple_pages_page', 'slug')
)); ?>

<div class="section section--default">

    <div class="section section--brown">
            <div class="l-wrap">
                <div class="site-title t-left">
                    <h1><?php echo metadata('simple_pages_page', 'title'); ?></h1>
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
            
            
            <?php
            $text = metadata('simple_pages_page', 'text', array('no_escape' => true));
            if (metadata('simple_pages_page', 'use_tiny_mce')) {
                echo $text;
            } else {
                echo eval('?>' . $text);
            }
            ?>
        </div>

    </div>

</div>


<div class="section section--tell-your-stories">

    <div class="section section--brown">
            <div class="l-wrap">
                <div class="l-columns-5">
                    <div class="l-flex-embed l-flex-embed--4by2">
                        <iframe src="http://player.vimeo.com/video/11814525" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
                <div class="l-columns-7 omega">
                    <h1><?php echo metadata('simple_pages_page', 'title'); ?></h1>
                    <div class="formatted">
                        <?php
                            $text = metadata('simple_pages_page', 'text', array('no_escape' => true));
                            if (metadata('simple_pages_page', 'use_tiny_mce')) {
                                echo $text;
                            } else {
                                echo eval('?>' . $text);
                            }
                        ?>
                    </div>
                </div>
            </div>
    </div>

    <div class="l-wrap">

        <div id="primary">
            
            <div class="l-fields-horizontal l-fields-horizontal--large">
                <fieldset>
                <div class="field">
                    <label for="">Title of Contribution (optional): </label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>

                <div class="field">
                    <label for="message">What kind of contribution will you be making?: </label>
                    <select name="" id="">
                        <option value="">story</option>
                        <option value="">story 2</option>
                        <option value="">story 3</option>
                        <option value="">story 4</option>
                    </select>
                </div>
                
                <div class="field">
                    <label for="message">Your Story: </label>
                    <textarea name="message" id="message" class="textinput" rows="10" cols="80"></textarea>        
                </div>

                <div class="field">
                    <label for="">In addition to saving your contribution to the archive, may we post it on this site?: </label>
                    <select name="" id="">
                        <option value="">Yes, including my name</option>
                        <option value="">story 2</option>
                        <option value="">story 3</option>
                        <option value="">story 4</option>
                    </select> 
                </div>

                
                <div class="field">
                    <label for="">First Name:</label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>

                <div class="field">
                    <label for="">Last Name:</label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>

                <div class="field">
                    <label for="">Email Name:</label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>

                <div class="field">
                    <label for="">Did you create it?</label>
                    <div class="field_group">
                        <label class="input-inline label-inline--after" for=""><input type="radio">Yes</label>                         
                        <label class="input-inline label-inline--after" for=""><input type="radio">Yes</label>                         
                    </div>     
                </div>

                <div class="field">
                    <label for="">If not, please provide the name of the creator:</label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>
                <div class="field">
                    <label for="">Keywords (separated by comma):</label>
                    <input type="text" name="name" id="name" value="" class="textinput">       
                </div>

                </fieldset>
                <fieldset>
                    <legend class="t4">Optional Information</legend>

                    <div class="field">
                        <label for="">Gender:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>
                    <div class="field">
                        <label for="">Race:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>
                    
                    <div class="field">
                        <label for="">Occupation:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>
                    
                    <div class="field">
                        <label for="">Birth Year:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>
                    <div class="field">
                        <label for="">Zipcode:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>
                    <div class="field">
                        <label for="">Anti Spam:</label>
                        <input type="text" name="name" id="name" value="" class="textinput">       
                    </div>

                </fieldset>

                <div class="field field--actions">
                    <button class="button button--blue">Submit</button>
                </div>

            </div>     

        </div>

    </div>

</div>






<?php echo foot(); ?>