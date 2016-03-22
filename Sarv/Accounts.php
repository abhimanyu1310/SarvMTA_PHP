<?php

class Sarv_Accounts {

    public function __construct(Sarv $master) {
        $this->master = $master;
    } 
	public function viewUserDetail() {
        $_params = array();
        return $this->master->call('account/viewUserDetail', $_params);
    }
    
}
