<?php
    class scheduleDay
    {
        private $days = [1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четверг', 5 => 'Пятница', 6 => 'Суббота'];
        public $subjects;
        function __construct($day) {
            $this->subjects = array();
            $this->day = $day;
            $this->textDay = $this->days[$this->day];
        }
    }

    
?>