<?php

class QuizAttemptModel extends Model {
    protected $table = "quiz_attempts";
    protected $allowedColumns = ['quiz_id', 'student_id', 'score', 'completed_at'];

    // Custom function to get student names and scores
    public function getLeaderboard($quiz_id) {
        $query = "
            SELECT s.first_name, s.last_name, qa.score, qa.completed_at 
            FROM quiz_attempts qa
            JOIN students s ON qa.student_id = s.student_id
            WHERE qa.quiz_id = :qid
            ORDER BY qa.score DESC
        ";
        
        return $this->query($query, ['qid' => $quiz_id]);
    }
}