<?php 

include("../header.php"); 

$id = (int)$_GET['id'];
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
                <h1 class="display-1">Knygos "<?php echo $bookData['title']; ?>" informacija</h1>
                <p class="lead">Informacija apie knygą</p>
            </div>
        </div>
    </div>
</header>

<div class="content pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <p><strong>Knygos pavadinimas: </strong> <?php echo $bookData['title']; ?></p>
                <p><strong>Autorius: </strong> <?php echo $bookData['author']; ?></p>
                <p><strong>Puslapių sk.: </strong> <?php echo $bookData['pages']; ?></p>
                <p><strong>Kaina: </strong> <?php echo $bookData['price']; ?></p>
                <p>
                    <a href="update.php?id=<?php echo $id; ?>" class="btn btn-warning">Atnaujinti</a>
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Šalinti</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php

} else {
    header("Location: index.php");
}

include("../footer.php");