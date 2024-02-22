<?php
//return boolean results
function store_submits_to_file($name,$email){
    $fp = fopen(submits_file,"a+");
    if($fp){
    $input=date("F j Y g:i a").",".$_SERVER['REMOTE_ADDR'] . "," . "$name,$email".PHP_EOL;
    if(fwrite($fp,$input)){
    fclose($fp);
    return true;
    }else{
        return false;
    }
    }else{
        return false;
    }
}


function display_all_submits(){
    $lines= file(submits_file);
    foreach($lines as $line){
        //echo "<h3>New User Details</h3>";
        $words= explode(",",$line);
        $i=0;
        foreach($words as $word){
            if($i==0){
                echo "<h5>Visit Date:$word</h5>";
            } elseif($i==1){
                echo "<h5>IP Address:$word</h5>";
            }elseif($i==2){
                echo "<h5>Name:$word</h5>";
            }elseif($i==3){
                echo "<h5>Email:$word</h5>";
            }
            $i++;
        }
        echo "<hr/>";
    }
}