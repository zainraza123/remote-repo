<?php
include( 'config.php' );

$template = new Template('templates/basic/blank.php');
$template->set('page_title', 'Registration');

//check to see if  submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //handle the form submission

    //validate invite

    //insert into employee table

    //retrieve employee ID from DB 

    //delete invitation
}

$inviteCode = get('inviteCode');
$organizationID = get('organizationID');

ob_start();
include('views/registerForm.php');
$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
