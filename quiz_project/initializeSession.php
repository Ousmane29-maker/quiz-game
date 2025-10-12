<?php

session_start();

if (!isset($_POST['pseudo'])) {
    die("No pseudo received from form.");
}

if (!file_exists('data/questions.json')) {
    die("questions.json not found.");
}

$json = file_get_contents('data/questions.json');
$data = json_decode($json, true);
$nbQuestions = count($data['questions']);

$_SESSION['currentPage'] = 0;
$_SESSION['user'] = $_POST['pseudo'];
$tabAnswers = array_fill(0, $nbQuestions, -1); // -1 indicates unanswered, 
$_SESSION['answers'] = $tabAnswers;
$_SESSION['score'] = 0;

// Redirect to the quiz template
header('location: quizTemplate.php');
?>
