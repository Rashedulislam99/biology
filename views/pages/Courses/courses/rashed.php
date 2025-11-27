<!-- সংক্ষেপে সমস্যা ও ফ্লো:

নতুন user রেজিস্টার করবে → inactive=1 (pending) এবং তোমাকে (admin) ইমেল নোটিফিকেশন যাবে।

তুমি অ্যাডমিশন প্যানেলে গিয়ে approve করলে inactive=0 হয়ে user login করতে পারবে।

Default role হবে Subscriber (students) — role_id দিয়ে permission নিয়ন্ত্রণ করবে।

student_roll (class_roll) ইউনিক চেক করা থাকবে।

1) Database schema (SQL — run in MySQL / phpMyAdmin)
-- roles table (তোমারটা আছে, তবে full copy)
CREATE TABLE IF NOT EXISTS bio_roles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO bio_roles (id,name,description) VALUES
(1,'Admin','Full access'),
(2,'Editor','Can edit content'),
(3,'Subscriber','View only');

-- users table
CREATE TABLE IF NOT EXISTS bio_users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  full_name VARCHAR(150) DEFAULT NULL,
  hsc_session VARCHAR(50) DEFAULT NULL,
  class_roll VARCHAR(50) DEFAULT NULL,        -- student_roll
  email VARCHAR(150) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INT UNSIGNED NOT NULL DEFAULT 3,     -- default subscriber
  inactive TINYINT(1) NOT NULL DEFAULT 1,     -- 1 = pending/inactive, 0 = active
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY ux_email (email),
  UNIQUE KEY ux_class_roll (class_roll),
  FOREIGN KEY (role_id) REFERENCES bio_roles(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


class_roll (student_roll) কে unique করা আছে — মানে একই roll আবার নিবে না।

inactive দিয়ে approval flow নিয়বে।

2) DB connection helper (db.php)
<?php
// db.php
$DB_HOST = '127.0.0.1';
$DB_NAME = 'admin2';
$DB_USER = 'db_user';
$DB_PASS = 'db_pass';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("DB connect error: " . $e->getMessage());
}


// db_user ও db_pass পরিবর্তন করে নাও।

// 3) User model (simple class using PDO) — User.php
// <?php -->
// models/User.php
class User {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM bio_users WHERE email = :e LIMIT 1");
        $stmt->execute(['e'=>$email]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM bio_users WHERE id = :id LIMIT 1");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO bio_users (name, full_name, hsc_session, class_roll, email, password, role_id, inactive)
                VALUES (:name, :full_name, :hsc_session, :class_roll, :email, :password, :role_id, :inactive)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name'=>$data['name'],
            'full_name'=>$data['full_name'] ?? null,
            'hsc_session'=>$data['hsc_session'] ?? null,
            'class_roll'=>$data['class_roll'] ?? null,
            'email'=>$data['email'],
            'password'=>$data['password'], // already hashed
            'role_id'=>$data['role_id'] ?? 3,
            'inactive'=>$data['inactive'] ?? 1,
        ]);
        return $this->pdo->lastInsertId();
    }

    public function verifyPassword($email, $plainPassword) {
        $user = $this->findByEmail($email);
        if (!$user) return false;
        return password_verify($plainPassword, $user['password']) ? $user : false;
    }

    public function setActive($userId) {
        $stmt = $this->pdo->prepare("UPDATE bio_users SET inactive = 0 WHERE id = :id");
        return $stmt->execute(['id'=>$userId]);
    }
}

// 4) Registration form (register.php) — with validation & admin email notification
// <?php
// register.php
require 'db.php';
require 'models/User.php';
require 'vendor/autoload.php'; // for PHPMailer (composer)

$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $hsc_session = trim($_POST['hsc_session'] ?? '');
    $class_roll = trim($_POST['class_roll'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    $errors = [];

    if (!$name || !$email || !$password) $errors[] = "Name, email and password required.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";

    // check email unique
    if ($userModel->findByEmail($email)) $errors[] = "Email already registered.";

    // check class_roll unique if provided
    if ($class_roll) {
        $stmt = $pdo->prepare("SELECT id FROM bio_users WHERE class_roll = :r LIMIT 1");
        $stmt->execute(['r'=>$class_roll]);
        if ($stmt->fetch()) $errors[] = "Class roll already used.";
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $userId = $userModel->create([
            'name'=>$name,
            'full_name'=>$full_name,
            'hsc_session'=>$hsc_session,
            'class_roll'=>$class_roll,
            'email'=>$email,
            'password'=>$hashed,
            'role_id'=>3,    // subscriber by default
            'inactive'=>1    // pending
        ]);

        // send admin notification email
        $adminEmail = 'mdrashedulislam604@gmail.com';
        $subject = "New registration pending approval: $name";
        $body = "A new user registered on Biology project.\n\nName: $name\nEmail: $email\nClass roll: $class_roll\nApprove at: http://your-site/admin/approve_user.php?id={$userId}\n";

        // PHPMailer simple example
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            // Configure SMTP — change these to your SMTP provider
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'smtp_user';
            $mail->Password = 'smtp_pass';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@your-site.com', 'Biology App');
            $mail->addAddress($adminEmail);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $e) {
            // optional: log mail error but don't break registration
            error_log("Mail error: " . $mail->ErrorInfo);
        }

        // show success
        echo "Registration successful. Waiting for admin approval.";
        exit;
    }
}
?>
<!-- simple html form (show errors if any) -->
<?php if(!empty($errors)): ?>
  <div style="color:red;"><?=implode("<br>", $errors)?></div>
