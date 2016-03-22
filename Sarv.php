<?php
require_once 'Sarv/Messages.php';
require_once 'Sarv/Settings.php';
require_once 'Sarv/Accounts.php';

class Sarv {
    
    public $apikey;
    public $owner_id;
    public $ch;
    public $root = 'http://master.us.sarv.email:7278/';
    public $debug = false;

    public static $error_map = array(
        "ValidationError" => "Sarv_ValidationError",
        "Invalid_Key" => "Sarv_Invalid_Key",
        "PaymentRequired" => "Sarv_PaymentRequired",
        "Unknown_Subaccount" => "Sarv_Unknown_Subaccount",
        "Unknown_Template" => "Sarv_Unknown_Template",
        "ServiceUnavailable" => "Sarv_ServiceUnavailable",
        "Unknown_Message" => "Sarv_Unknown_Message",
        "Invalid_Tag_Name" => "Sarv_Invalid_Tag_Name",
        "Invalid_Reject" => "Sarv_Invalid_Reject",
        "Unknown_Sender" => "Sarv_Unknown_Sender",
        "Unknown_Url" => "Sarv_Unknown_Url",
        "Unknown_TrackingDomain" => "Sarv_Unknown_TrackingDomain",
        "Invalid_Template" => "Sarv_Invalid_Template",
        "Unknown_Webhook" => "Sarv_Unknown_Webhook",
        "Unknown_InboundDomain" => "Sarv_Unknown_InboundDomain",
        "Unknown_InboundRoute" => "Sarv_Unknown_InboundRoute",
        "Unknown_Export" => "Sarv_Unknown_Export",
        "IP_ProvisionLimit" => "Sarv_IP_ProvisionLimit",
        "Unknown_Pool" => "Sarv_Unknown_Pool",
        "NoSendingHistory" => "Sarv_NoSendingHistory",
        "PoorReputation" => "Sarv_PoorReputation",
        "Unknown_IP" => "Sarv_Unknown_IP",
        "Invalid_EmptyDefaultPool" => "Sarv_Invalid_EmptyDefaultPool",
        "Invalid_DeleteDefaultPool" => "Sarv_Invalid_DeleteDefaultPool",
        "Invalid_DeleteNonEmptyPool" => "Sarv_Invalid_DeleteNonEmptyPool",
        "Invalid_CustomDNS" => "Sarv_Invalid_CustomDNS",
        "Invalid_CustomDNSPending" => "Sarv_Invalid_CustomDNSPending",
        "Metadata_FieldLimit" => "Sarv_Metadata_FieldLimit",
        "Unknown_MetadataField" => "Sarv_Unknown_MetadataField"
    );

    public function __construct($owner_id=null,$apikey=null) {
        if(!$apikey) throw new Sarv_Error('You must provide a Sarv Token');
        if(!$owner_id) throw new Sarv_Error('You must provide a Sarv Owner id');
        $this->apikey = $apikey;
        $this->owner_id = $owner_id;

        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Sarv-PHP/1.0.11');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 600);

        $this->root = rtrim($this->root, '/') . '/';
        $this->messages = new Sarv_Messages($this);
        $this->settings = new Sarv_Settings($this);
        $this->accounts = new Sarv_Accounts($this);
    }

    public function __destruct() {
        curl_close($this->ch);
    }

    public function call($url, $params) {
        $params['token'] = $this->apikey;
        $params['owner_id'] = $this->owner_id;
        $params = json_encode($params);
        $ch = $this->ch;

        curl_setopt($ch, CURLOPT_URL, $this->root . $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

        $start = microtime(true);
        $this->log('Call to ' . $this->root . $url . $params);
        if($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
        }

        $response_body = curl_exec($ch);
        $info = curl_getinfo($ch);
        $time = microtime(true) - $start;
        if($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if(curl_error($ch)) {
            throw new Sarv_HttpError("API call to $url failed: " . curl_error($ch));
        }
        $result = json_decode($response_body, true);
        if($result === null) throw new Sarv_Error('We were unable to decode the JSON response from the Sarv API: ' . $response_body);
        
        if(floor($info['http_code'] / 100) >= 4) {
            throw $this->castError($result);
        }

        return $result;
    }

    public function castError($result) {
        if($result['status'] !== 'error' || !$result['name']) throw new Sarv_Error('We received an unexpected error: ' . json_encode($result));

        $class = (isset(self::$error_map[$result['name']])) ? self::$error_map[$result['name']] : 'Sarv_Error';
        return new $class($result['message'], $result['code']);
    }

    public function log($msg) {
        if($this->debug) error_log($msg);
    }
}


