<?php 
    $connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
    $connection->query("SET NAMES utf8");

    if (!$connection)
    {
        die("Ошибка подключения: " . mysqli_connect_error());
    }
    $userId = mysqli_real_escape_string($connection, $_COOKIE['userId']);
   
       $result = $connection->query("SELECT Role FROM `users` WHERE `id` = '$userId'");
       $roleId = $result->fetch_assoc()['Role'];

       if (isset($roleId))
        {
            if ($roleId == 1) {
                header('Location: /');
            }
        }

        $item = new Item;

        $timeLesson = $connection->query("SELECT StartLesson, EndLesson FROM `ClassTime`");
        $item->setTimeLesson($timeLesson);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Расписание</title>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="schedule.php">
                <img src="https://avatars.mds.yandex.net/i?id=75c6df9e78562d9b156df9de43be6bf33485687b-5233733-images-thumbs&n=13" width="30" height="30" class="d-inline-block align-top" alt="">
                Главная
            </a>
            <form class="form-inline my-2 my-lg-0" action="exit.php">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Выйти</button>
            </form>
        </nav>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">8:10 - 9:45</th>
                    <th scope="col">9:55 - 11:30</th>
                    <th scope="col">11:40 - 13:15</th>
                    <th scope="col">13:35 - 15:10</th>
                </tr>
            </thead>
        <tbody>
            <tr>
            <th scope="row">Понедельник</th>
            <td>
                <table class="table table-borderless">
                    <tr><td> gfhfgh <br> Лекция</td></tr>
                    <tr><td>знам. Математика</td></tr>
                </table>
            </td>


            <td>Otto</td>
            <td>@mdo</td>
            </tr>

            
            <tr>
            <th scope="row">Вторник</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@TwBootstrap</td>
            </tr>

        </tbody>
</table>

    </div>


    
    
    
    
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/checkCookie.js"></script>

  </body>
</html>