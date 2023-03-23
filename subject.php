<?php
    class subject
    {
        function __construct($cursor)
        {
            $this->pairNumber = $cursor['PairNumber'];
            $this->subjectName = $cursor['SubjectName'];
            $this->lessonType = $cursor['LessonType'];
            $this->numOrDen = $cursor['NumeratorOrDenominator'];
            $this->startLesson = $cursor['StartLesson'];
            $this->endLesson = $cursor['EndLesson'];
            $this->reduction = $cursor['reduction'];
        }

        public function getFormatString() {
            return $this->reduction . '. ' . $this->subjectName;
        }
    }
?>