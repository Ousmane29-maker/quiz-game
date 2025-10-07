<?php
include 'includes/init.php';
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-start py-5">
        <div class="card shadow p-4" style="max-width: 600px; width: 100%;">
            <h1 class="text-center mb-3">Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
            <h2 class="h5 mb-3">Question <?= $currentPage + 1 ?>/<?= $nb_questions ?></h2>
            <p class="mb-4"><?= htmlspecialchars($question['question']) ?></p>

            <form action="processAnswer.php" method="post">
                <div class="list-group mb-4">
                    <?php foreach ($question['choices'] as $index => $choice): ?>
                        <label class="list-group-item">
                            <input class="form-check-input me-2" type="radio" name="answer" value="<?= $index ?>"
                                <?= isset($user_answers[$currentPage]) && $user_answers[$currentPage] == $index ? 'checked' : '' ?> >
                            <?= htmlspecialchars($choice) ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <?php if($currentPage > 0): ?>
                        <button type="submit" name="action" value="previous" class="btn btn-secondary">Previous</button>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if($currentPage < $nb_questions - 1): ?>
                        <button type="submit" name="action" value="next" class="btn btn-primary">Next</button>
                    <?php else: ?>
                        <button type="submit" name="action" value="validate" class="btn btn-success">Validate</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>


</body>
</html>


