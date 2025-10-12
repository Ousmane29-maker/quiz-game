<?php
    include 'includes/init.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Quiz</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- My personalized css -->
    <link rel="stylesheet" href="css/review.css">
</head>
<body>

    <!-- HEADER FIXED -->
    <div class="header-fixed d-flex justify-content-between align-items-center">
        <span class="fs-4 fw-semibold text-primary"> Pseudo : <?= htmlspecialchars($_SESSION['user']) ?></span>
        <span class="fs-5 fw-semibold text-success"> Score : <?= htmlspecialchars($_SESSION['score']) ?>/<?= $nb_questions ?></span>
    </div>

    <!-- Principal container -->
    <div class="container mt-4">
        <?php for ($i = 0; $i < $nb_questions; $i++): ?>
            <div class="question-card mb-4 p-3 border rounded shadow-sm">
                <?php
                    $correct_answer = $data['questions'][$i]['answer'];
                    $user_answer = $_SESSION['answers'][$i];
                ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="fs-5 fw-bold mb-0">
                        <?= ($i+1) . ". " . htmlspecialchars($data['questions'][$i]['question']) ?>
                    </p>

                    <!-- Displaying +1 or 0 next to the question -->
                    <?php if ($user_answer == $correct_answer): ?>
                        <span class="badge bg-success fs-6">+1</span>
                    <?php else: ?>
                        <span class="badge bg-secondary fs-6">0</span>
                    <?php endif; ?>
                </div>

                <?php
                    $nb_choices = count($data['questions'][$i]['choices']);
                    for ($j = 0; $j < $nb_choices; $j++):
                        $classes = "fs-6 p-2 rounded mb-2 w-100 text-wrap"; // style for choises 
                        if ($j == $correct_answer) {
                            $classes .= " correct";
                        } elseif ($j == $user_answer && $user_answer != $correct_answer) {
                            $classes .= " wrong";
                        } else {
                            $classes .= " border bg-light";
                        }
                ?>
                    <p class="<?= $classes ?>">
                        <?= htmlspecialchars($data['questions'][$i]['choices'][$j]) ?>
                    </p>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
        <div class="text-center mt-4 mb-5">
            <a href="results.php" class="btn btn-secondary btn-lg">Back</a>
        </div>
    </div>

</body>
</html>
