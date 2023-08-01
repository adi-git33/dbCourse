<?php
include "db.php";

if (isset($_GET["numOfMonths"])) {
    $numOfMonths = $_GET['numOfMonths'];
}

if (isset($_GET["numOfWeeks"])) {
    $numOfWeeks = $_GET['numOfWeeks'];
}
if (isset($_GET["qSelect"])) {
    $option = $_GET["qSelect"];
}

$tbl = '<table class="table table-dark table-hover">';
switch ($option) {
    case 1:
        $quary1 = "SELECT 
        ev.event_id,
        evc.course_name,
        evt.event_type_name,
        ev.num_of_guest,
        ev.event_date,
        ev.price
    FROM
        team15_Event AS ev
            INNER JOIN
        team15_Event_Course AS evc ON ev.course_id = evc.course_id
            INNER JOIN
        team15_Event_Type AS evt ON ev.event_type_id = evt.event_type_id
    WHERE
        event_date >= DATE_SUB(CURDATE(), INTERVAL $numOfWeeks WEEK)
            AND event_date <= CURDATE();";

        $result = mysqli_query($connection, $query1);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr>
        <th>event id</th>
        <th>course type</th>
        <th>event type</th>
        <th>guests</th> 
        <th>date</th>
        <th>price</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr>
            <td>" . $row["event_id"] . "<\td>
            <td>" . $row["course_name"] . "<\td>
            <td>" . $row["event_type_name"] . "<\td>
            <td>" . $row["num_of_guest"] . "<\td>
            <td>" . $row["event_date"] . "<\td>
            <td>" . $row["price"] . "<\td>
            <\tr>";
        }

        break;
    case 2:
        $query2 = "SELECT 
        *
        FROM
        team15_Event AS ev
            INNER JOIN
        team15_Event_Costumer AS evco ON ev.event_id = evco.event_id
            INNER JOIN
        team15_Person AS per ON per.person_id = evco.person_id
        WHERE
        ev.event_date > NOW();";

        $result = mysqli_query($connection, $query2);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr>
        <th>event id</th>
        <th>course type</th>
        <th>event type</th>
        <th>guests</th> 
        <th>date</th>
        <th>price</th>
        <th>person id</th> 
        <th>address</th> 
        <th>city</th>
        <th>first name</th> 
        <th>last name</th> 
        <th>phone</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr>
        <td>" . $row["event_id"] . "<\td>
        <td>" . $row["course_name"] . "<\td>
        <td>" . $row["event_type_name"] . "<\td>
        <td>" . $row["num_of_guest"] . "<\td>
        <td>" . $row["event_date"] . "<\td>
        <td>" . $row["price"] . "<\td>
        <td>" . $row["person_id"] . "<\td>
        <td>" . $row["address_name"] . "<\td>
        <td>" . $row["city_name"] . "<\td>
        <td>" . $row["first_name"] . "<\td>
        <td>" . $row["last_name"] . "<\td>
        <td>" . $row["phone"] . "<\td>
        <\tr>";
        }

        break;
    case 3:
        $query3 = "SELECT 
        emp_count.event_id,
        CEILING(emp_count.num_of_guest / 20) - emp_count.chefs_on_event AS chefs_needed,
        CEILING(emp_count.num_of_guest / 35) - emp_count.waiters_on_event AS waiters_needed
        FROM
        (SELECT 
            ev.event_id,
                TEAM15_EMPLOYEE_COUNT(ev.event_id, 2) AS chefs_on_event,
                TEAM15_EMPLOYEE_COUNT(ev.event_id, 3) AS waiters_on_event,
                ev.num_of_guest
        FROM
            team15_Event AS ev) AS emp_count
        WHERE
        emp_count.chefs_on_event < CEILING(emp_count.num_of_guest / 20)
            AND emp_count.waiters_on_event < CEILING(emp_count.num_of_guest / 35);";

        $result = mysqli_query($connection, $query3);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr>
        <th>event id</th>
        <th>chefs needed</th>
        <th>waiters needed</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr>
            <td>" . $row["event_id"] . "<\td>
            <td>" . $row["chefs_needed"] . "<\td>
            <td>" . $row["waiters_needed"] . "<\td>
            <\tr>";
        }

        break;
    case 4:
        $quary4 = "SELECT 
        p.person_id,
        p.first_name,
        p.last_name,
        COUNT(ec.person_id) AS num_of_events
    FROM
        team15_Person AS p
            INNER JOIN
        team15_Person_Type AS ptype ON p.person_type_id = ptype.person_type_id
            INNER JOIN
        team15_Event_Customer AS ec ON p.person_id = ec.person_id
    GROUP BY p.first_name , p.last_name
    HAVING num_of_events > 1;";

        $result = mysqli_query($connection, $query4);
        if (!$result) {
            die("DB query failed.");
        }

            $tbl .= "<tr>
                <th>person id</th>
                <th>first name</th>
                <th>last name</th>
                <th>occouring events</th> 
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr>
    <td>" . $row["person_id"] . "<\td>
    <td>" . $row["first_name"] . "<\td>
    <td>" . $row["last_name"] . "<\td>
    <td>" . $row["num_of_events"] . "<\td>
    <\tr>";
        }
        break;
    case 5:
        $query5 = "SELECT 
        ev.event_id, SUM(ev.price) AS incomes
        FROM
        team15_Event AS ev
        WHERE
        ev.event_date >= DATE_SUB(CURDATE(), INTERVAL $numOfMonths MONTH)
            AND ev.event_date < CURDATE();
        ";

        $result = mysqli_query($connection, $query5);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr>
        <th>event id</th>
        <th>incomes</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr>
            <td>" . $row["event_id"] . "<\td>
            <td>" . $row["incomes"] . "<\td>
            <\tr>";
        }
        break;
    case 6:
        break;
    case 7:
        break;
    case 8:
        break;
}


?>