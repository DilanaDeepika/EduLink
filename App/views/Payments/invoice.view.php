<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice <?= htmlspecialchars($payment->invoice_number) ?></title>

    <!-- Invoice CSS -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/invoice.css">
</head>
<body>

<div class="invoice-box">

    <div class="invoice-header">
        <div class="brand">
            <h1>EduLink</h1>
            <p>Online Learning Platform</p>
        </div>

        <div class="invoice-info">
            <p><strong>Invoice #:</strong> <?= htmlspecialchars($payment->invoice_number) ?></p>
            <p><strong>Date:</strong> <?= date('M d, Y', strtotime($payment->paid_at)) ?></p>
        </div>
    </div>

    <div class="section">
        <h3>Billed To</h3>
        <p>
            <?= htmlspecialchars($student->first_name . ' ' . $student->last_name) ?><br>
            <?= htmlspecialchars($student->email) ?>
        </p>
    </div>

    <div class="section">
        <h3>Payment Details</h3>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($class->class_name ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($payment->payment_method) ?></td>
                    <td><?= ucfirst($payment->payment_status) ?></td>
                    <td>Rs. <?= number_format($payment->amount, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="total">
        <strong>Total Paid: Rs. <?= number_format($payment->amount, 2) ?></strong>
    </div>

    <div class="print-area">
        <button onclick="window.print()">Print / Save as PDF</button>
    </div>

</div>

</body>
</html>
