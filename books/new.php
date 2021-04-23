<?php 

include("../header.php");

$errors = array();

if (empty($_POST) === false) {
    //print_r($_POST);
    //echo "<br>";

    $title = $_POST['nameInput'];
    $author = $_POST['authorInput'];
    $pages = $_POST['pagesInput'];
    $price = $_POST['priceInput'];

    //echo "title: $title, author: $author, pages: $pages, price: $price";

    // if (empty($title) || empty($author) || empty($pages) || empty($price)) {
    //     array_push($errors, 'Visi laukeliai turi būti suvesti.');
    // } 

    if (empty($title)) {
        array_push($errors, 'Knygos pavadinimas turi būti įvestas.');
    }
    if (empty($author)) {
        array_push($errors, 'Knygos autorius turi būti įvestas.');
    }
    if (empty($pages)) {
        array_push($errors, 'Knygos puslapių kiekis turi būti įvestas.');
    }
    if ($pages < 0) {
        array_push($errors, 'Knygos puslapių kiekis negali būti neigiamas.');
    }
    if (empty($price)) {
        array_push($errors, 'Knygos kaina turi būti įvesta.');
    }
    if ($price < 0) {
        array_push($errors, 'Knygos kaina negali būti neigiamas skaičius.');
    }
    
    if (count($errors) == 0) {
        $sql = "INSERT INTO `books`(`title`, `author`, `pages`, `price`) 
                VALUES ('$title', '$author', $pages, $price)";
        //echo $sql;
        $conn->query($sql);
        header("Location: index.php");
    }

}

?>

<header class="bg-light text-dark pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-1">Nauja knyga</h1>
                <p class="lead">Sukurkite naują norimą knygą</p>
            </div>
        </div>
    </div>
</header>

<div class="content pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if(count($errors) > 0) { ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php
                                foreach($errors as $error) {
                                    echo "<li>$error</li>";
                                }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
                <form action="new.php" method="post">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Knygos pavadinimas</label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput">
                    </div>
                    <div class="mb-3">
                        <label for="authorInput" class="form-label">Autorius</label>
                        <input type="text" class="form-control" id="authorInput" name="authorInput">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="genreInput" class="form-label">Žanras</label>
                        <input type="text" class="form-control" id="genreInput">
                    </div> -->
                    <div class="mb-3">
                        <label for="pagesInput" class="form-label">Puslapių sk.</label>
                        <input type="number" class="form-control" id="pagesInput" name="pagesInput">
                    </div>
                    <div class="mb-3">
                        <label for="priceInput" class="form-label">Kaina, €</label>
                        <input type="text" class="form-control" id="priceInput" name="priceInput">
                    </div>
                    <button type="submit" class="btn btn-success">Sukurti knygą</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

include("../footer.php");