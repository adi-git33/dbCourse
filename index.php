<?php
include "db.php";

$query = 'SELECT * FROM portfolioSh.portfolio_AdiLevi ORDER BY "proj_id"';
$result = mysqli_query($connection, $query);
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
                <a href="bookList.php" id="logo"></a>
            </section>
            <section>
                <img src="images/user.png" alt="profile">
            </section>
        </header>
        <section id="liner">
        </section>
        <main>
            <div>
                <h1>Queries, Procedures and Functions</h1>
                <ol>
                    <li>Display events from the past x weeks.</li>
                    <li>Display future events and the costumer who made the event order.</li>
                    <li>Display events that are short on Waiters or Chefs.</li>
                    <li>Display customers who made more then one order.</li>
                    <li>Display incomes from the past x months.</li>
                    <li>Schedule employee to event.</li>
                    <li>Give event price percentage discount.</li>
                    <li>Display incomes for specific salesman in x month.</li>
                </ol>
                <form action="action.php">
                    <select class="form-select form-select-lg" aria-label="Large select example" data-bs-theme="dark" name="qSelect">
                        <option selected disabled>Select Query</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    <input type="submit" value="Submit Choice" id="submitBtn">
                </form>
            </div>
        </main>
    </div>
</body>

</html>