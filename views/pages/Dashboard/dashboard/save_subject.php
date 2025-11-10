<?php
// save_subject.php
include 'includes/db.php'; // এখানে তোমার ডাটাবেজ কানেকশন ফাইল ইনক্লুড করো

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ফর্ম থেকে ডাটা নেয়া
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    // ইনপুট চেক করা
    if (empty($name)) {
        echo "Subject name দিতে হবে!";
        exit;
    }

    // SQL কোয়েরি তৈরি
    $sql = "INSERT INTO subjects (name, description, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        echo "✅ Subject সফলভাবে সেভ হয়েছে!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
