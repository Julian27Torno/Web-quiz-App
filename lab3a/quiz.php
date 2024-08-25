<?php

require "helpers.php";

// Check if the HTTP method used is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Retrieve POST data
$complete_name = $_POST['complete_name'] ?? null;
$email = $_POST['email'] ?? null;
$birthdate = $_POST['birthdate'] ?? null;
$contact_number = $_POST['contact_number'] ?? null;
$agree = $_POST['agree'] ?? null;
$answers = $_POST['answers'] ?? [];

// Retrieve all questions
$questions = retrieve_questions();
$number_of_questions = count($questions['questions']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <style>
        .timer {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<section class="section">
    <h1 class="title">Quiz</h1>

    <form method="POST" action="result.php">
    <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
    <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
    <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
    <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />
    <input type="hidden" name="answers" value="<?php echo htmlspecialchars(implode(',', $answers)); ?>" />

        <?php foreach ($questions['questions'] as $index => $question): ?>
            <div class="box">
                <h2 class="subtitle">Question <?php echo $index + 1; ?>:</h2>
                <p><?php echo htmlspecialchars($question['question']); ?></p>
                
                <?php foreach ($question['options'] as $option): ?>
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option['key']); ?>" <?php echo in_array($option['key'], $answers) ? 'checked' : ''; ?> />
                                <?php echo htmlspecialchars($option['value']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="button is-primary">Submit</button>
    </form>

    <div class="timer" id="timer">Time remaining: <span id="countdown">60</span> seconds</div>
</section>

<script>
    // JavaScript timer
    let timeLeft = 60; // Time in seconds
    const countdownElement = document.getElementById('countdown');
    const form = document.querySelector('form');

    function updateTimer() {
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            form.submit();
        } else {
            countdownElement.textContent = timeLeft;
            timeLeft -= 1;
        }
    }

    // Update timer every second
    const timerInterval = setInterval(updateTimer, 1000);
</script>
</body>
</html>
