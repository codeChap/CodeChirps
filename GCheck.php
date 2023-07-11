<?php

    // Connect to gmail
    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
    $username = file_get_contents('GmailSmtpUsername.secret');
    $password = file_get_contents('GmailSmtpPassword.secret');

    // Try to connect
    $inbox = imap_open($hostname,$username ,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

    // Grab pretty emails
    $emails = imap_search($inbox,'ALL');
    if($emails) {

        // Put the newest emails on top
        rsort($emails);

        // Loop over emails
        foreach($emails as $emailNumber) {

            // Get information on this email */
            $overview = imap_fetch_overview($inbox, $emailNumber, 0);

            // Print email information
            print $overview[0]->from . ' - ' . $overview[0]->subject . PHP_EOL;
        }
    }

    // Close the connection
    imap_close($inbox);

?>