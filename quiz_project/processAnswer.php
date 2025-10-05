<?php
session_start();
if (isset($_POST['answer'])) {
    $_SESSION['answers'][$_SESSION['currentPage']] = $_POST['answer']; // saving the answer
}else{
    $_SESSION['answers'][$_SESSION['currentPage']] = -1; // the user did'nt answer the question
}

if($_POST['action'] === 'previous'){
    $_SESSION['currentPage']--;
}elseif ($_POST['action'] === 'next'){
    $_SESSION['currentPage']++;
}else{
    header('location: results.php');
    exit();
}


header('location: quizTemplate.php');
?>