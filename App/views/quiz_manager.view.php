<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Manager</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/quiz_manager.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="<?php echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
</head>
<body>
    
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>
    
    <div class="quiz-manager-wrapper">
        
        <div class="analysis-container">
            <h2>EduLink Quiz Manager</h2>
            <a href="<?= ROOT ?>/TeacherVle/<?= $data['quiz']->class_id ?>" class="back-link">
                <i class="fa fa-arrow-left"></i> Back to Class Content
            </a>

            <div class="quiz-info-card">
                <h1><?= htmlspecialchars($data['quiz']->title) ?></h1>
                <p><?= htmlspecialchars($data['quiz']->description) ?></p>
            </div>

            <div class="grid-layout">
                
                <div class="vle-panel">
                    <h3 class="panel-header">
                        <i class="fa fa-users"></i> Student Results
                    </h3>
                </div>

                <div class="vle-panel">
                    <h3 class="panel-header danger">
                        <i class="fa fa-exclamation-triangle"></i> Most Incorrect Questions
                    </h3>
                    
                    <?php if(!empty($data['analysis'])): ?>
                        <?php foreach($data['analysis'] as $q): ?>
                            <?php 
                                $wrong_pct = ($q->total_attempts > 0) ? round(($q->wrong_count / $q->total_attempts) * 100) : 0;
                                $barColor = ($wrong_pct > 50) ? '#dc3545' : (($wrong_pct > 20) ? '#ffc107' : '#198754');
                            ?>

                            <div class="question-card">
                                <div class="question-text">
                                    <?= htmlspecialchars($q->question_text) ?>
                                </div>
                                
                                <div class="question-stats">
                                    <span><?= $q->wrong_count ?> students answered wrong</span>
                                    <span style="font-weight:bold; color:<?= $barColor ?>"><?= $wrong_pct ?>% Error Rate</span>
                                </div>

                                <div class="bar-container">
                                    <div class="bar-fill" style="width: <?= $wrong_pct ?>%; background-color: <?= $barColor ?>;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-data">No data available for analysis yet.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        
    </div> <?php include __DIR__.'/Component/footer.view.php'; ?>
</body>
</html>