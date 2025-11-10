<?php
class DashboardController {




    
    public function __construct() {
        // Admin auth checks can be added later
    }

    // Show dashboard
    public function index() {
        view("dashboard"); // Loads dashboard.php
    }

    // Save a new subject
  public function subject_save() {
   

    $name = $_POST['subject_name'] ?? '';
    $description = $_POST['subject_description'] ?? '';

    print_r($_POST);

     $subject= new Subject();
     $subject->name=  $name;
     $subject->description=  $description;
     $subject->created_at= date("Y-m-d:H:i:s");
     $subject->save();

         print_r($subject);
    // redirect();
}


    // Save a new chapter
    public function save_chapter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject_id = $_POST['subject_id'];
            $name = $_POST['chapter_name'];
            $description = $_POST['chapter_description'];

            $chapter = new Chapter();
            $chapter->set(null, $subject_id, $name, $description);
            $chapter->save();

            view("dashboard"); // Reload dashboard
        }
    }

    // Save a new lecture
    public function save_lecture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chapter_id = $_POST['chapter_id'];
            $name = $_POST['lecture_name'];
            $description = $_POST['lecture_description'];

            $upload_dir = "uploads/lectures/";
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

            $pdf = $_FILES['lecture_pdf']['name'] ?? null;
            $quiz = $_FILES['lecture_quiz']['name'] ?? null;
            $notes = $_FILES['lecture_notes']['name'] ?? null;

            if ($pdf) move_uploaded_file($_FILES['lecture_pdf']['tmp_name'], $upload_dir . $pdf);
            if ($quiz) move_uploaded_file($_FILES['lecture_quiz']['tmp_name'], $upload_dir . $quiz);
            if ($notes) move_uploaded_file($_FILES['lecture_notes']['tmp_name'], $upload_dir . $notes);

            $lecture = new Lecture();
            $lecture->set(null, $chapter_id, $name, $description, $pdf, $quiz, $notes);
            $lecture->save();

            view("dashboard"); // Reload dashboard
        }
    }

    // Update materials for an existing lecture
    public function update_materials() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lecture_id = $_POST['lecture_id'];

            $upload_dir = "uploads/lectures/";
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

            $material_pdf = $_FILES['material_pdf']['name'] ?? null;
            $material_quiz = $_FILES['material_quiz']['name'] ?? null;
            $material_notes = $_FILES['material_notes']['name'] ?? null;

            $lecture = Lecture::find($lecture_id);

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

            view("dashboard"); // Reload dashboard
        }
    }

}
?>
