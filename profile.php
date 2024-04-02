<?php
include_once "header.php"
?>
<?php
include 'config.php';
?>
                <li><a href="mainsearch.php">Rechercher</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
                </ul>
</nav>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$stmt_books = $pdo->prepare(
    "SELECT books.id, books.title, books.authors,
    books.categories, books.thumbnail, books.description
    FROM books
    INNER JOIN users ON books.user_id = users.id
    WHERE users.id = ?"); 
$stmt_books->execute([$_SESSION['user_id']]);
$favorite_books = $stmt_books->fetchAll();
?>





<h2>Profil de <?php echo $user['username']; ?></h2>
<p>Email: <?php echo $user['email']; ?></p>


<h2> <button onclick="toggleFavorites()">Favoris</button></h2>
<div id="favorites" class="results-grid" style="flex">
    <?php foreach ($favorite_books as $book): ?>
        <div class="book-item" id="favorite-<?php echo $book['id']; ?>">
            <h3><?php echo $book['title']; ?></h3>
            <img src="<?php echo $book['thumbnail']; ?>" alt="<?php echo $book['title']; ?>" class="book-thumbnail">
            <p><?php echo $book['authors']; ?></p>
            <button onclick="deleteFavorite(<?php echo $book['id']; ?>)">Supprimer des favoris</button>
        </div>
    <?php endforeach; ?>
</div>

</div>


<?php
include_once "footer.php"
?>
