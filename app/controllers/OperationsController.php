<?php

class OperationsController extends BaseController {

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

    /*Start a: VM, paused, forced*/
    public function startVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_start($vmRef, False, True);
            return Redirect::to('/')->with('flashBanner', 'VM Started');
        }
    
    /*No Extra Params*/
    public function cleanShutdownVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_clean_shutdown($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Clean Shutdown');
        }
    
    /*No Extra Params*/
    public function suspendVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_suspend($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Suspended');
        }
    
    /*No Extra Params*/
    public function cleanRebootVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_clean_reboot($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Rebooted');
        }
    
    /*Start a: VM, paused, forced*/
    public function resumeVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_resume($vmRef, False, True);
            return Redirect::to('/')->with('flashBanner', 'VM Resumed');
        }
    
    /*No Extra Params*/
    public function hardShutdownVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_hard_shutdown($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Forced Shutdown');
        }
    
    public function hardRebootVMRef($vmRef) 
        {
            Credentials::loginXen()->VM_hard_reboot($vmRef);
            return Redirect::to('/')->with('flashBanner', 'VM Forced Reboot');
        }
    
    
    
    
}
