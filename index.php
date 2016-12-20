<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', -1);

require 'facebook-php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '',
  'secret' => '',
));

if($facebook->getUser()) {
  $logoutUrl = $facebook->getLogoutUrl();
  echo '<a href="'.$logoutUrl.'">Logout</a><hr>';
} else {
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'user_managed_groups, read_page_mailboxes, manage_notifications, ads_management, ads_read, email, manage_pages, publish_actions, read_friendlists, read_insights, read_mailbox, read_stream, rsvp_event, user_posts, publish_pages, read_custom_friendlists, public_profile'));
  echo '<a href="'.$loginUrl.'">Login</a>'; exit;
}

$facebook->setExtendedAccessToken();

$pages = $facebook->api('me/accounts');
foreach($pages['data'] as $page) {
  echo '<strong>'.$page['name'].'</strong>';
  echo '<div style="word-wrap: break-word; border-bottom: 1px solid #DDD">'.$page['access_token'].'</div>';
}