<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks - <?php echo $data['paper_name']; ?></title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    <link href="<?php echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
    
    <link href="<?php echo ROOT ?>/assets/css/student_marks.css" rel="stylesheet"/>
</head>
<body>

    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>

    <div class="marks-container">
        <div class="page-header">
            <h2>
                <i class="fa-solid fa-file-contract"></i> 
                <?php echo htmlspecialchars($data['paper_name']); ?>
            </h2>
            <span class="badge-count">
                <?php echo count($data['student_marks']); ?> Students
            </span>
        </div>

        <div class="table-wrapper">
            <?php if (!empty($data['student_marks'])): ?>
                <table class="marks-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Marks Obtained</th>
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['student_marks'] as $mark): ?>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-user-graduate" style="color: #ccc; margin-right:8px;"></i>
                                    ID: <?php echo htmlspecialchars($mark->student_id); ?>
                                </td>
                                
                                <td>
                                    <span class="score <?php echo ($mark->marks_obtained >= 40) ? 'high' : 'low'; ?>">
                                        <?php echo htmlspecialchars($mark->marks_obtained); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($mark->marks_obtained >= 40): ?>
                                        <span style="color: #2ecc71; font-weight:bold; font-size:0.9rem;">
                                            <i class="fa-solid fa-check-circle"></i> Pass
                                        </span>
                                    <?php else: ?>
                                        <span style="color: #e74c3c; font-weight:bold; font-size:0.9rem;">
                                            <i class="fa-solid fa-circle-xmark"></i> Fail
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">
                    <i class="fa-solid fa-clipboard-question" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <p>No marks recorded for this paper yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__.'/Component/footer.view.php'; ?>

</body>
</html>