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

}


