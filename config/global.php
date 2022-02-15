<?php

return [
    //user status
    'user_status_pending'=>0,
    'user_status_active'=>1,
    'user_status_blocked'=>2,

    //user roles
    'user_role_admin'=>0,
    'user_role_vendor'=>1,

    //alerts
    'flash_success'=>'alert-success',
    'flash_error'=>'alert-danger',


     //tender status
     'tender_removed'=>0,
     'tender_publish'=>1,
     'tender_draft'=>2,
     'tender_closed'=>3,

     //session attributes
     'session_user_obj'=>"logged_user_object",
     'session_permissions'=>"permissions",
     'session_permissions_tabs'=>"permissions_tabs",

     //offer status
     'offer_status_pending'=>0,
     'offer_status_approved'=>1,
     'offer_status_rejected'=>2,

     'offer_status_action_approve'=>"Approve",
     'offer_status_action_reject'=>"Reject",
     'offer_status_action_revert'=>"Revert",
];

?>