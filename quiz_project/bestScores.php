<?php
session_start();

//load scoressss
$file = 'data/scores.json';
$json = file_get_contents($file);
$data = json_decode($json, true); // tableau associatif

// sort
usort($data, function($a, $b) {
    return $b['score'] <=> $a['score']; // spaceship : 1 if $a < $b ; 0 if = ; -1 if >
});

//Only first 10
$data = array_slice($data, 0, 10); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Best Scores</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Personalized CSS -->
    <link rel="stylesheet" href="css/bestScores.css">
</head>
<body>

<div class="container scoreboard">
    <h1 class="text-center mb-4"> Here we go, the best Scores</h1>

    <table class="table table-hover text-center align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Score (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $rank = 1;
            foreach ($data as $entry): 
                $pseudo = htmlspecialchars($entry['pseudo']);
                $score = round($entry['score'], 2);
                
                // Medal for the first three
                $medal = '';
                if ($rank === 1) $medal = '<span class="medal">🥇</span>';
                elseif ($rank === 2) $medal = '<span class="medal">🥈</span>';
                elseif ($rank === 3) $medal = '<span class="medal ">🥉</span>';
            ?>
            <tr>
                <td><?= $medal ?: $rank ?></td>
                <td><?= $pseudo ?></td>
                <td><strong><?= $score ?></strong></td>
            </tr>
            <?php 
                $rank++;
            endforeach; 
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="results.php" class="btn btn-primary px-4">Back</a>
    </div>
</div>

</body>
</html>
