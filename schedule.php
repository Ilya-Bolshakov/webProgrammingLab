<?php
    require_once 'subject.php';
    require_once 'scheduleDay.php';

    $connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
    $connection->query("SET NAMES utf8");

    if (!$connection)
    {
        die("Ошибка подключения: " . mysqli_connect_error());
    }
    $userId = mysqli_real_escape_string($connection, $_COOKIE['userId']);
   
       $result = $connection->query("SELECT Role, student_group FROM `users` WHERE `id` = '$userId'");
       $user = $result->fetch_assoc();
       $roleId = $user['Role'];

       if (isset($roleId))
        {
            if ($roleId == 1) {
                header('Location: /');
            }
        }


        $groupNumber = mysqli_real_escape_string($connection, $user['student_group']);

        /*
         SELECT DayOfTheWeek, Shedule.PairNumber, Subjects.SubjectName, LessonTypes.LessonType, ClassTime.StartLesson, ClassTime.EndLesson, Shedule.NumeratorOrDenominator from Shedule 
         join ClassTime on ClassTime.PairNumber = Shedule.PairNumber
         join Subjects on Subjects.SubjectID = Shedule.SubjectID
         join LessonTypes on LessonTypes.LessonTypeID = Shedule.LessonTypeID
         where GroupNumber = 940 
         and now() BETWEEN SubjectStartDate 
         ANd SubjectEndDate order by DayOfTheWeek, Shedule.PairNumber
        */

        $schedule = array();

        $result = $connection->query("SELECT DayOfTheWeek, Shedule.PairNumber, Subjects.SubjectName, LessonTypes.LessonType, ClassTime.StartLesson, ClassTime.EndLesson, Shedule.NumeratorOrDenominator 
        from Shedule
        join ClassTime on ClassTime.PairNumber = Shedule.PairNumber
        join Subjects on Subjects.SubjectID = Shedule.SubjectID
        join LessonTypes on LessonTypes.LessonTypeID = Shedule.LessonTypeID
        WHERE GroupNumber = '$groupNumber' and now() BETWEEN SubjectStartDate and SubjectEndDate
        order by DayOfTheWeek, Shedule.PairNumber");

        while ($row = $result->fetch_assoc()) 
        {
            if ($schedule[$row['DayOfTheWeek']] == NULL)
            {
                $schedule[$row['DayOfTheWeek']] = new scheduleDay($row['DayOfTheWeek']);
            }
            array_push($schedule[$row['DayOfTheWeek']]->subjects, new subject($row));
        }

        echo '<pre>';
print_r($schedule);
echo '</pre>';
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
                    <th scope="col">День</th>
                    <th scope="col">Время</th>
                    <th scope="col">Числитель</th>
                    <th scope="col">Знаменатель</th>
                    
                </tr>
            </thead>
        <tbody>
            <tr>
            <th scope="row" rowspan="5">Понедельник</th>
            <td>8:10-9:45</td>
            <td>
                Программирование. Лекция<br>
                
            </td>
            <td>
                Математика
            </td>
            </tr>

            
            <tr>
            <th scope="row">9:45-11:30</th>
            <td>Mark</td>
            <td>Otto</td>
            </tr>

        </tbody>
</table>

    </div>


    
    
    
    
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>