<?php endif; ?>
<form method="post">
  <input name="name" placeholder="Name" required><br>
  <input name="full_name" placeholder="Full name"><br>
  <input name="hsc_session" placeholder="HSC session"><br>
  <input name="class_roll" placeholder="Class roll"><br>
  <input name="email" placeholder="Email" type="email" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <input name="password2" type="password" placeholder="Confirm password" required><br>
  <button type="submit">Register</button>
</form>

<!-- 
নোট: PHPMailer ব্যবহার করতে composer require phpmailer/phpmailer করো, আর SMTP কনফিগ ঠিক করে নাও (smtp.example.com ইত্যাদি).

5) Login (login.php) — disallow inactive users -->
<?php
// login.php
require 'db.php';
require 'models/User.php';
session_start();
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $user = $userModel->findByEmail($email);
    if (!$user) { $err = "Invalid credentials."; }
    else {
        if ($user['inactive']) {
            $err = "Your account is pending approval.";
        } elseif (password_verify($password, $user['password'])) {
            // login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $err = "Invalid credentials.";
        }
    }
}
?>
<form method="post">
  <?php if(isset($err)) echo "<div style='color:red;'>$err</div>"; ?>
  <input name="email" placeholder="Email" type="email" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
</form>

<!-- 6) Admin approve page (approve_user.php) -->
<?php
// admin/approve_user.php
require '../db.php';
require '../models/User.php';
session_start();
// check admin
if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    die("Access denied.");
}
$userModel = new User($pdo);
$id = intval($_GET['id'] ?? 0);
if ($id) {
    $userModel->setActive($id);

    // notify user by email that approved (optional)
    $stmt = $pdo->prepare("SELECT email, name FROM bio_users WHERE id = :id");
    $stmt->execute(['id'=>$id]);
    $u = $stmt->fetch();
    if ($u) {
        // send email (PHPMailer) similar to above: "Your account is approved"
    }
    echo "User approved.";
}

// 7) Role-based middleware (simple)
<?php
// middleware/require_role.php
function require_role($needed_role_id) {
    session_start();
    if (empty($_SESSION['user_id'])) {
        header('Location: /login.php'); exit;
    }
    if ($_SESSION['role_id'] > $needed_role_id && $needed_role_id == 1) {
        // crude check: only role_id == 1 is admin
        die("Permission denied.");
    }
}


// তোমার admin pages এ require_role(1); ব্যবহার করো।

// 8) Admin panel: listing pending users (admin/pending.php)
<?php
// admin/pending.php
require '../db.php';
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 1) die("Access denied.");
$stmt = $pdo->query("SELECT * FROM bio_users WHERE inactive = 1 ORDER BY created_at DESC");
$rows = $stmt->fetchAll();
foreach($rows as $r) {
    echo "{$r['id']} - {$r['name']} - {$r['email']} - Roll: {$r['class_roll']} 
    <a href='approve_user.php?id={$r['id']}'>Approve</a> | 
    <a href='delete_user.php?id={$r['id']}'>Delete</a><br>";
}





//stylish code
<?php
// admin/pending.php
require '../db.php';
session_start();

if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    die("Access denied.");
}

$stmt = $pdo->query("SELECT * FROM bio_users WHERE inactive = 1 ORDER BY created_at DESC");
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending User Approvals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 6px 12px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
        }
        .btn-approve {
            background-color: #28a745;
            color: white;
        }
        .btn-approve:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .no-records {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Pending User Approvals</h1>
    
    <?php if (count($rows) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class Roll</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['id']) ?></td>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td><?= htmlspecialchars($r['class_roll']) ?></td>
                        <td><?= date('Y-m-d H:i', strtotime($r['created_at'])) ?></td>
                        <td>
                            <a href="approve_user.php?id=<?= $r['id'] ?>" 
                               class="btn btn-approve"
                               onclick="return confirm('Approve this user?');">
                                Approve
                            </a>
                            <a href="delete_user.php?id=<?= $r['id'] ?>" 
                               class="btn btn-delete"
                               onclick="return confirm('Are you sure you want to delete this user?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-records">
            <p>No pending users found.</p>
        </div>
    <?php endif; ?>
</body>
</html>