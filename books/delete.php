<?php 

include("../header.php"); 

$id = (int)$_GET['id'];
// echo $id;

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    $sql = "DELETE FROM `books` 
            WHERE `books`.`id` = $id";
            //echo $sql;
            $conn->query($sql);
            header("Location: index.php");
}

$sql = "SELECT `title`
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
                <h1 class="display-1">Knygos "<?php echo $bookData['title']; ?>" šalinimas</h1>
                <p class="lead">Knygos šalinimas</p>
            </div>
        </div>
    </div>
</header>

<div class="content pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <p><strong>Ar tikrai norite šalinti šią knygą?</strong></p>
                <p>
                    <a href="delete.php?id=<?php echo $id; ?>&confirm=yes" class="btn btn-danger">Taip</a>
                    <a href="index.php" class="btn btn-light">Ne</a>
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