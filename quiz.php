<?php
include "conn.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the user has taken the test
$stmt = $conn->prepare("SELECT COUNT(*) FROM quiz_results WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    echo "You have already taken the quiz.";
    exit();
}

$quiz_title = "PHP Quiz";
$questions = [
    [
        "question" => "What does PHP stands for?",
        "options" => ["Personal Homepage", "Private Homepage", "PHP: Hypertext Preprocessor", "hgfhfghfg"],
        "answer" => 2
    ],
    [
        "question" => "What is HTTP means?",
        "options" => ["Personal Homepage", "Private Homepage", "PHP: Hypertext Preprocessor", "HyperText Transfer Protocol"],
        "answer" => 4
    ],
    [
        "question" => "What is 5 + 5",
        "options" => ["ten", "five", "seven", "eight"],
        "answer" => 1
    ],
];

$score = 0;
$start_time = microtime(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $index => $question) {
        if (isset($_POST['question' . $index]) && $_POST['question' . $index] == $question["answer"]) {
            $score++;
        }
    }
    $time_taken = microtime(true) - $start_time;

    // Save the score and time taken to the database
    $stmt = $conn->prepare("INSERT INTO quiz_results (user_id, score, time_taken, quiz_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $user_id, $score, $time_taken);
    $stmt->execute();
    $stmt->close();

    echo "<h2>Your score: $score/" . count($questions) . "</h2>";
    echo "<a href='index.php'>Try Again</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $quiz_title; ?></title>
</head>
<body>
    <h1><?php echo $quiz_title; ?></h1>
    <form action="" method="post">
        <?php foreach ($questions as $index => $question): ?>
        <fieldset>
            <legend><?php echo $question['question']; ?></legend>
            <?php foreach ($question['options'] as $optionIndex => $options): ?>
            <label for="quiz">
                <input type="radio" name="question<?php echo $index; ?>" value="<?php echo $optionIndex; ?>">
                <?php echo $options; ?>
            </label><br>
            <?php endforeach; ?>
        </fieldset>
        <?php endforeach; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
