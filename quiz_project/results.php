<?php 
    include 'includes/init.php';
    function get_score($user_answers, $answers, $nb_questions){
        $json = file_get_contents('data/questions.json');
        $data = json_decode($json, true);
        $user_answers = $_SESSION['answers'];
        $sum = 0;
        for($i=0; $i < $nb_questions; $i++){
            if($user_answers[$i] == $answers[$i]){
                $sum+=1;
            }
        }
        // Calcul of the percentage
        return ($sum / $nb_questions) * 100;
    }

    $score =  round(get_score($user_answers, $answers, $nb_questions), 2);
    
    $file = 'data/scores.json';

    if (!is_writable(dirname($file))) {
        die("❌ Folder not writable: " . dirname($file));
    }
    
    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $scores = json_decode($jsonData, true);
    } else {
        $scores = [];
    }

    // lets add the current score
    $found = false;
    foreach($scores as &$entry){
        if($entry['pseudo'] == $_SESSION['user']){ //pseudo already exists
            $entry['score'] = round($score, 2);
            $found = true;
        }
    }
    unset($entry); // clean after the loop with reference 

    if(!$found){ // pseudo doesnt exist in scores.json
        $scores[] = [
            'pseudo' => $_SESSION['user'],
            'score' => round($score, 2)
        ];
    }
    
   
    file_put_contents($file, json_encode($scores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
?>



<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game - Results</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card text-center shadow p-4" style="max-width: 500px; width: 100%;">
        <h1 class="text-success mb-3">Results</h1>
        <p class="fs-5 mb-1">🎉 Congratulations <strong><?= htmlspecialchars($_SESSION['user']); ?></strong>!</p>
        <p class="fs-4 mb-4">Your final score is: <strong><?= round($score, 2) ?>%</strong></p>

        <div class="d-flex justify-content-around">
            <a href="review.php" class="btn btn-info text-white">Review</a>
            <a href="index.html" class="btn btn-primary">Quit</a>
            <a href="bestScores.php" class="btn btn-warning text-dark">Best Scores</a>
        </div>
    </div>

</body>
</html>


