<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submissions</title>
    
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/assignment_manager.css">
</head>
<body>

    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>


    <div class="submission-container">
        
        <div class="header-area">
            <h2>Assignment Submissions</h2>
            <span class="badge-count">
                Total: <strong><?= !empty($data['assignmentsSubmissions']) ? count($data['assignmentsSubmissions']) : 0 ?></strong>
            </span>
        </div>

        <?php if (!empty($data['assignmentsSubmissions'])): ?>
            <table class="sub-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Details</th>
                        <th>Submitted Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['assignmentsSubmissions'] as $index => $sub): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            
                            <td>
                                <div style="font-weight:bold; color:#333;">
                                    <?= htmlspecialchars($sub->student_name ?? 'Unknown Student') ?>
                                </div>
                                <div style="font-size:0.85rem; color:#666;">
                                    <?= htmlspecialchars($sub->student_email ?? '') ?>
                                </div>
                            </td>

                            <td>
                                <?= date('M d, Y • h:i A', strtotime($sub->created_at)) ?>
                            </td>

                            <td>
                                <?php if (!empty($sub->file_path)): ?>
                                    <a href="<?= ROOT ?>/uploads/assignments/<?= htmlspecialchars($sub->file_path) ?>" 
                                       class="btn-download" 
                                       download>
                                       Download File
                                    </a>
                                <?php else: ?>
                                    <span class="no-file">No File Uploaded</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>No submissions found</h3>
                <p>Students have not uploaded any work for this assignment yet.</p>
            </div>
        <?php endif; ?>

    </div>

<?php include __DIR__.'/Component/footer.view.php'; ?>
</body>
</html>