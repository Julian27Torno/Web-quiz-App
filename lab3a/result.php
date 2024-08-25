<?php

require "helpers.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}


$complete_name = htmlspecialchars($_POST['complete_name']);
$email = htmlspecialchars($_POST['email']);
$birthdate = htmlspecialchars($_POST['birthdate']);
$contact_number = htmlspecialchars($_POST['contact_number']);
$agree = $_POST['agree'];
$answers = $_POST['answers'] ?? [];

$score = compute_score($answers);
$perfect_score = MAX_QUESTION_NUMBER; 

$formatted_birthdate = date("F j, Y", strtotime($birthdate));


$questions = retrieve_questions();
$correct_answers = $questions['answers'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
   
</head>
<body>
<section class="hero <?php echo $score >= 2 ? 'is-success' : 'is-danger'; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo $score; ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>

<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td> <?php echo $complete_name ?> </td>
                </tr>
                <tr class="is-selected">
                    <td>Email</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo $formatted_birthdate; ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $contact_number; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php if ($score == $perfect_score): ?>
    <section class="section">
        <canvas id="confetti-canvas"></canvas>
    </section>
    <script>
        var confettiSettings = { target: 'confetti-canvas' };
        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();
    </script>
<?php endif; ?>

<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions['questions'] as $index => $question): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($question['question']); ?></td>
                        <td><?php echo htmlspecialchars($correct_answers[$index] ?? 'Not provided'); ?></td>
                        <td><?php echo htmlspecialchars($answers[$index] ?? 'Not Answered'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
