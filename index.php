<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- JQuary -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Adi and Moran dbCourse Project</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <header>
            <section>
                <a href="bookList.php" id="logo"></a>
            </section>
            <section id="selectSec">
            </section>
            <section>
                <img src="images/user.png" alt="profile">
            </section>
        </header>
        <section id="liner">
        </section>
        <main>
            <div>
                <h1>Book List</h1>
                <ul id="flexList">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li class="bookFlex" data-id="' .$row["book_id"] . '">
                                <div class="book">
                                        <a href="book.php?bookId=' . $row["book_id"] . '"><img src="' . $row["cover_url"] . '" alt="' . $row["book_name"] . '"></a>
                                </div>
                                <div class="title">
                                    <h3><a href="book.php?bookId=' . $row["book_id"] . '">' . $row["book_name"] . '</a></h3>
                                    <h5><a href="book.php?bookId=' . $row["book_id"] . '">' . $row["author"] . '</a></h5>
                                </div>
                            </li>';
                    }
                    ?>
                        <?php
                    mysqli_free_result($result);
                    ?>
                </ul>
            </div>
        </main>
    </div>
</body>

</html>