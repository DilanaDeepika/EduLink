<?php

class MarkingPanel extends Model
{
    protected $table = 'marking_panel';

    // Validation rules
    protected $rules = [
        'class_id' => 'required|integer',
        'student_id' => 'required|integer',
        'appointed_date' => 'required|date',
        'approval_status' => 'in:pending,approved,rejected',
    ];
        

    // Allowed columns for insert/update
    protected $allowedColumns = [
        'class_id',
        'student_id',
        'appointed_date',
        'approval_status',
        
    ];

    public function getPanelMembersByClass($class_id)
    {
    $sql = "
        SELECT 
            mp.*,
            s.first_name,
            s.last_name,
            s.phone_number,
            a.email
        FROM {$this->table} mp
        JOIN students s ON mp.student_id = s.student_id
        JOIN accounts a ON s.account_id = a.account_id
        WHERE mp.class_id = :class_id
    ";

    return $this->query($sql, ['class_id' => $class_id]);
}

// Count approved panel assignments for a student
public function countPanelsByStudent($student_id)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM {$this->table}
        WHERE student_id      = :student_id
          AND approval_status = 'approved'
    ";

    $result = $this->query($sql, ['student_id' => $student_id]);
    return (int)($result[0]->total ?? 0);
}

public function getPanelSummaryByStudent(int $student_id): object
{
    $sql = "
        SELECT 
            COALESCE(SUM(papers_per_member), 0)                    AS total_papers_marked,
            COALESCE(SUM(papers_per_member * marking_fee), 0)      AS total_income
        FROM (
            SELECT
                FLOOR(
                    COUNT(pm.mark_id)
                    /
                    (
                        SELECT COUNT(panel_member_id)
                        FROM marking_panel mp2
                        WHERE mp2.class_id        = p.class_id
                          AND mp2.approval_status = 'approved'
                    )
                )              AS papers_per_member,
                c.marking_fee  AS marking_fee

            FROM paper_marks pm
            JOIN papers p  ON pm.paper_id = p.paper_id
            JOIN classes c ON p.class_id  = c.class_id
            JOIN {$this->table} mp
                ON mp.class_id         = p.class_id
                AND mp.student_id      = :student_id
                AND mp.approval_status = 'approved'

            GROUP BY pm.paper_id, p.class_id, c.marking_fee

        ) AS per_paper_summary
    ";

    $result = $this->query($sql, ['student_id' => $student_id]);
    return $result[0] ?? (object)[
        'total_papers_marked' => 0,
        'total_income'        => 0,
    ];
}

    // Get all panel classes for a student with class + teacher + institute info
    public function getPanelClassesByStudent(int $student_id): array
    {
        $sql = "
            SELECT
                mp.panel_member_id,
                mp.class_id,
                mp.appointed_date,
                mp.approval_status,
                c.class_name,
                c.grade_level_name,
                c.marking_fee,
                CONCAT(t.first_name, ' ', t.last_name) AS teacher_name,
                COALESCE(i.institute_name, 'Individual Teacher') AS institute_name
            FROM {$this->table} mp
            JOIN classes c      ON mp.class_id  = c.class_id
            JOIN teachers t     ON c.teacher_id = t.teacher_id
            LEFT JOIN institutes i ON c.institute_id = i.institute_id
            WHERE mp.student_id      = :student_id
              AND mp.approval_status = 'approved'
            ORDER BY mp.appointed_date DESC
        ";

        return $this->query($sql, ['student_id' => $student_id]) ?: [];
    }

    public function getIncomeByClassForStudent(int $student_id): array
    {
        $sql = "
            SELECT
                c.class_name,
                COALESCE(SUM(
                    FLOOR(
                        paper_submissions.submission_count
                        /
                        (
                            SELECT COUNT(panel_member_id)
                            FROM marking_panel mp2
                            WHERE mp2.class_id        = c.class_id
                              AND mp2.approval_status = 'approved'
                        )
                    ) * c.marking_fee
                ), 0) AS class_income

            FROM {$this->table} mp
            JOIN classes c ON mp.class_id = c.class_id

            LEFT JOIN (
                SELECT
                    p.class_id,
                    pm.paper_id,
                    COUNT(pm.mark_id) AS submission_count
                FROM paper_marks pm
                JOIN papers p ON pm.paper_id = p.paper_id
                GROUP BY p.class_id, pm.paper_id
            ) paper_submissions ON paper_submissions.class_id = c.class_id

            WHERE mp.student_id      = :student_id
              AND mp.approval_status = 'approved'

            GROUP BY c.class_id, c.class_name, c.marking_fee
            ORDER BY class_income DESC
        ";

        return $this->query($sql, ['student_id' => $student_id]) ?: [];
    }
}
    