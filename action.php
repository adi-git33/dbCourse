<?php
include "db.php";

$query = "SELECT DISTINCT * FROM tbl_212_protest AS prot INNER JOIN tbl_212_prot_user AS prot_user ON prot_user.prot_id = prot.prot_id
    INNER JOIN tbl_212_users AS users ON prot_user.user_id = users.user_id";

$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}

$tbl = '<table class="table table-dark table-hover">';

while ($row = mysqli_fetch_assoc($result)) {
    $tbl .= "<tr>
<td>row 1, cell 1<\td>
<td>row 1, cell 2<\td>
<\tr>";
}

$tbl .= '</table>';

isset($_POST["sort"])

    ?>