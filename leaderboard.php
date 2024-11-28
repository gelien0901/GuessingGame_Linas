<?php
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <style>
        body {
            text-align:center;
            bacground-color: gray;
        }
        h1 {
            text-align:center;
        }
    </style>1
</head>
<body>
    <h1>Leaderboard</h1>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
                <th>Time Taken</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT users.username, quiz_results.score, quiz_results.time_taken, quiz_results.quiz_date 
                    FROM quiz_results
                    JOIN users ON quiz_results.user_id = users.id
                    ORDER BY quiz_results.score DESC, quiz_results.time_taken ASC
                    LIMIT 10";
            $result = $conn->query($sql);
            $rank = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rank}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['score']}</td>";
                echo "<td>{$row['time_taken']}</td>";
                echo "<td>{$row['quiz_date']}</td>";
                echo "</tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>