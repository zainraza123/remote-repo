<?php 

    include('config.php');

    $loginMessage = '';

    //if login attempted 
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = post('username');
        $password = post('password');
        $ad = ldap_connect(LDAP_SERVER);

        // Set version number
        ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3)
            or die ("Could not set ldap protocol");
        
        // Binding to ldap server
        if( @ldap_bind($ad, "nku\\".$username, $password) ) {
            $sql = get_sql('getEmployee');
            $params = array ('username' => $username);
            $employees = $database->queryObject('Employee', $sql, $params);
            
            if(!empty($employees)) {
                $_SESSION['employee'] = $employees[0];
                header('Location: index.php');
            }
            else {
                $message = 'No organizations have invited you to the system.';
            }
        }
        else {
            $message = 'Login credentials were incorrect.';
        }
    }


    $template = new Template('templates/basic/blank.php');
    $template->set('page_title', 'Login');

    ob_start();
    include('views/loginForm.php');
    $content = ob_get_clean();
    $template->set('content', $content);
    echo $template->fetch();

?>