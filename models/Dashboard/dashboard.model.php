<?php
class Subject1 extends Model implements JsonSerializable {
    public $id;
    public $name;
    public $description;

    public function __construct() { }

    public function set($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function save() {
        global $db, $tx;
        $db->query("INSERT INTO {$tx}subjects(name, description) VALUES ('$this->name', '$this->description')");
        return $db->insert_id;
    }

    public function update() {
        global $db, $tx;
        $db->query("UPDATE {$tx}subjects SET name='$this->name', description='$this->description' WHERE id='$this->id'");
    }

    public static function delete($id) {
        global $db, $tx;
        $db->query("DELETE FROM {$tx}subjects WHERE id=$id");
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public static function all() {
        global $db, $tx;
        $result = $db->query("SELECT * FROM {$tx}subjects");
        $data = [];
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        return $data;
    }

    // Optional HTML helpers
    static function html_select($name = "cmbSubject") {
        global $db, $tx;
        $html = "<select id='$name' name='$name'>";
        $result = $db->query("SELECT id, name FROM {$tx}subjects");
        while ($row = $result->fetch_object()) {
            $html .= "<option value='$row->id'>$row->name</option>";
        }
        $html .= "</select>";
        return $html;
    }
}

// ============================

class Chapter1 extends Model implements JsonSerializable {
    public $id;
    public $subject_id;
    public $name;
    public $description;

    public function __construct() { }

    public function set($id, $subject_id, $name, $description) {
        $this->id = $id;
        $this->subject_id = $subject_id;
        $this->name = $name;
        $this->description = $description;
    }

    public function save() {
        global $db, $tx;
        $db->query("INSERT INTO {$tx}chapters(subject_id, name, description) VALUES ('$this->subject_id','$this->name','$this->description')");
        return $db->insert_id;
    }

    public function update() {
        global $db, $tx;
        $db->query("UPDATE {$tx}chapters SET subject_id='$this->subject_id', name='$this->name', description='$this->description' WHERE id='$this->id'");
    }

    public static function delete($id) {
        global $db, $tx;
        $db->query("DELETE FROM {$tx}chapters WHERE id=$id");
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public static function all($subject_id = null) {
        global $db, $tx;
        if ($subject_id) {
            $result = $db->query("SELECT * FROM {$tx}chapters WHERE subject_id='$subject_id'");
        } else {
            $result = $db->query("SELECT * FROM {$tx}chapters");
        }
        $data = [];
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        return $data;
    }

    static function html_select($name = "cmbChapter", $subject_id = null) {
        global $db, $tx;
        $html = "<select id='$name' name='$name'>";
        if ($subject_id) {
            $result = $db->query("SELECT id, name FROM {$tx}chapters WHERE subject_id='$subject_id'");
        } else {
            $result = $db->query("SELECT id, name FROM {$tx}chapters");
        }
        while ($row = $result->fetch_object()) {
            $html .= "<option value='$row->id'>$row->name</option>";
        }
        $html .= "</select>";
        return $html;
    }
}

// ============================

class Lecture1 extends Model implements JsonSerializable {
    public $id;
    public $chapter_id;
    public $name;
    public $description;
    public $pdf;
    public $quiz;
    public $notes;

    public function __construct() { }

    public function set($id, $chapter_id, $name, $description, $pdf = null, $quiz = null, $notes = null) {
        $this->id = $id;
        $this->chapter_id = $chapter_id;
        $this->name = $name;
        $this->description = $description;
        $this->pdf = $pdf;
        $this->quiz = $quiz;
        $this->notes = $notes;
    }

    public function save() {
        global $db, $tx;
        $db->query("INSERT INTO {$tx}lectures(chapter_id, name, description, pdf, quiz, notes) 
                    VALUES ('$this->chapter_id','$this->name','$this->description','$this->pdf','$this->quiz','$this->notes')");
        return $db->insert_id;
    }

    public function update() {
        global $db, $tx;
        $db->query("UPDATE {$tx}lectures SET chapter_id='$this->chapter_id', name='$this->name', description='$this->description', pdf='$this->pdf', quiz='$this->quiz', notes='$this->notes' WHERE id='$this->id'");
    }

    public static function delete($id) {
        global $db, $tx;
        $db->query("DELETE FROM {$tx}lectures WHERE id=$id");
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public static function all($chapter_id = null) {
        global $db, $tx;
        if ($chapter_id) {
            $result = $db->query("SELECT * FROM {$tx}lectures WHERE chapter_id='$chapter_id'");
        } else {
            $result = $db->query("SELECT * FROM {$tx}lectures");
        }
        $data = [];
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        return $data;
    }


    
    public static function find($id) {
        global $db, $tx;
        $result = $db->query("SELECT * FROM {$tx}lectures WHERE id='$id'");
        return $result->fetch_object();
    }
}
?>
