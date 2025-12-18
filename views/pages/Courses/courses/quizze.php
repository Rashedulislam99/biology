<?php
$page = $_GET['page'] ?? 1;
$perpage = 20;
$chapter_id = $_GET["id"];

$total_quizzes = Quizze::count("WHERE chapter_id='$chapter_id'");
$total_pages = ceil($total_quizzes / $perpage);
$quizzes = Quizze::pagination($page, $perpage, "WHERE chapter_id='$chapter_id'");
?>

<!-- SCORE BOARD -->
<div class="score-board" id="score-board">
    <span>Right: <span id="right-count">0</span></span>
    <span>Wrong: <span id="wrong-count">0</span></span>
</div>

<!-- JAVASCRIPT (QUIZ LOGIC WITH PERSISTENT SCORE) -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const chapterId = "<?php echo $chapter_id; ?>";

    const currentChapterKey = "current_chapter";
    const rightKey = "rightCount_chapter_" + chapterId;
    const wrongKey = "wrongCount_chapter_" + chapterId;

    // আগে কোন chapter ছিল
    const lastChapter = localStorage.getItem(currentChapterKey);

    // 🔥 New chapter detect হলে old score clear
    if (lastChapter !== chapterId) {
        // আগের chapter এর score delete
        if (lastChapter) {
            localStorage.removeItem("rightCount_chapter_" + lastChapter);
            localStorage.removeItem("wrongCount_chapter_" + lastChapter);
        }

        // নতুন chapter set
        localStorage.setItem(currentChapterKey, chapterId);

        // নতুন chapter → fresh start
        localStorage.setItem(rightKey, 0);
        localStorage.setItem(wrongKey, 0);
    }

    // Score load (same chapter হলে আগেরটাই আসবে)
    let rightCount = localStorage.getItem(rightKey)
        ? parseInt(localStorage.getItem(rightKey)) : 0;

    let wrongCount = localStorage.getItem(wrongKey)
        ? parseInt(localStorage.getItem(wrongKey)) : 0;

    document.getElementById("right-count").textContent = rightCount;
    document.getElementById("wrong-count").textContent = wrongCount;

    // ================== QUIZ LOGIC ==================
    document.querySelectorAll(".quiz-card").forEach((card, index) => {

        const options = card.querySelectorAll(".option");
        const correctLetter = card.dataset.answer.trim();
        const feedback = card.querySelector(".feedback");

        options.forEach(option => {
            option.addEventListener("click", function () {

                const selectedLetter = this.textContent.trim().substring(0,1);

                options.forEach(o => {
                    o.style.pointerEvents = "none";
                    if (o.textContent.trim().substring(0,1) === correctLetter) {
                        o.classList.add("correct");
                        o.style.animation = "pulseGreen 0.6s ease";
                    }
                });

                if (selectedLetter !== correctLetter) {
                    this.classList.add("wrong");
                    this.style.animation = "shakeRed 0.5s ease";
                    feedback.textContent = "❌ Wrong! Correct Answer: " + correctLetter;
                    wrongCount++;
                } else {
                    feedback.textContent = "✅ Correct!";
                    rightCount++;
                }

                // Save score
                localStorage.setItem(rightKey, rightCount);
                localStorage.setItem(wrongKey, wrongCount);

                // Update UI
                document.getElementById("right-count").textContent = rightCount;
                document.getElementById("wrong-count").textContent = wrongCount;

                // Auto scroll
                setTimeout(() => {
                    const nextCard = document.querySelectorAll(".quiz-card")[index + 1];
                    if (nextCard) {
                        nextCard.scrollIntoView({ behavior: "smooth", block: "center" });
                    }
                }, 700);
            });
        });
    });

});
</script>



<!-- QUIZ BOX -->
<div class="quiz-container">
    <?php if(count($quizzes) > 0): ?>
        <?php foreach($quizzes as $index => $q): ?>
            <div class="quiz-card" data-answer="<?php echo $q->correct_ans; ?>">
                <h3><?php echo (($page-1)*$perpage + $index +1).". ".$q->question; ?></h3>

                <ul>
                    <li class="option">A. <?php echo $q->option_a; ?></li>
                    <li class="option">B. <?php echo $q->option_b; ?></li>
                    <li class="option">C. <?php echo $q->option_c; ?></li>
                    <li class="option">D. <?php echo $q->option_d; ?></li>
                </ul>

                <p class="feedback"></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No Quiz Found</p>
    <?php endif; ?>
</div>

