<?php
// save as "session_test.php" inside your webspace
ini_set('display_errors', 'On');
error_reporting(6143);

session_start();

$sessionSavePath = ini_get('session.save_path');

echo '<br><div style="background:#def;padding:6px">'
   , 'If a session could be started successfully <b>you should'
   , ' not see any Warning(s)</b>, otherwise check the path/folder'
   , ' mentioned in the warning(s) for proper access rights.<hr>';

if (empty($sessionSavePath)) {
    echo 'A "<b>session.save_path</b>" is currently',
         ' <b>not</b> set.<br>Normally "<b>';
    if (isset($_ENV['TMP'])) {
        echo  $_ENV['TMP'], '</b>" ($_ENV["TMP"]) ';
    } else {
        echo '/tmp</b>" or "<b>C:\tmp</b>" (or whatever',
             ' the OS default "TMP" folder is set to)';
    }
    echo ' is used in this case.';
} else {
    echo 'The current "session.save_path" is "<b>',
         $sessionSavePath, '</b>".';
}

echo '<br>Session file name: "<b>sess_', session_id()
   , '</b>".</div><br>';
?>
