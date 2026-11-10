<?php
    session_start();
    
    if(!isset($SESSION ['USERID'])){
        header ('refresh:0;url = signin.html');
    }
