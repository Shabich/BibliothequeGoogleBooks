<?php
include_once "header.php"
?>
                <li><a href="signup.php">Sign-up</a></li>
                
                </ul>
</nav>
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: profile.php');
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>



<h2>Connexion</h2>

<form action="login.php" method="post">
    <div>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>


<?php
include_once "footer.php"
?>
