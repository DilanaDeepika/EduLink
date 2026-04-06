<?php
class StudentPaymentModel extends Model
{
    protected $table = 'student_payments';

    public $allowedColumns = [
        'payment_id',
        'enrollment_id',
        'student_id',
        'class_id',
        'invoice_number',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_reference',
        'paid_at',
        'created_at'
    ];
}
