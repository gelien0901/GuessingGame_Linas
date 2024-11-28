<?php
$quiz_title ="PHP Quiz";
$question = [
    [
        "question" => "What does PHP stands for?",
        "options" => ["Personal Homepage", "Private Homepage", "PHP: Hypertext Preproccesor","Personal Hygiene Practice"],
        "answer" => 2
    ],
   
    [
        "question" => "Does html is a programming language?",
        "options" => ["Yes", "No", "Maybe","I don't know"],
        "answer" => 0
    ],
    [
        "question" => "What is 11 + 11",
        "options" => ["ten","Twenty","Twenty two","thirty"],
        "answer" => 2
    ],
    [
        "question" => "What is the programming language we use for this time?",
        "options" => ["java","python","html","PHP"],
        "answer" => 3
    ],
    [
        "question" => "What is HTML stands for?",
        "options" => ["HyperText Transaction Protocol","HyperText Transfer Protocol","High Pertext TransPort","Hyper Trans Protocol"],
        "answer" => 1
    ],
];
    $score = 0;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        foreach( $question as $index=> $question){
            if ( isset($_POST['question'.$index])&& $_POST['question'.$index] == $question["answer"])
                {
                $score++;
                }
        }
        echo "<h2> Your score: $score/" .count($question). "</h2>";
        echo "<a href = 'index.php'> Try Again> </a>";
        exit;
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $quiz_title;?></h1>
    <form action="" method="post">
        <?php foreach ($question as $index => $question): ?>
        <fieldset>
            <legend> <?php echo $question ['question'];?></legend>
            <?php foreach( $question['options'] as $optionIndex => $options):?>
            <label for="quiz">
                <input type="radio" name="question<?php echo $index; ?>"
                value = "<?php echo $optionIndex; ?>">
                <?php echo $options; ?>
 
            </label></br>
         <?php endforeach ?>
    </fieldset>
    <?php endforeach; ?>
    <input type="Submit" value="submit">
</form>
</body>
</html>