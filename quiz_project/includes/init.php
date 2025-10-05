<?php
session_start();

function loadQuizData($jsonFile = __DIR__ . '/../data/questions.json') { // inclusion à partir du dossire courant 
    if (!isset($_SESSION['user'])) {
        die("Session not initialized. Please start from the beginning.");
    }
    if (!file_exists($jsonFile)) {
        die(" $jsonFile not found.");
    }
    $json = file_get_contents($jsonFile);
    $data = json_decode($json, true);
    return $data;
}

$data = loadQuizData();
$nb_questions = count($data['questions']); // number of questions

// corrects answers for every question
$answers = [];
foreach ($data['questions'] as $q) {
    $answers[] = $q['answer'];
} 

$currentPage = $_SESSION['currentPage'];
$question = $data['questions'][$currentPage];
$user_answers = $_SESSION['answers']; //user's answers
?>
