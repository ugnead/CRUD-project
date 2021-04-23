<?php.

include("../header.php");

$sql = "SELECT `id`, `title`, `author`, `pages`, `price` FROM `books`";
// $sql = "SELECT * FROM `books` WHERE id=5555";
$result = $conn->query($sql);

?>

<header class="bg-light text-dark pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-1">Knygos</h1>
                <p class="lead">Visos suvestos knygos</p>
            </div>
        </div>
    </div>
</header>

<div class="content pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <p><a href="new.php" class="btn btn-success">Nauja knyga</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                    if ($result->num_rows > 0) {
                ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pavadinimas</th>
                                <th scope="col">Autorius</th>
                                <!-- <th scope="col">Žanras</th> -->
                                <th scope="col">Puslapių sk.</th>
                                <th scope="col">Kaina, €</th>
                                <th scope="col">Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($bookData = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $bookData['id']; ?></th>
                                    <td><?php echo $bookData['title']; ?></td>
                                    <td><?php echo $bookData['author']; ?></td>
                                    <!-- <td>Stulpelis</td> -->
                                    <td><?php echo $bookData['pages']; ?></td>
                                    <td><?php echo $bookData['price']; ?></td>
                                    <td>
                                        <a href="view.php?id=<?php echo $bookData['id']; ?>" class="btn btn-primary">Žiūrėti</a>
                                        <a href="update.php?id=<?php echo $bookData['id']; ?>" class="btn btn-warning">Atnaujinti</a>
                                        <a href="delete.php?id=<?php echo $bookData['id']; ?>" class="btn btn-danger">Šalinti</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                    } else {
                        echo "<p>Kol kas nėra įvestų knygų.</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php

include("../footer.php");
