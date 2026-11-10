<?php
require("../config/database.php");

$sql = "
    SELECT
        firstname,
        lastname,
        mobile_phone,
        email, 
        case 
            when u.status = true then 'Active' else 'Inactive'
        end as user_status,
        photo_url
    FROM 
        users u 
    ORDER BY
        lastname ASC
    ";
        $res = pg_query($local_conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <table border = "1" align = "center">
            <?php
                while($row = pg_fetch_assoc($res)){
                    echo "<td>", $row['mobilephone'], "</dt>";
                    echo "<td>", $row['emailo'], "</dt>";
                    echo "<td>", $row['user_staus'], "</dt>";
                    echo "<td align = 'center'><img src = '", $row['photo_url'], "'width = '30'></td>";
                    echo "<td>
                            <img src = 'icons/lupa.png' width = '15'>&nbsp;&nbsp;
                            <img src = 'icons/lapiz.png' width = '15'>&nbsp;&nbsp;
                            <img src = 'icons/delete.png' width = '15'>
                        </td>
                    ";
                    echo "</tr>"
                }
            ?>
        table>
        >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comboox - List users</title>

</head>  
</body>
    <center><h3>Listt all users</h3></center>
    
    <table border = "1" align = "center">
        <tr> //abre fila
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Status</th>
        </tr>  //cierra fila
        ?>
    </table>
    </form>

</html>
