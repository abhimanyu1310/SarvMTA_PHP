<?php

class Sarv_Settings {

    public function __construct(Sarv $master) {
        $this->master = $master;
    }

    public function listSmtp() {
        $_params = array();
        return $this->master->call('settings/listSmtp', $_params);
    }

    public function addSmtpUser($total_limit = null, $hourly_limit = null) {
        $_params = array();
        
        if(isset($total_limit)){
           $_params['total_limit'] =  $total_limit;
        }
        
        if(isset($hourly_limit)){
           $_params['hourly_limit'] =  $hourly_limit;
        }
        
        return $this->master->call('settings/addSmtp', $_params);
    }

    public function editSmtp($smtp_user_name = null, $total_limit = null, $hourly_limit = null, $status = null) {
        $_params = array();
       
        if(isset($smtp_user_name)){
           $_params['smtp_user_name'] =  $smtp_user_name;
        }
        
        if(isset($total_limit)){
           $_params['total_limit'] =  $total_limit;
        }
        
        if(isset($hourly_limit)){
           $_params['hourly_limit'] =  $hourly_limit;
        }
        
        if(isset($status)){
           $_params['status'] =  $status;
        }
        return $this->master->call('settings/editSmtp', $_params);
    }
    
    public function resetSmtpPassword($smtp_user_name = null) {
        $_params = array();
        
        if(isset($smtp_user_name)){
           $_params['smtp_user_name'] =  $smtp_user_name;
        }
        
        return $this->master->call('settings/resetSmtpPassword', $_params);
    }
    
    
    public function addSendingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/addSendingDomain', $_params);
    }
    
    public function deleteSendingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/deleteSendingDomain', $_params);
    }
    
    public function checkSendingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/checkSendingDomain', $_params);
    }
    
    public function verifySendingDomain($domain = null,$mailbox = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        if(isset($mailbox)){
           $_params['mailbox'] =  $mailbox;
        }
        
        return $this->master->call('settings/verifySendingDomain', $_params);
    }
    
    public function listSendingDomain() {
        $_params = array();
        return $this->master->call('settings/listSendingDomain', $_params);
    }
    
    public function addTrackingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/addTrackingDomain', $_params);
    }
    
    public function deleteTrackingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/deleteTrackingDomain', $_params);
    }
    
    
    public function checkTrackingDomain($domain = null) {
        $_params = array();
        
        if(isset($domain)){
           $_params['domain'] =  $domain;
        }
        
        return $this->master->call('settings/checkTrackingDomain', $_params);
    }
    
    public function listTrackingDomain() {
        $_params = array();
        return $this->master->call('settings/listTrackingDomain', $_params);
    }
    
    public function addWebhook($url = null,$event = null,$description = null,$store_log = null) {
        $_params = array();
        
        if(isset($url)){
           $_params['url'] =  $url;
        }
        
        if(isset($event)){
           $_params['event'] =  $event;
        }
        
        if(isset($description)){
           $_params['description'] =  $description;
        }
        
        if(isset($store_log)){
           $_params['store_log'] =  $store_log;
        }
        
        return $this->master->call('settings/addWebhook', $_params);
    }
    
    public function editWebhook($webhook_id = null,$url = null,$event = null,$description = null,$store_log = null) {
        $_params = array();
        
        if(isset($webhook_id)){
           $_params['webhook_id'] =  $webhook_id;
        }
        
        if(isset($url)){
           $_params['url'] =  $url;
        }
        
        if(isset($event)){
           $_params['event'] =  $event;
        }
        
        if(isset($description)){
           $_params['description'] =  $description;
        }
        
        if(isset($store_log)){
           $_params['store_log'] =  $store_log;
        }
        
        return $this->master->call('settings/editWebhook', $_params);
    }
    
    public function deleteWebhook($webhook_id = null) {
        $_params = array();
        
        if(isset($webhook_id)){
           $_params['webhook_id'] =  $webhook_id;
        }
        
        return $this->master->call('settings/deleteWebhook', $_params);
    }
    
    public function keyResetWebhook($webhook_id = null) {
        $_params = array();
        
        if(isset($webhook_id)){
           $_params['webhook_id'] =  $webhook_id;
        }
        
        return $this->master->call('settings/keyResetWebhook', $_params);
    }
    
    public function listWebhook() {
        $_params = array();
        return $this->master->call('settings/listWebhook', $_params);
    }
    
    public function getWebhookInfo($webhook_id = null) {
        $_params = array();
        
        if(isset($webhook_id)){
           $_params['webhook_id'] =  $webhook_id;
        }
        
        return $this->master->call('settings/getWebhookInfo', $_params);
    }
    
}
