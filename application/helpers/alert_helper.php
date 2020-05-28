<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
function setAlertCookie($status,$message){
  $alert_status_cookie = array('name' => 'alert_status',
    'value' => $status,
    'expire' => '20'
  );
  $alert_message_cookie = array('name' => 'alert_message',
  'value' => $message,
  'expire' => '20'
  );

  set_cookie($alert_status_cookie);
  set_cookie($alert_message_cookie);
}

function getAlertFromCookie(){
  $alert_status_cookie = get_cookie('alert_status');
  $data = array();
  if($alert_status_cookie != null) {
    
    $data['status'] = $alert_status_cookie;
    $data['message'] = get_cookie('alert_message');

    delete_cookie('alert_status');
    delete_cookie('alert_message');
  } else {
    $data['status'] = null;
  }
  return $data;
}
?>