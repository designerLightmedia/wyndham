<?php
require_once HELPERS; 
require 'tmhOAuth/tmhOAuth.php';

/******************************************************************
*	Plugin Name: Tweetster 
*	Plugin Author: Cory Bohon 
* 	Plugin Version: 1.0
* 	URL: http://corybohon.com
* 	License: GPL2 w/ Attribution requested
******************************************************************/

// add plugin hooks
add_plugin_hook('config', 'tweetster_config');
add_plugin_hook('config_form', 'tweetster_config_form');
add_plugin_hook('make_item_public', 'tweetster_do_tweet');
add_plugin_hook('uninstall', 'tweetster_uninstall');
 
// save plugin options -- add the options
function tweetster_config()
{
    // save the message as a plugin option
    set_option('tweetster_consumer_key', trim($_POST['tweetster_consumer_key']));
	set_option('tweetster_consumer_secret', trim($_POST['tweetster_consumer_secret']));
	set_option('tweetster_user_token', trim($_POST['tweetster_user_token']));
	set_option('tweetster_token_secret', trim($_POST['tweetster_token_secret']));
	set_option('tweetster_bitly_login', trim($_POST['tweetster_bitly_login']));
	set_option('tweetster_bitly_apikey', trim($_POST['tweetster_bitly_apikey']));
}

// uninstall the plugin -- remove all options 
function tweetster_uninstall()
{
	delete_option('tweetster_consumer_key');
	delete_option('tweetster_consumer_secret');
	delete_option('tweetster_user_token');
	delete_option('tweetster_token_secret');
	delete_option('tweetster_bitly_login');
	delete_option('tweetster_bitly_apikey');
}


// show plugin configuration page
function tweetster_config_form()
{
    // create a form inputs to collect the user's message
	echo '<h3>Enter your Twitter information below to have Tweetster automatically tweet each newly published item in Omeka. For more information on configuring this plugin, please refer to <a href="http://corybohon.com/tweetster/">the documentation</a>.</h3><br /><br />';
    echo '<div class="field">Twitter Consumer Key:<div class="inputs">';             
    echo text(array('name'=>'tweetster_consumer_key'), get_option('tweetster_consumer_key'), null);
	echo '</div></div>';
	echo '<div class="field">Twitter Consumer Secret Key:<div class="inputs">';
	echo text(array('name'=>'tweetster_consumer_secret'), get_option('tweetster_consumer_secret'), null);
	echo '</div></div>';
	echo '<div class="field">Access Token (oauth_token):<div class="inputs">';             
    echo text(array('name'=>'tweetster_user_token'), get_option('tweetster_user_token'), null);
    echo '</div></div>';
    echo '<div class="field">Access Token Secret (oauth_token_secret):<div class="inputs">';             
    echo text(array('name'=>'tweetster_token_secret'), get_option('tweetster_token_secret'), null);
    echo '</div></div>';
	echo '<br /> <br /> <h3>Enter Your Bit.ly Information to have the links automatically shortened before tweeting. After signing into your Bit.ly account, go to <a href="http://bit.ly/a/your_api_key">this page</a> to get your Bit.ly API information to fill in below.</h3><br />';
	echo '<div class="field">Bit.ly Username:<div class="inputs">';
	echo text(array('name'=>'tweetster_bitly_login'), get_option('tweetster_bitly_login'), null);
	echo '</div></div>';
	echo '<div class="field">Bit.ly API Key:<div class="inputs">';
	echo text(array('name'=>'tweetster_bitly_apikey'), get_option('tweetster_bitly_apikey'), null);
	echo '</div></div>';
}

// automatically tweet out the newly published item
function tweetster_do_tweet($item)  
{     
	set_current_item($item);
	$post_title = item('Dublin Core', 'Title');
	$post_title .= ' -';
	
	$url = WEB_ROOT . "/items/show/" . $item->id;
	$short_url = shorten_url($url);
	
	//check to make sure the tweet is within the 140 char limit
	//if not, shorten and place ellipsis and leave room for link. 
	if (strlen($post_title) + strlen($short_url) > 125)
	{
	   $total_len = strlen($post_title) + strlen($short_url);
	   $over_flow_count = $total_len - 125;
	   $post_title = substr($post_title,0,strlen($post_title) - $over_flow_count - 3);
	   $post_title .= '...';		
	}
	
	//add in the shortened bit.ly link
	$message = $post_title . " " . $short_url;

	//call the tweet function to tweet out the message
	tweet($message);
}

function tweet($msg)
{
	/*
	PRE-OAUTH TWITTER FUNCTION
	
	$username = get_option('tweetster_username');
	$password = get_option('tweetster_password');
	
	$url = 'http://twitter.com/statuses/update.xml';	
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_URL, "$url");
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_POST, 1);	
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$msg");
	
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
	
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	*/
	
	$tmhOAuth = new tmhOAuth(array(
	  'consumer_key'    => get_option('tweetster_consumer_key'),
	  'consumer_secret' => get_option('tweetster_consumer_secret'),
	  'user_token'      => get_option('tweetster_user_token'),
	  'user_secret'     => get_option('tweetster_token_secret'),
	));
	
	$tmhOAuth->request('POST', $tmhOAuth->url('statuses/update'), array(
	//'status' => utf8_encode($ message)
	  'status' => $msg //changed this nlarion
	));
	
	//DEBUG 
	//if ($tmhOAuth->response['code'] == 200) {
	//  $tmhOAuth->pr(json_decode($tmhOAuth->response['response']));
	//} else {
	//  $tmhOAuth->pr(htmlentities($tmhOAuth->response['response']));
	//}
}

function shorten_url($url)
{
	$login = get_option('tweetster_bitly_login'); 
	$appkey = get_option('tweetster_bitly_apikey');
	$format = "txt";
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
	
	return file_get_contents($connectURL);
}

?>