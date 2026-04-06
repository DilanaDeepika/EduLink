<?php

class QuizQuestionsModel extends Model
{
    protected $table = "quiz_questions";

    protected $allowedColumns = [
        'quiz_id',
        'question_text'
    ];

    protected $rules = [
        'quiz_id'       => 'required|numeric',
        'question_text' => 'required'
    ];

    // --- THIS IS THE FUNCTION YOUR CONTROLLER NEEDS ---
    public function getErrorAnalysis($quiz_id) {
        $query = "
            SELECT 
                qq.question_text,
                COUNT(ans.student_answer_id) as total_attempts,
                SUM(CASE WHEN qo.is_correct = 0 THEN 1 ELSE 0 END) as wrong_count
            FROM quiz_questions qq
            LEFT JOIN quiz_student_answers ans ON qq.question_id = ans.question_id
            LEFT JOIN quiz_options qo ON ans.chosen_option_id = qo.option_id
            WHERE qq.quiz_id = :qid
            GROUP BY qq.question_id
            HAVING total_attempts > 0
            ORDER BY wrong_count DESC
        ";

        return $this->query($query, ['qid' => $quiz_id]);
    }
}