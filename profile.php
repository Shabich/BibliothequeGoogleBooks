<?php
include_once "header.php"
?>
<?php
include 'config.php';
?>
                <li><a href="mainsearch.php">Rechercher</a></li>

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


$stmt_books = $pdo->prepare("SELECT * FROM books");
$stmt_books->execute();
$favorite_books = $stmt_books->fetchAll();
?>



<h2>Profil de <?php echo $user['username']; ?></h2>

<p>Email: <?php echo $user['email']; ?></p>

<a href="logout.php">Déconnexion</a>

<a href="mainsearch.php">Faire mes recherches</a>

<h2> <button onclick="toggleFavorites()">Favoris</button></h2>
<div id="favorites" class="results-grid" style="none">
    <?php foreach ($favorite_books as $book): ?>
        <div class="book-item">
            <h3><?php echo $book['title']; ?></h3>
            <img src="<?php echo $book['thumbnail']; ?>" alt="<?php echo $book['title']; ?>" class="book-thumbnail">
            <p>Auteur(s): <?php echo $book['authors']; ?></p>
            
        </div>
    <?php endforeach; ?>
</div>


<?php
include_once "footer.php"
?>
