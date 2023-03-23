<?php
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
	$connection->query("SET NAMES utf8");

    $login = mysqli_real_escape_string($connection, $_POST["login"]);
	$pass = mysqli_real_escape_string($connection, $_POST["pass"]);

	$name = mysqli_real_escape_string($connection, $_POST["name"]);
	$surname = mysqli_real_escape_string($connection, $_POST["surname"]);
	$patronymic = mysqli_real_escape_string($connection, $_POST["patronymic"]);
	$group = intval(mysqli_real_escape_string($connection, $_POST["group"]));
	
	$pass = md5($pass);

	$result = $connection->query("SELECT * FROM `users` WHERE `login` = '$login'");
	
    if($result->num_rows > 0)
    {
		$errors['register'] = "Данный логин уже используется!";
		$connection->close();
    }
	else
	{
		$connection->query("INSERT INTO `users` (`name`, `surname`, `patronymic`, `student_group`, `login`, `password`) VALUES ('$name', '$surname', '$patronymic', '$group', '$login', '$pass')");
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
	<script src="scripts/validateRegisterForm.js"></script>
    <title>Регистрация</title>
</head>
<body onload="loadPage()">  
    <div class="container mt-4 col-4">
        <div class="row">
            <div class="col">
                <h1 class="d-flex justify-content-center">Регистрация</h1>
                <form method="post" name="registerForm" onsubmit="return validateForm()">
					<input type="text" name="name" class="form-control" id="name" placeholder="Имя..."><br>
					<input type="text" name="surname" class="form-control" id="surname" placeholder="Фамилия..."><br>
					<input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Отчество..."><br>
					<input type="text" name="group" class="form-control" id="group" placeholder="Группа..."><br>
                    <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
                    <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Зарегистрироваться</button><br>
					<div id="groupError" class="alert alert-danger">
					
					</div>
					<?php if (isset($errors['register'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errors['register'] ?>
                        </div>
						<?php endif; ?>
                </form>
				<div class="container row">
					<h3>
						Уже есть аккаунт?
						<button type="button" onclick="location.href='login.php'" class="btn btn-link">Войти</button>
					</h3>
				</div>
            </div>
        </div>
    </div>
</body>
</html>