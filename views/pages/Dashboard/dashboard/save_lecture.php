<?php
require_once 'dashboard.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chapter_id = $_POST['chapter_id'];
    $name = $_POST['lecture_name'];
    $description = $_POST['lecture_description'];

    // File uploads
    $upload_dir = "uploads/lectures/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $pdf = $_FILES['lecture_pdf']['name'] ?? null;
    $quiz = $_FILES['lecture_quiz']['name'] ?? null;
    $notes = $_FILES['lecture_notes']['name'] ?? null;

    // Move uploaded files
    if ($pdf) move_uploaded_file($_FILES['lecture_pdf']['tmp_name'], $upload_dir . $pdf);
    if ($quiz) move_uploaded_file($_FILES['lecture_quiz']['tmp_name'], $upload_dir . $quiz);
    if ($notes) move_uploaded_file($_FILES['lecture_notes']['tmp_name'], $upload_dir . $notes);

    // Save lecture in DB
    $lecture = new Lecture();
    $lecture->set(null, $chapter_id, $name, $description, $pdf, $quiz, $notes);
    $lecture->save();

    header("Location: admin_dashboard.php");
    exit;
}
?>
