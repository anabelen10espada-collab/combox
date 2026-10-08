<?php
    //get database connection
    require("../config/database.php");

    // Get data from html form (client)
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $m_phone = $_POST['mphone'];
    $e_mail = $_POST['email'];
    $p_assword = $_POST['psw'];
    $pass_enc = md5($p_assword);
    
    //prepared query
    $sql = "
        INSERT INTO users (
            firstname, lastname, mobile_phone, email, password
        )
        VALUES (
            '$f_name', '$l_name', '$m_phone', '$e_mail', '$pass_enc'
        )
    ";

    $local_res = pg_query($local_conn, $sql);
    $supa_res = pg_query($supa_conn, $sql);

    if ($local_res) {
        echo "<br> User has been created successfully local database!!!";
    } else {
        echo "<br> User hasn't been created into local database!!!";
    }
    
    if ($supa_res) {
        echo "<br> User has been created successfully supa database!!!";
    } else {
        echo "<br> User hasn't been created into supa database!!!";
    }
    //Redirecciona a login
    echo "<script>alert('User has been created successfylly:::')</script>";
    header('refresh:0;url=signin.html');

    /*echo "Firstname is: ". $f_name;
    echo "<br> Lastname is: ". $l_name;
    echo "<br> Mobilepsshone is: ". $m_phone;
    echo "<br> E-mail is: ". $e_mail;
    echo "<br> Password is: ". $p_assword;*/

?>