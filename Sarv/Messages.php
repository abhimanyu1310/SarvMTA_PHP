<?php

class Sarv_Messages {
    public function __construct(Sarv $master) {
        $this->master = $master;
    }
    
    public function sendMail($smtp_user_name = null,$message = null) {
        $_params = array();
        
        if(isset($smtp_user_name)){
           $_params['smtp_user_name'] =  $smtp_user_name;
        }
        
        if(isset($message)){
           $_params['message'] =  $message;
        }
        return $this->master->call('messages/sendMail', $_params);
    }
   
    public function sendRaw($smtp_user_name = null, $raw_message = null) {
		$_params = array();
		if(isset($smtp_user_name)){
           $_params['smtp_user_name'] =  $smtp_user_name;
        }
        
        if(isset($raw_message)){
           $_params['raw_message'] =  $raw_message;
        }
		
        return $this->master->call('messages/sendRaw', $_params);
    }
    
    public function getMessageInfo($x_unique_id = null, $skip_page = 0) {
	$_params = array();
	if(isset($x_unique_id)){
           $_params['x_unique_id'] =  $x_unique_id;
        }
		
	if(isset($skip_page)){
           $_params['skip_page'] =  $skip_page;
        }
		
        return $this->master->call('messages/getMessageInfo', $_params);
    }

}


