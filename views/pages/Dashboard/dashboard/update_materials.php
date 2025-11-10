<?php
require_once 'dashboard.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lecture_id = $_POST['lecture_id'];

    // File uploads
    $upload_dir = "uploads/lectures/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $material_pdf = $_FILES['material_pdf']['name'] ?? null;
    $material_quiz = $_FILES['material_quiz']['name'] ?? null;
    $material_notes = $_FILES['material_notes']['name'] ?? null;

    // Fetch existing lecture
    $lecture = Lecture::find($lecture_id);

    // Update file names if uploaded
    if ($material_pdf) {
        move_uploaded_file($_FILES['material_pdf']['tmp_name'], $upload_dir . $material_pdf);
        $lecture->pdf = $material_pdf;
    }
    if ($material_quiz) {
        move_uploaded_file($_FILES['material_quiz']['tmp_name'], $upload_dir . $material_quiz);
        $lecture->quiz = $material_quiz;
    }
    if ($material_notes) {
        move_uploaded_file($_FILES['material_notes']['tmp_name'], $upload_dir . $material_notes);
        $lecture->notes = $material_notes;
    }

    $lecture->update();

    header("Location: admin_dashboard.php");
    exit;
}
?>
