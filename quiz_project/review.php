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

    <!-- Ton fichier CSS personnalisé -->
    <link rel="stylesheet" href="css/review.css">
</head>
<body>

    <!-- HEADER FIXE -->
    <div class="header-fixed d-flex justify-content-between align-items-center">
        <span class="fs-4 fw-semibold text-primary"> Pseudo : <?= htmlspecialchars($_SESSION['user']) ?></span>
        <span class="fs-5 fw-semibold text-success"> Score : <?= htmlspecialchars($_SESSION['score']) ?>/<?= $nb_questions ?></span>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="container mt-4">
        <?php for ($i = 0; $i < $nb_questions; $i++): ?>
            <div class="question-card">
                <p class="fs-5 fw-bold mb-3">
                    <?= ($i+1) . ". " . htmlspecialchars($data['questions'][$i]['question']) ?>
                </p>

                <?php
                $nb_choices = count($data['questions'][$i]['choices']);
                $correct_answer = $data['questions'][$i]['answer'];
                $user_answer = $session['answer'][$i];
                ?>

                <?php for ($j = 0; $j < $nb_choices; $j++): ?>
                    <?php 
                        $classes = "fs-6 p-2 rounded mb-2";
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
    </div>

</body>
</html>
