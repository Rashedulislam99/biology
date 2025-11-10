<?php
require_once 'dashboard.model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $_POST['subject_id'];
    $name = $_POST['chapter_name'];
    $description = $_POST['chapter_description'];

    $chapter = new Chapter();
    $chapter->set(null, $subject_id, $name, $description);
    $chapter_id = $chapter->save();

    header("Location: admin_dashboard.php");
    exit;
}
?>
