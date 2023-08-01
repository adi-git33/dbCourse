<?php
include "db.php";

if ((isset($_GET["eveIDSix"])) && (isset($_GET["empIDSix"]))) {
    $eveID6 = $_GET['eveIDSix'];
    $empId6 = $_GET['empIDSix'];
    $query = 'call team15_add_employee_into_team (' . $eveID6 . ', ' . $empId6 . '';
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $tbl = '<table class="table table-dark table-hover">';

    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr>
            <td>" . $row['']  . "</td>
    <\tr>";
    }

    $tbl .= '</table>';



    $response = array('retVal' => $list);
    echo json_encode($response);

    mysqli_free_result($result);
    mysqli_free_result($catResult);

    mysqli_close($connection);

}










?>