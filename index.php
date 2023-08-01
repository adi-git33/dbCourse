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
                <h1>Queries, Procedures and Functions</h1>
                <ul id="QPF">
                    <li>1. Display events from the past x weeks.</li>
                    <li>2. Display future events and the costumer who made the event order.</li>
                    <li>3. Display events that are short on Waiters or Chefs.</li>
                    <li>4. Display customers who made more then one order.</li>
                    <li>5. Display incomes from the past x months.</li>
                    <li>6. Schedule employee to event.</li>
                    <li>7. Give event price percentage discount.</li>
                    <li>8. Display incomes for specific salesman in x month.</li>
                </ul>
                <form action="result.php" id="frm">
                    <select class="form-select form-select-lg" aria-label="Large select example" data-bs-theme="dark"
                        name="qSelect" id="querSel">
                        <option selected disabled>Select Option</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    <div class="mb-3" id="pastEv">
                        <label>Choose number of weeks</label>
                        <input type="number" class="form-control form-control-lg" placeholder="Number of weeks"
                            data-bs-theme="dark" min="1" max="104" name="numOfWeeks">
                    </div>
                    <div class="mb-3" id="incomes">
                        <label>Choose number of months</label>
                        <input type="number" class="form-control form-control-lg" placeholder="Number of months"
                            data-bs-theme="dark" min="1" max="48" name="numOfMonths">
                    </div>
                    <div class="mb-3" id="insertEmp">
                        <label>Enter Event ID</label>
                        <input type="number" class="form-control form-control-lg" placeholder="1" data-bs-theme="dark"
                            name="eveIDSix" min="1" max="10">
                        <label>Enter Employee ID</label>
                        <input type="number" class="form-control form-control-lg" placeholder="1" data-bs-theme="dark"
                            name="empIDSix" min="1" max="10">
                    </div>
                    <div class="mb-3" id="discount">
                        <label for="">Enter Event ID</label>
                        <input type="number" class="form-control form-control-lg" placeholder="1" data-bs-theme="dark"
                            name="eveIDSeven" min="1" max="10"> 
                        <label for="">Enter percentage in float form</label>
                        <input type="number" class="form-control form-control-lg" placeholder="0.2" data-bs-theme="dark"
                            name="percent" min="1" max="10">
                    </div>
                    <div class="mb-3" id="saleIncome">
                        <label>Enter Salesman First Name</label>
                        <input type="test" class="form-control form-control-lg" placeholder="First Name"
                            data-bs-theme="dark" name="fname">
                        <label>Enter Salesman Last Name</label>
                        <input type="test" class="form-control form-control-lg" placeholder="Last Name"
                            data-bs-theme="dark" name="lname">
                        <label>Enter Month</label>
                        <input type="number" class="form-control form-control-lg" placeholder="Month"
                            data-bs-theme="dark" min="1" max="12" name="monthsEight">
                        <label>Enter Year</label>
                        <input type="number" class="form-control form-control-lg" placeholder="Year" data-bs-theme="dark" name="yearEight" min="2023" max="2024">
                    </div>
                    <input type="submit" value="Submit Choice" id="submitBtn">
                </form>
                <div id="result">
                </div>
            </div>
        </main>
    </div>
</body>

</html>