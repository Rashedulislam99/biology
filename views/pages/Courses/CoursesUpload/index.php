<?php
// upload.php
//session_start();

// CONFIG
$uploadDir = __DIR__ . '/pdfs';      // pdfs ফোল্ডার (মেইন টার্গেট)
$maxFileSize = 10 * 1024 * 1024;     // 10 MB

// Ensure upload directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

// Helper: sanitize file name
function safe_filename($name) {
    // remove dangerous characters and spaces
    $name = preg_replace('/[^\w\-.]+/u', '_', $name);
    return $name;
}

$messages = [];

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {
    $file = $_FILES['pdf_file'];

    // basic checks
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $messages[] = 'ফাইল আপলোডে ত্রুটি হয়েছে (error code: ' . $file['error'] . ').';
    } elseif ($file['size'] > $maxFileSize) {
        $messages[] = 'ফাইলটি খুব বড়। সর্বোচ্চ 10MB পর্যন্ত অনুমোদিত।';
    } else {
        // Validate file is actually PDF using finfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        // Accept common PDF mime-types
        $allowed_mimes = ['application/pdf', 'application/x-pdf'];

        if (!in_array($mime, $allowed_mimes)) {
            $messages[] = 'শুধু PDF ফাইল অনুমোদিত। তুমি যে ফাইলটি দিয়েছেন তা PDF নয় (mime: ' . htmlspecialchars($mime) . ').';
        } else {
            // create unique filename to avoid overwrite
            $original = pathinfo($file['name'], PATHINFO_FILENAME);
            $ext = '.pdf';
            $safe = safe_filename($original);
            $newname = $safe . '_' . time() . '_' . bin2hex(random_bytes(4)) . $ext;
            $destination = $uploadDir . '/' . $newname;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $messages[] = 'আপলোড সফল: ' . htmlspecialchars($newname);
            } else {
                $messages[] = 'ফাইল সার্ভারে সেভ করতে সমস্যা হয়েছে। ফোল্ডারের permissions চেক করো।';
            }
        }
    }
}

// Read uploaded PDFs for listing
$uploaded = [];
foreach (glob($uploadDir . '/*.pdf') as $p) {
    $uploaded[] = [
        'path' => $p,
        'name' => basename($p),
        'size' => filesize($p),
        'time' => filemtime($p),
    ];
}
// sort by time desc
usort($uploaded, function($a, $b){ return $b['time'] - $a['time']; });

?>
<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PDF Upload — Biology</title>
  <style>
    body{font-family: Arial, "Noto Sans Bengali", sans-serif;padding:28px;background:#f3f6fb}
    .card{background:#fff;padding:18px;border-radius:10px;box-shadow:0 6px 20px rgba(10,20,40,0.06);max-width:920px;margin:0 auto}
    h1{margin:0 0 8px 0;font-size:20px}
    p.lead{margin:0 0 18px;color:#556}
    .messages{margin:12px 0}
    .messages .msg{padding:8px;border-radius:6px;margin-bottom:8px}
    .success{background:#eefbe9;color:#1a7f2e}
    .error{background:#ffe9e9;color:#8a1a1a}
    form{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
    input[type="file"]{padding:6px}
    button{background:#4e54c8;color:#fff;border:none;padding:10px 14px;border-radius:8px;cursor:pointer}
    table{width:100%;border-collapse:collapse;margin-top:18px}
    th,td{padding:10px;border-bottom:1px solid #eee;text-align:left}
    .tiny{font-size:13px;color:#666}
    a.view{background:#06b6d4;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
  </style>
</head>
<body>
  <div class="card">
    <h1>PDF Upload ফরম</h1>
    <p class="lead">অধ্যায়ের PDF আপলোড করতে ফাইল সিলেক্ট করে Submit করো। সর্বোচ্চ 10MB। শুধুই PDF।</p>

    <div class="messages">
      <?php foreach($messages as $m): ?>
        <?php $isErr = stripos($m, 'ত্রুটি') !== false || stripos($m, 'সমস্যা') !== false || stripos($m, 'নয়') !== false; ?>
        <div class="msg <?= $isErr ? 'error' : 'success' ?>">
          <?= htmlspecialchars($m) ?>
        </div>
      <?php endforeach; ?>
    </div>

    <form method="post" enctype="multipart/form-data">
      <label>
        <input type="file" name="pdf_file" accept=".pdf,application/pdf" required>
      </label>
      <button type="submit">Upload</button>
      <div style="margin-left:auto" class="tiny">pdfs/ ফোল্ডারে সেভ হবে</div>
    </form>

    <h3 style="margin-top:22px">Uploaded PDFs</h3>
    <?php if (count($uploaded) === 0): ?>
      <p class="tiny">কোনো ফাইল আপলোড করা হয়নি।</p>
    <?php else: ?>
      <table>
        <thead><tr><th>নাম</th><th>সাইজ</th><th>আপলোড করা তারিখ</th><th>Action</th></tr></thead>
        <tbody>
        <?php foreach($uploaded as $u): ?>
          <tr>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td class="tiny"><?= round($u['size']/1024,2) ?> KB</td>
            <td class="tiny"><?= date('Y-m-d H:i:s', $u['time']) ?></td>
            <td><a class="view" href="<?php echo 'pdfs/' . rawurlencode($u['name']); ?>" target="_blank">View</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <p class="tiny" style="margin-top:14px">Note: security জন্য production-এ আরো checks যোগ করো — CSRF token, user auth, antivirus scanning ইত্যাদি।</p>
  </div>
</body>
</html>
