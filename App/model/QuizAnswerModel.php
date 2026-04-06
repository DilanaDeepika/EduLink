<?php
class QuizAnswerModel extends Model {
    protected $table = "quiz_student_answers"; 
    protected $allowedColumns = ['attempt_id', 'question_id', 'chosen_option_id'];
}