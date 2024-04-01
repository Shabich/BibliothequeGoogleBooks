<?php
include_once "header.php"
?>
                
                <li><a href="login.php">Login</a></li>
                </ul>
</nav>
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    try {
        $stmt->execute([$username, $email, $password]);
        echo "Inscription réussie.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<h2>Inscription</h2>

<form action="signup.php" method="post">
    <div>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="S'inscrire">
    </div>
</form>



<?php
include_once "footer.php"
?>