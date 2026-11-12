<?php
require("../config/database.php");

$sql = "
    SELECT
        id,
        firstname,
        lastname,
        mobile_phone,
        email,
        CASE
            WHEN users.status = true THEN 'Active'
            ELSE 'Inactive'
        END AS user_status,
        photo_url
    FROM
        users
    ORDER BY
        lastname ASC
";

$res = pg_query($supa_conn, $sql);

if (!$res) {
    die("Error en la consulta: " . pg_last_error($local_conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
</head>
<body>

    <center>
        <h3>List all users</h3>
    </center>

    <table border="1" align="center" cellpadding="8" cellspacing="0">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Mobile Phone</th>
            <th>Email</th>
            <th>User Status</th>
            <th>Photo</th>
            <th>...</th>
        </tr>

        <?php
        while ($row = pg_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mobile_phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['user_status']) . "</td>";

            // PHOTO
            $foto = trim($row['photo_url'] ?? '');

if (empty($foto)) {
    $foto = 'photos/usuario.png';
}

echo "<td>";
echo "<img src='" . htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') . "'
      width='60'
      height='60'
      style='border-radius:50%; object-fit:cover;'
      alt='Foto de perfil'
      onerror=\"this.onerror=null;this.src='photos/user_default.png';\">";
echo "</td>";

            // ACTIONS
            echo "<td>";
            
            // 1. SEARCH / VER (Lupa)
            echo "<a href='view_user.php?id=" . $row['id'] . "'>";
            echo "<img src='icons/lupa.png' width='20' height='20' alt='Search'>";
            echo "</a>&nbsp;";

            // 2. EDIT (Lápiz)
            echo "<a href='edit_user.php?id=" . $row['id'] . "'>";
            echo "<img src='icons/lapiz.png' width='20' height='20' alt='Edit'>";
            echo "</a>&nbsp;";

            // 3. DELETE (Eliminar)
            echo "<a href='delete_user.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">";
            echo "<img src='icons/delete.png' width='20' height='20' alt='Delete'>";
            echo "</a>";

            echo "</td>";

            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>