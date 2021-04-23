<?php 

include("../header.php");

$id = (int)$_GET['id'];
 // echo $id;

$errors = array();

if (empty($_POST) === false) {

    $title = $_POST['nameInput'];
    $author = $_POST['authorInput'];
    $pages = $_POST['pagesInput'];
    $price = $_POST['priceInput'];

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
    
        $sql = "UPDATE `books` 
                SET `title` = '$title', 
                    `author` = '$author', 
                    `pages` = '$pages', 
                    `price` = '$price' 
                WHERE `books`.`id` = $id";
        //echo $sql;

        $conn->query($sql);
        header("Location: view.php?id=" . $id);
    }

}

//$id = (int)$_GET['id'];
 // echo $id;

$sql = "SELECT `title`, `author`, `pages`, `price` 
        FROM `books` 
        WHERE id=$id";

 // echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $bookData = $result->fetch_assoc();

?>

<header class="bg-light text-dark pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-1">Atnaujinti knygą: <?php echo $bookData['title']; ?></h1>
                <p class="lead">Atnaujinkite pasirinktos knygos informaciją</p>
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
                <form action="update.php?id=<?php echo $id; ?>" method="post">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Knygos pavadinimas</label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?php echo $bookData['title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="authorInput" class="form-label">Autorius</label>
                        <input type="text" class="form-control" id="authorInput" name="authorInput" value="<?php echo $bookData['author']; ?>">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="genreInput" class="form-label">Žanras</label>
                        <input type="text" class="form-control" id="genreInput" value="Fantastika">
                    </div> -->
                    <div class="mb-3">
                        <label for="pagesInput" class="form-label">Puslapių sk.</label>
                        <input type="number" class="form-control" id="pagesInput" name="pagesInput" value="<?php echo $bookData['pages']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="priceInput" class="form-label">Kaina, €</label>
                        <input type="text" class="form-control" id="priceInput" name="priceInput" value="<?php echo $bookData['price']; ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Atnaujinti knygą</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

} else {
    header("Location: index.php");
}

include("../footer.php");