<!-- PAGINATION -->
<div class="pagination">
    <?php for($i=1; $i<=$total_pages; $i++): ?>
        <a href="?id=<?php echo $chapter_id ?>&page=<?php echo $i ?>" class="<?php echo ($i==$page)?'active':''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>

<!-- CSS -->
<style>
body { 
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    margin:0; padding:0;
}

.quiz-container { 
    padding:100px 20px 20px;
    max-width:800px;
    margin:auto;
}

/* QUIZ CARD */
.quiz-card {
    background:#fff;
    border-radius:12px;
    padding:20px;
    margin:20px 0;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.quiz-card:hover { 
    box-shadow:0 6px 14px rgba(0,0,0,0.15);
}

/* QUESTION BLUE */
.quiz-card h3 {
    margin-bottom:15px;
    font-size:18px;
    color:#1565c0;
    font-weight:bold;
}

.quiz-card ul { list-style:none; padding:0; margin:0; }

/* OPTIONS BLACK */
.quiz-card li.option {
    color:#000;
    cursor:pointer;
    padding:10px 15px;
    margin:8px 0;
    border:1px solid #ddd;
    border-radius:8px;
    transition:0.2s;
    background:#fafafa;
}

.quiz-card li.option:hover { background:#e3f2fd; }

.quiz-card li.correct { background:#c8e6c9; border-color:#4caf50; }
.quiz-card li.wrong { background:#ffcdd2; border-color:#f44336; }

.quiz-card .feedback {
    font-weight:bold;
    margin-top:8px;
    color:#555;
}

/* SCOREBOARD RIGHT SIDE */
.score-board {
    position:fixed;
    top:120px;
    right:20px;
    padding:12px 20px;
    background:#1e88e5;
    color:#fff;
    font-weight:bold;
    font-size:16px;
    border-radius:10px;
    display:flex;
    gap:20px;
    z-index:9999;
    box-shadow:0 2px 8px rgba(0,0,0,0.2);
}
.score-board span#wrong-count {
    color: #f44336; /* Red color */
    font-weight: bold;
}

.score-board span#right-count {
    color: #c8e6c9; /* Green color (Optional) */
    font-weight: bold;
}

/* PAGINATION */
.pagination {
    text-align:center;
    margin:20px 0;
}

.pagination a {
    padding:6px 12px;
    margin:0 3px;
    border:1px solid #ddd;
    border-radius:5px;
    text-decoration:none;
    color:#333;
}

.pagination a.active {
    background:#1e88e5;
    color:#fff;
    border-color:#1e88e5;
}

@keyframes pulseGreen {
    0% { transform: scale(1); background:#c8e6c9; }
    50% { transform: scale(1.05); background:#a5d6a7; }
    100% { transform: scale(1); background:#c8e6c9; }
}

@keyframes shakeRed {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}

</style>

<!-- JAVASCRIPT (QUIZ LOGIC) -->
<script>
let rightCount = 0;
let wrongCount = 0;

document.querySelectorAll('.quiz-card').forEach((card, index) => {

    const options = card.querySelectorAll('.option');
    const correctLetter = card.dataset.answer.trim();   // DB gives: A/B/C/D
    const feedback = card.querySelector('.feedback');

    options.forEach(option => {
        option.addEventListener('click', function () {

            const selectedLetter = this.textContent.trim().substring(0,1);  
            // A, B, C, D

            // Disable all options
            options.forEach(o => {
                o.style.pointerEvents = "none";

                let optLetter = o.textContent.trim().substring(0,1);

                // correct option mark
                if (optLetter === correctLetter) {
                    o.classList.add('correct');
                    o.style.animation = "pulseGreen 0.6s ease";
                }
            });

            // If wrong
            if (selectedLetter !== correctLetter) {
                this.classList.add('wrong');
                this.style.animation = "shakeRed 0.5s ease";
                feedback.textContent = "❌ Wrong! Correct Answer: " + correctLetter;
                wrongCount++;
            }
            else {
                feedback.textContent = "✅ Correct!";
                rightCount++;
            }

            // Update scoreboard
            document.getElementById('right-count').textContent = rightCount;
            document.getElementById('wrong-count').textContent = wrongCount;

            // Auto scroll to next question
            setTimeout(() => {
                 const nextCard = document.querySelectorAll('.quiz-card')[index + 1];
                if (nextCard) {
                   nextCard.scrollIntoView({ behavior: "smooth", block: "center" });
                }
             }, 700);

        });
    });
});
</script>

