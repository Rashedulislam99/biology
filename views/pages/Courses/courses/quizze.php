<?php
include 'admin/includes/db.php';
session_start();
$chapter_id = intval($_GET['chapter'] ?? 0);
$res = $conn->query("SELECT * FROM quizzes WHERE chapter_id=$chapter_id");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<title>Chapter Quiz</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    min-height: 100vh;
    color: #333;
}

h2 {
    text-align: center;
    color: #fff;
    margin-bottom: 30px;
    font-size: 32px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

.quiz-box {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    transition: transform 0.2s, box-shadow 0.2s;
}

.quiz-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.25);
}

.quiz-box p {
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 15px;
}

label {
    display: block;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 16px;
}

label:hover {
    transform: translateX(5px);
    background: #f1f1f1;
}

input[type="radio"] {
    margin-right: 10px;
}

.correct {
    background: #d4edda !important;
    color: #155724 !important;
    font-weight: 600;
    border-left: 5px solid #28a745;
}

.wrong {
    background: #f8d7da !important;
    color: #721c24 !important;
    font-weight: 600;
    border-left: 5px solid #dc3545;
}

button[type="submit"] {
    display: block;
    margin: 25px auto;
    background: linear-gradient(45deg, #ff512f, #dd2476);
    color: #fff;
    border: none;
    padding: 12px 35px;
    font-size: 18px;
    border-radius: 12px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

button[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

h3 {
    text-align: center;
    font-size: 22px;
    color: #fff;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    margin-top: 20px;
}
</style>
</head>
<body>

<h2>Chapter Quiz</h2>

<?php if($res->num_rows==0) { echo '<p style="text-align:center; color:#fff;">No quiz for this chapter.</p>'; exit; } ?>

<form method="POST">
<?php 
$qno=1; 
$quiz_data = []; 
while($r=$res->fetch_assoc()): 
    $quiz_data[$r['id']] = $r;
?>
  <div class="quiz-box" id="quiz-<?php echo $r['id']; ?>">
    <p><b><?php echo $qno; ?>.</b> <?php echo htmlspecialchars($r['question']); ?></p>
    <label><input type="radio" name="ans[<?php echo $r['id']; ?>]" value="A"> <?php echo htmlspecialchars($r['option_a']); ?></label>
    <label><input type="radio" name="ans[<?php echo $r['id']; ?>]" value="B"> <?php echo htmlspecialchars($r['option_b']); ?></label>
    <label><input type="radio" name="ans[<?php echo $r['id']; ?>]" value="C"> <?php echo htmlspecialchars($r['option_c']); ?></label>
    <label><input type="radio" name="ans[<?php echo $r['id']; ?>]" value="D"> <?php echo htmlspecialchars($r['option_d']); ?></label>
  </div>
<?php 
$qno++; 
endwhile; 
?>

<button type="submit">Submit Quiz</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $score=0; $total=0;
    foreach($_POST['ans'] as $qid=>$ans) {
        $total++;
        $correct = $quiz_data[$qid]['correct_ans'];
        $quiz_box_id = "quiz-$qid";

        echo "<script>";
        // সব সঠিক উত্তর green highlight
        echo "document.querySelector('#$quiz_box_id input[value=\"$correct\"]').parentNode.classList.add('correct');";
        // user ভুল দিলে তার option red
        if($ans != $correct){
            echo "document.querySelector('#$quiz_box_id input[value=\"$ans\"]').parentNode.classList.add('wrong');";
        } else { $score++; }
        echo "</script>";
    }
    echo "<h3>Score: $score / $total</h3>";
}
?>
</body>
</html>
