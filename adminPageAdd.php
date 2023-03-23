<?php
    $connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
    $connection->query("SET NAMES utf8");

    if (!$connection)
    {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $numOrDen;
        $selectTime = mysqli_real_escape_string($connection, $_POST['selectTime']);
        $subjectID = mysqli_real_escape_string($connection, $_POST['selectSubject']);
        $lessonTypeID = mysqli_real_escape_string($connection, $_POST['selectType']);
        $groupNumber = mysqli_real_escape_string($connection, $_POST['groupNumber']);
        $selectDay = mysqli_real_escape_string($connection, $_POST['selectDay']);
        $start = mysqli_real_escape_string($connection, $_POST['start']);
        $end = mysqli_real_escape_string($connection, $_POST['end']);
        $selectNumOrDen = mysqli_real_escape_string($connection, $_POST['selectNumOrDen']);
        if ($selectNumOrDen == 0) 
        {
           $numOrDen = '0';
        }
        else
        {
           $numOrDen = '1';
        }
    
        $result = $connection->query("INSERT INTO `Shedule` (`PairNumber`, `SubjectID`, `LessonTypeID`, `GroupNumber`, `SubjectStartDate`, `SubjectEndDate`, `NumeratorOrDenominator`, `DayOfTheWeek`) VALUES ('$selectTime', '$subjectID', '$lessonTypeID', '$groupNumber', '$start', '$end', '$numOrDen', '$selectDay');");
        if ($result == false) {
            $errors['insert'] = 'Данный предмет с таким типом и временем уже имеется в расписании';
        }  
        else {
            $errors['insert'] = NULL;
            header('Location: adminPageAdd.php');
        }
        
    }

     
     $userId = mysqli_real_escape_string($connection, $_COOKIE['userId']);
	
		$result = $connection->query("SELECT Role FROM `users` WHERE `id` = '$userId'");
        $roleId = $result->fetch_assoc()['Role'];

        if (!isset($roleId) || $roleId == 0)
        {
            header('Location: /');
        }
 
     $result = $connection->query("SELECT * FROM `ClassTime`");

     $resultType = $connection->query("SELECT * FROM `LessonTypes`");

     $resultSubjects = $connection->query("SELECT * FROM `Subjects`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Добавление предмета в расписание</title>
</head>
<body onload="loadPage()">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="adminPage.php">Главная</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="adminPageAdd.php">Добавление предмета в расписание<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminPageAddSubject.php">Добавление предмета<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="exit.php">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Выйти</button>
    </form>
  </div>
</nav>
<div class="container mt-4 col-10">
        <div class="row">
            <div class="col">
                <h1 class="d-flex justify-content-center">Добавление предмета в расписание</h1>
<form name="form" method="post" onsubmit="return validateAddScheludeForm()">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Название дисциплины</label>
            <div class="col-sm-4">
            <select name="selectSubject" class="form-control">
                <?php while ($row = $resultSubjects->fetch_assoc()) :?>
                    <option value="<?=$row['SubjectID']?>"><?=$row['SubjectName']?></option>
                <?php endwhile; ?>
                </select>
            </div>

            <div class="col-sm-4">
                <input class="form-control" onchange="updateSelect(value)" placeholder="Фильтр..."/>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">День недели</label>
            <div class="col-sm-4">
            <select name="selectDay" class="form-control">
            <option value="1">Понедельник</option>
            <option value="2">Вторник</option>
            <option value="3">Среда</option>
            <option value="4">Четверг</option>
            <option value="5">Пятница</option>
            <option value="6">Суббота</option>
        </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Расположение</label>
            <div class="col-sm-4">
            <select name="selectNumOrDen" class="form-control">
                <option value="0">Числитель</option>
                <option value="1">Знаменатель</option>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Тип пары</label>
            <div class="col-sm-4">
            <select name="selectType" class="form-control">
            <?php while ($row = $resultType->fetch_assoc()) :?>
                <option value="<?=$row['LessonTypeID']?>"><?=$row['LessonType']?></option>
            <?php endwhile; ?>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Время</label>
            <div class="col-sm-4">
            <select name="selectTime" class="form-control">
            <?php while ($row = $result->fetch_assoc()) :?>
                <option value="<?=$row['PairNumber']?>"><?=$row['StartLesson']?> - <?=$row['EndLesson']?></option>
            <?php endwhile; ?>
            </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Группа</label>
            <div class="col-sm-4">
            <input name="groupNumber" placeholder="Введите номер группы..." class="form-control"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Время старта в семестре</label>
            <div class="col-sm-4">
            <input type="date" name="start"/>
        <input type="date" name="end"/>
            </div>
        </div>
        <?php if (isset($errors['insert'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errors['insert'] ?>
                        </div>
						<?php endif; ?>
        <div id="groupError" class="alert alert-danger">
					
		</div>
        <button type="submit" class="btn btn-outline-primary">Добавить</button>
        </form>
        </div>
        </div>
    </div>
</div>
        

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/adminPageAdd.js"></script>
</body>
</html>