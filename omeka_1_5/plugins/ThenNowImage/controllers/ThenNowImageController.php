<?php
/**
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Center for History and New Media, 2010
 * @package Then Now Image Contribution
 */
 
/**
 * Controller for contributions themselves.
 */
class ThenNowImage_ThenNowImageController extends Omeka_Controller_Action
{   
    protected $_captcha;
    
    /**
     * Index action; simply forwards to contributeAction.
     */
    public function indexAction()
    {
        $this->_forward('contribute');
    }
    
    /**
     * Action for main contribution form. This relates directly to the file name in views/public/contribute-then-now-image.php
     */
    public function contributeThenNowImageAction()
    {
       
	}
    
    /**
     * Action for AJAX request from contribute form.
     */
    public function typeFormAction()
    {
       
    }
    
    /**
     * Displays terms of service for contribution.
     */
    public function termsAction()
    {
    }
    
    /**
     * Displays a "Thank You" message to users who have contributed an item 
     * through the public form.
     */
    public function thankyouAction()
    {
    }
    
    /**
     * Common tasks whenever displaying submit form for contribution.
     *
     * @param int $typeId ContributionType id
     */
    public function _setupContributeSubmit($typeId)
    {
        
    }
    
    /**
     * Creates the reCAPTCHA object and returns it.
     * 
     * @return Zend_Captcha_Recaptcha|null
     */
    protected function _setupCaptcha()
    {
        return Omeka_Captcha::getCaptcha();
    }
    
   
    
	
}
