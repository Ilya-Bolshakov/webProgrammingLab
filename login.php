<?php
if (isset($_COOKIE['userId']) == 1)
{
	header('Location: /');
}

	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
		$connection->query("SET NAMES utf8");

		if (!$connection)
		{
			die("Ошибка подключения: " . mysqli_connect_error());
		}
	
		$login = mysqli_real_escape_string($connection, $_POST["login"]);
		$pass = mysqli_real_escape_string($connection, $_POST["pass"]);
		
		
	
		// Хешируем пароль
		$pass = md5($pass);
	
		$result = $connection->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
		
		if ($result->num_rows == 0)
		{
			
			$errors['login'] = "Логин или пароль введены неверно.";
			$connection->close();
		}
		else
		{
			$user = $result->fetch_assoc();
		    setcookie('userId', $user['id'], time() + 3600, "/"); //куки на час
			header('Location: /');
			$connection->close();
		}
	}
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Вход</title>
</head>
<body>  
    <div class="container mt-4 col-4">
        <div class="row">
            <div class="col">
                <h1 class="d-flex justify-content-center">Вход</h1>
                <form method="post">
                    <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
                    <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
                    <button class="btn btn-success btn-lg btn-block">Войти</button><br>
					<?php if (isset($errors['login'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errors['login'] ?>
                        </div>
						<?php endif; ?>
                </form>
				<div class="container row">
					<h3>
						Впервые здесь?
						<button type="button" onclick="location.href='register.php'" class="btn btn-link">Регистрация</button>
					</h3>
				</div>
            </div>
        </div>
    </div>


	<script src="scripts/checkCookie.js"></script>
</body>
</html>