<?php
include "db.php";

if (isset($_GET["numOfMonths"])) {
    $numOfMonths = $_GET['numOfMonths'];
}
if (isset($_GET["numOfWeeks"])) {
    $numOfWeeks = $_GET['numOfWeeks'];
}

if (isset($_GET["fname"])) {
    $fname = $_GET['fname'];
}

if (isset($_GET["lname"])) {
    $lname = $_GET['lname'];
}

if (isset($_GET["monthsEight"])) {
    $month = $_GET['monthsEight'];
}

if (isset($_GET["yearEight"])) {
    $year = $_GET['yearEight'];
}

if (isset($_GET["qSelect"])) {
    $option = $_GET["qSelect"];
}
if ((isset($_GET["eveIDSix"])) && (isset($_GET["empIDSix"]))) {
    $eveID6 = $_GET['eveIDSix'];
    $empId6 = $_GET['empIDSix'];
}

if ((isset($_GET["eveIDSix"])) && (isset($_GET["empIDSix"]))) {
    $eveID7 = $_GET['eveIDSeven'];
    $perc = $_GET['percent'];
}

$dupKey = 0;
$sale = 0;
$notSaleman = 0;
$empCheck = 0;
$evCheck = 0;
$tbl = '<table class="table table-dark table-hover table-responsive-xl">';
if ($option == 1) {
    $query = 'SELECT ev.event_id, evc.course_name, evt.event_type_name, ev.num_of_guest, ev.event_date, ev.price FROM team15_Event AS ev INNER JOIN team15_Event_Course AS evc ON ev.course_id = evc.course_id INNER JOIN team15_Event_Type AS evt ON ev.event_type_id = evt.event_type_id WHERE event_date >= DATE_SUB(CURDATE(), INTERVAL ' . $numOfWeeks . ' WEEK) AND event_date <= CURDATE()';
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }

    $tbl .= "<tr><th>event id</th><th>course type</th><th>event type</th><th>guests</th><th>date</th><th>price</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr><td>" . $row["event_id"] . "</td><td>" . $row["course_name"] . "</td><td>" . $row["event_type_name"] . "</td><td>" . $row["num_of_guest"] . "</td><td>" . $row["event_date"] . "</td><td>" . $row["price"] . "</td></tr>";
    }
} else if ($option == 2) {
    $query = "SELECT ev.event_id, evf.course_name, evt.event_type_name, ev.num_of_guest, ev.event_date, ev.price, per.person_id, ad.address_name, ct.city_name, per.first_name, per.last_name, per.phone FROM team15_Event AS ev INNER JOIN team15_Event_Type AS evt ON ev.event_type_id = evt.event_type_id INNER JOIN team15_Event_Customer AS evco ON ev.event_id = evco.event_id INNER JOIN team15_Event_Course AS evf ON evf.course_id = ev.course_id INNER JOIN team15_Person AS per ON per.person_id = evco.person_id INNER JOIN team15_Address AS ad ON per.address_id = ad.address_id INNER JOIN team15_City AS ct ON ct.city_id = ad.city_id WHERE ev.event_date > NOW()";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $tbl .= "<tr><th>event id</th><th>course type</th><th>event type</th><th>guests</th><th>date</th><th>price</th><th>person id</th><th>address</th><th>city</th><th>first name</th><th>last name</th><th>phone</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr><td>" . $row["event_id"] . "</td><td>" . $row["course_name"] . "</td><td>" . $row["event_type_name"] . "</td><td>" . $row["num_of_guest"] . "</td><td>" . $row["event_date"] . "</td><td>" . $row["price"] . "</td><td>" . $row["person_id"] . "</td><td>" . $row["address_name"] . "</td><td>" . $row["city_name"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["phone"] . "</td></tr>";
    }
} else if ($option == 3) {
    $query = "SELECT emp_count.event_id, emp_count.event_date, CEILING(emp_count.num_of_guest / 20) - emp_count.chefs_on_event AS chefs_needed, CEILING(emp_count.num_of_guest / 35) - emp_count.waiters_on_event AS waiters_needed FROM (SELECT ev.event_id, ev.event_date, TEAM15_EMPLOYEE_COUNT(ev.event_id, 2) AS chefs_on_event, TEAM15_EMPLOYEE_COUNT(ev.event_id, 3) AS waiters_on_event, ev.num_of_guest FROM team15_Event AS ev) AS emp_count WHERE emp_count.chefs_on_event < CEILING(emp_count.num_of_guest / 20) AND emp_count.waiters_on_event < CEILING(emp_count.num_of_guest / 35)";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $tbl .= "<tr><th>event id</th><th>event date</th><th>chefs needed</th><th>waiters needed</th>
        </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr><td>" . $row["event_id"] . "</td><td>" . $row["event_date"] . "</td><td>" . $row["chefs_needed"] . "</td><td>" . $row["waiters_needed"] . "</td></tr>";
    }
} else if ($option == 4) {
    $query = "SELECT p.person_id, p.first_name, p.last_name, COUNT(ec.person_id) AS num_of_events FROM team15_Person AS p INNER JOIN team15_Person_Type AS ptype ON p.person_type_id = ptype.person_type_id INNER JOIN team15_Event_Customer AS ec ON p.person_id = ec.person_id GROUP BY p.first_name , p.last_name HAVING num_of_events > 1";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }

    $tbl .= "<tr><th>person id</th><th>first name</th><th>last name</th><th>occouring events</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr><td>" . $row["person_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["num_of_events"] . "</td></tr>";
    }
} else if ($option == 5) {
    $query = "SELECT ev.event_id, SUM(ev.price) AS incomes FROM team15_Event AS ev WHERE ev.event_date >= DATE_SUB(CURDATE(), INTERVAL " . $numOfMonths . " MONTH) AND ev.event_date < CURDATE()";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }

    $tbl .= "<tr><th>incomes</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $tbl .= "<tr><td>" . $row["incomes"] . "</td></tr>";
    }
} else if ($option == 6) {
    // duplicate key
    $checkQ = 'SELECT * FROM dbCourseSt23.team15_Event_Employee as ee INNER JOIN team15_Employee as e WHERE NOT(e.employee_type_id = 1)';
    $resultQ = mysqli_query($connection, $checkQ);
    if (!$resultQ) {
        die("DB query failed.");
    }
    while ($rowQ = mysqli_fetch_assoc($resultQ)) {
        if (($rowQ['event_id'] == $eveID6) && ($rowQ['employee_id'] == $empId6)) {
            $dupKey = 1;
        }
    }
    if (!$resultQ) {
        die("DB query failed.");
    }
    // employee exists
    $empCheck = 'SELECT * FROM team15_Employee WHERE employee_id='.$empId6;
    $resultEmp = mysqli_query($connection, $empCheck);
    if (!$resultEmp) {
        die("DB query failed.");
    }
    if ($resultEmp && mysqli_num_rows($resultEmp) == 0) {
        $empCheck = 1;
    }

    // Event Exists
    $evQuer = 'select * from team15_Event where event_id=' . $eveID6;
    $resultEv = mysqli_query($connection, $evQuer);
    if (!$resultEv) {
        die("DB query failed.");
    }
    if ($resultEv && mysqli_num_rows($resultEv) == 0) {
        $evCheck = 1;
    }

    if ($dupKey == 1) {
        $tbl .= "<tr><th>Notice</th></tr>";
        $tbl .= "<tr><td>Employee already has a shift for this event.</td></tr>";
    } else if ($empCheck == 1) {
        $tbl .= "<tr><th>Notice</th></tr>";
        $tbl .= "<tr><td>Employee Doesn't Exist.</td></tr>";
    } else if ($evCheck == 1) {
        $tbl .= "<tr><th>Notice</th></tr>";
        $tbl .= "<tr><td>Event Doesn't Exist.</td></tr>";
    } else {
        $query = 'call team15_add_employee_into_team (' . $eveID6 . ', ' . $empId6 . ')';

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr><th>Notice</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr><td>" . $row['message'] . "</td></tr>";
        }
    }

} else if ($option == 7) {
    $checkQ = 'select * from team15_Event where event_id=' . $eveID7 . ';';
    $resultQ = mysqli_query($connection, $checkQ);
    if (!$resultQ) {
        die("DB query failed.");
    }
    if ($resultQ && mysqli_num_rows($resultQ) > 0) {
        $query = 'call team15_percentage_discount  (' . $eveID7 . ', ' . $perc . ')';
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("DB query failed.");
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr><th>Notice</th></tr><tr><td>" . $row['message'] . "</td></tr>";
        }
    } else {
        $tbl .= "<tr><th>message</th></tr><tr><td>Event id isn't in our records</td></tr>";
        $evCheck++;
    }
} else {
    $checkQ = "SELECT * FROM team15_Person AS per INNER JOIN team15_Employee AS emp ON per.person_id = emp.person_id WHERE per.first_name = '" . $fname . "' AND per.last_name = '" . $lname . "' AND emp.employee_type_id = '1';";
    $resultQ = mysqli_query($connection, $checkQ);
    if (!$resultQ) {
        die("DB query failed.");
    }
    if ($resultQ && mysqli_num_rows($resultQ) > 0) {
        $query = 'select team15_calc_sales("' . $fname . '", "' . $lname . '", "' . $month . '", "' . $year . '") AS sales';
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("DB query failed.");
        }

        $tbl .= "<tr><th>Sales</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $tbl .= "<tr><td>" . $row["sales"] . "</td></tr>";
        }
    } else {
        $tbl .= "<tr><th>message</th></tr><tr><td>The employee isn't a salesman</td></tr>";
        $notSaleman = 1;
    }
}

$tbl .= " </table>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- JQuary -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Data table  -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> -->
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Adi and Moran dbCourse Project</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=NTR&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <header>
            <section>
                <a href="index.php" id="logo"></a>
            </section>
            <section>
                <img src="images/user.png" alt="profile">
            </section>
        </header>
        <section id="liner">
        </section>
        <main>
            <div>
                <h1>Result</h1>
                <div id="result">
                    <?php
                    echo $tbl;
                    ?>
                </div>
            </div>
        </main>
    </div>
    <?php
    if ($option == 6) {
        if ($dupKey == 0 && $empCheck == 0 && ($evCheck == 0)) {
            mysqli_free_result($result);
        }
    } else if ($option == 7) {
        if ($evCheck == 0) {
            mysqli_free_result($result);
        }
    } else if ($option == 8) {
        if ($notSaleman == 0) {
            mysqli_free_result($result);
        }
    } else {
        mysqli_free_result($result);
    }
    if ($option == 7) {
        if ($sale == 1) {
            mysqli_free_result($resultPast);
            mysqli_free_result($resultAfter);
        }
    }
    ?>
</body>

</html>
<?php
mysqli_close($connection);
?>