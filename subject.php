<?php
    class subject
    {
        function __construct($cursor)
        {
            $this->pairNumber = $cursor['PairNumber'];
            $this->subjectName = $cursor['SubjectName'];
            $this->lessonType = $cursor['LessonType'];
            $this->numOrDen = $cursor['NumeratorOrDenominator'];
        }
    }
?>