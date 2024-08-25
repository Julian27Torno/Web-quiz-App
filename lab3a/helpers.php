<?php

define('MAX_QUESTION_NUMBER', 5); // Adjust according to your JSON file

function retrieve_questions() {
    // Open the questions/triviaquiz.json file
    $json_string = file_get_contents("./questions/triviaquiz.json");
    
    // Convert it to array
    $json_data = json_decode($json_string, true);
    
    // Return the trivia questions array data
    return $json_data;
}

function get_current_question($answers = '') {
    $number_of_answers = strlen($answers);
    $questions = retrieve_questions();
    // Ensure index does not exceed array bounds
    if ($number_of_answers < count($questions['questions'])) {
        return $questions['questions'][$number_of_answers];
    }
    return null; // Return null if no more questions
}

function get_current_question_number($answers = '') {
    return strlen($answers);
}

function get_options_for_question_number($number = 0) {
    $questions = retrieve_questions();
    // Ensure index is within bounds
    if ($number > 0 && $number <= count($questions['questions'])) {
        return $questions['questions'][$number - 1]['options'];
    }
    return [];
}

function compute_score($answers = []) {
    $questions = retrieve_questions();
    $correct_answers = $questions['answers'];

    $score = 0;
    for ($i = 0; $i < count($correct_answers); $i++) {
        if (isset($answers[$i]) && $correct_answers[$i] == $answers[$i]) {
            $score++;
        }
    }
    return $score;
}

function get_answers() {
    $questions = retrieve_questions();
    return $questions['answers'];
}
