<?php

class DetailsController extends BaseController {

        /*Inherit __construct method from BaseController*/
	public function __construct()
        {
            parent::__construct();
        }  

    /*  All Classes in XenAPI can have the follow operations done, example Credentials::loginXen()->VM_get_by_uuid($uuid);"
        "get_by_name_label"
        "get_by_uuid"
        "get_record"
        "get_all"
        
        Also you can do VM_get{fields}, VM_get_is_a_template, or VM_get_bios_strings
        set_X: change the value of field X (only if it is read-write);
        get_X: retrieve the value of field X;
        add_to_X: add a key/value pair (only if field has type set or map); and
        remove_from_X: remove a key (only if a field has type set or map).
        http://docs.vmd.citrix.com/XenServer/6.2.0/1.0/en_gb/api/
        
        Enums are operations you can do directly against an OpaqueRef
        Credentials::loginXen()->VM_clean_shutdown($vmRef);
    */
    
    /*Get all the details on a VM based on UUID*/
    public function getVMInfoRef($vmRef) 
        {
      
           $allDetails = Credentials::loginXen()->VM_get_record($vmRef);
        
           return View::make('detailInfo', compact('allDetails'));
            
        }
    
    public function getHostInfoRef($hostRef)
        {
            $allDetails = Credentials::loginXen()->host_get_record($hostRef);
            return View::make('detailInfo', compact('allDetails'));
        }
    
    public function getPoolInfoRef($poolRef)
        {
            $allDetails = Credentials::loginXen()->pool_get_record($poolRef);
            return View::make('detailInfo', compact('allDetails'));
        }
    
}
