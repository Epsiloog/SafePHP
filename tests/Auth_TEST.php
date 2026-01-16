<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use SafePHP\Auth;

    if(isset($_POST["login_test"])) {
        $name = $_POST["pseudo"];
        $password = $_POST["password"];
        Auth::login($name, $password);
    } else if(isset($_POST["register_test"])) {
        //Auth::register();
        return;
    }
?>

<div class="main-container-auth-test">
    <div class="login-test-container">
        <h2>Login test</h2>
        <form action="" method="POST">
            <input type="text" name="pseudo" placeholder="Pseudo...">
            <input type="password" name="password">

            <button type="submit" name="login_test">
                Valider
            </button>
        </form>
    </div>

    <div class="register-test-container">
        <h2>Register test</h2>
        <form action="" method="POST">
            <button type="submit" name="register_test">
                Valider
            </button>
        </form>
    </div>
</div>