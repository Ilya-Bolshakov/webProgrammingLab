<?php
     $connection = mysqli_connect("server42.hosting.reg.ru", "u1960216_default", "X6z7Y08TBcsaxY3I", "u1960216_webprogrammingrsreu");
     $connection->query("SET NAMES utf8");

     if (!$connection)
     {
         die("Ошибка подключения: " . mysqli_connect_error());
     }

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
 
     $result = $connection->query("INSERT INTO `Shedule` (`PairNumber`, `SubjectID`, `LessonTypeID`, `GroupNumber`, `SubjectStartDate`, `SubjectEndDate`, `NumeratorOrDenominator`, `DayOfTheWeek`) VALUES ('$selectTime', '$subjectID', '$lessonTypeID', '$groupNumber', '$start', '2023-04-01', '$numOrDen', '$selectDay');");     
     header('Location: adminPage.php');
?>