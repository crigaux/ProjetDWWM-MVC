<?php
    $isOnReview = true;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
        $review = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS));
    }

    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/review.php');
    include(__DIR__ . '/../views/templates/footer.php');