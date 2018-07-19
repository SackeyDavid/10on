@php

    $callback_obj = file_get_contents("php://input");

   
    $log_file = fopen("log-callback.txt", "a") or die("Unable to open file!");
    fwrite($log_file,"$callback_obj"); 
    fclose($log_file); 
    exit();
@endphp