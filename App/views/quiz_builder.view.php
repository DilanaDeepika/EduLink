<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Builder - <?= htmlspecialchars($data['quiz_title'] ?? 'New Quiz') ?></title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vle_teacher.css" />
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/quiz_builder.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>

    <div class="builder-container">
        
        <form id="quizBuilderForm" method="POST" action="<?= ROOT ?>/TeacherVle/saveQuizQuestions">
            
            <input type="hidden" name="class_id" value="<?= $data['class_id'] ?>">
            <input type="hidden" name="quiz_id" value="<?= $data['quiz_id'] ?>">

            <div class="quiz-header">
                <h1><?= htmlspecialchars($data['title']) ?></h1>
                <p><?= htmlspecialchars($data['description']) ?></p>
            </div>

            <div id="questions-container">
                </div>

            <div class="builder-toolbar">
                <a href="<?= ROOT ?>/TeacherVle/<?= $data['class_id'] ?>" class="btn-back">Cancel</a>
                <button type="button" class="btn btn-add" id="addQuestionBtn">+ Add Question</button>
                <button type="submit" class="btn btn-save">Save Quiz</button>
            </div>

        </form>
    </div>

    <script src="<?= ROOT ?>/assets/js/quiz_builder.js"></script>
</body>
</html>