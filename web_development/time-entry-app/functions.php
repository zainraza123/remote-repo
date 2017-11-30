<?php

function jesse()
{
    echo 'jesse!';
}

function clean($string)
{
    return strip_tags($string);
}

function get($key)
{
    if (isset($_GET[$key])) {
        return clean($_GET[$key]);
    } else {
        return '';
    }
}

function post($key)
{
    if (isset($_POST[$key])) {
        return clean($_POST[$key]);
    } else {
        return '';
    }
}

function data($var)
{
    if (strpos($var, '->') !== true) {
        $strings = explode('->', $var);
        $string = $strings[0];
        $property = $strings[1];
    }
    
    global ${$var};
    $string = ${$var};
    
    return $string->name;
    if (!empty($string)) {
        return $string;
    } else {
        return '';
    }
}

function get_sql($sqlName)
{
    return file_get_contents(ROOT . 'sql/' . $sqlName . '.sql');
    /*$it = new RecursiveDirectoryIterator(ROOT . 'sql/');
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (strpos($file, $sqlName . '.sql')) {
            return file_get_contents($file);
        }
    }*/
}

function snippet($string, $characters)
{
    if (strlen($string) <= $characters) {
        return $string;
    }
    
    $string = substr($string, 0, $characters);
    $string .= '...';
    return $string;
}

function decimalToTime($decimal)
{
    $hours = floor($decimal);
    $fraction = $decimal - $hours;
    $minutes = $fraction * 60;
    if ($minutes == 0) {
        $minutes = "00";
    }
    
    return "$hours:$minutes:00";
}

function getProjectDanger($spent, $cap)
{
    if ($cap == 0) {
        $cap = 1000000;
    }
    
    $percent = $spent / $cap;
    if ($percent >= 1) {
        return 'danger';
    } elseif ($percent >= '.80') {
        return 'warning';
    } else {
        return 'neutral';
    }
}

function getInvoiceDanger($days)
{
    if ($days >= 90) {
        return 'danger';
    } elseif ($days >= 60) {
        return 'warning';
    } else {
        return 'neutral';
    }
}

function getOverallDanger($spent, $cap, $days)
{
    $projectDanger = getProjectDanger($spent, $cap);
    $invoiceDanger = getInvoiceDanger($days);

    if ($invoiceDanger == 'danger' || $projectDanger == 'danger') {
        return 'danger';
    } elseif ($invoiceDanger == 'warning' || $projectDanger == 'warning') {
        return 'warning';
    } else {
        return 'neutral';
    }
}

function date_formatter($date_string, $format)
{
    $date = new DateTime($date_string);
    return $date->format($format);
}

function send_email($subject, $content, $addresses)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = EMAIL_HOST;
    $mail->Port = EMAIL_PORT;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->Username = EMAIL_USER;
    $mail->Password = EMAIL_PASSWORD;
    $mail->SetFrom(EMAIL_FROM, 'CAI Time Entry');
    
    foreach ($addresses as $name => $address) {
        if (is_int($name)) {
            $mail->addAddress($address);
        } else {
            $mail->addAddress($address, $name);
        }
    }
    //$mail->SMTPDebug  = 3;
    //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
    $mail->IsHTML(true);

    $mail->Subject = $subject;
    $mail->Body    = $content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message has been sent';
    }
}

function getEOID($username, $organizationID)
{
    global $database;
    $sql = get_sql('getEOID');
    $params = array(
        'username' => $username,
        'organizationID' => $organizationID
    );
    $EOIDrows = $database->query($sql, $params);
    return $EOIDrows[0]['EOID'];
}

function getUserFromAD($username)
{
    $ad = ldap_connect(LDAP_SERVER);

    // Set version number
    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3)
        or die ("Could not set ldap protocol");
    
    // Binding to ldap server
    if (@ldap_bind($ad, EMAIL_USER, EMAIL_PASSWORD)) {
        // Create the DN
        $dn = "OU=Users,OU=HH,OU=NKU,DC=hh,DC=nku,DC=edu";

        // Create the filter from the search parameters
        $filter = "(cn=$username)";

        $search = ldap_search($ad, $dn, $filter)
          or die ("ldap search failed");

        $entries = ldap_get_entries($ad, $search);
        
        if (!empty($entries)) {
            $entry = $entries[0];
            //echo "<pre>";print_r($entry);echo "<pre>";die();

            return array(
                'firstName' => $entry['givenname'][0],
                'lastName' => $entry['sn'][0],
                'mail' => $entry['mail'][0],
                'cn' => $entry['cn'][0]
            );
        } else {
            return false;
        }
    }
}

function setMessage($type, $message)
{
    $_SESSION['messages'][] = array(
        'type' => $type,
        'message' => $message
    );
}

function getMessages()
{
    if (isset($_SESSION['messages'])) {
        $messages = $_SESSION['messages'];
        $_SESSION['messages'] = null;
        return $messages;
    } else {
        return array();
    }
}
