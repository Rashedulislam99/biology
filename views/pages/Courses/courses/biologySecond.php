<!doctype html>
<html lang="bn">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HSC Biology 2nd Paper — অধ্যায়সমূহ</title>   
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Noto Sans Bengali', sans-serif;
      background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }
    h1 {
      font-size: 28px;
      margin-bottom: 6px;
      color: #fff;
      text-align: center;
    }
    p {
      color: #eef;
      text-align: center;
      margin-bottom: 24px;
    }
    .chapter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 18px;
      width: 100%;
      max-width: 1100px;
    }
    .chapter-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 14px;
      padding: 18px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      transition: transform 0.18s ease, box-shadow 0.18s ease;
    }
    .chapter-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.18);
    }
    .chapter-card h2 {
      font-size: 17px;
      color: #222;
      margin-bottom: 10px;
      line-height: 1.3;
    }
    .chapter-card a {
      display: inline-block;
      margin-top: 8px;
      padding: 8px 14px;
      background: #4e54c8;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 700;
      transition: background 0.25s ease;
    }
    .chapter-card a:hover {
      background: #5ac8fa;
    }
    footer {
      margin-top: 36px;
      color: #fff;
      font-size: 14px;
    }

    /* small screens tweaks */
    @media (max-width: 420px) {
      body { padding: 20px 12px; }
      h1 { font-size: 24px; }
      .chapter-card { padding: 14px; border-radius: 12px; }
    }
  </style>
</head>
<body>
  <h1>HSC Biology — 2nd Paper</h1>
  <p>২০২৪–২৫ শিক্ষাবর্ষের সম্পূর্ণ সিলেবাস (১২টি অধ্যায়)</p>

  <div class="chapter-grid">
    <div class="chapter-card">
      <h2>১. প্রাণীর বিভিন্নতা ও শ্রেণিবিন্যাস</h2>
      <a href="<?= $base_url ?>/Courses/chapter1">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>২. প্রাণীর পরিচিতি</h2>
      <a href="<?= $base_url ?>/Courses/chapter2">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৩. পরিপাক ও শোষণ</h2>
      <a href="<?= $base_url ?>/Courses/chapter3">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৪. রক্ত সঞ্চালন</h2>
      <a href="<?= $base_url ?>/Courses/chapter4">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৫. শ্বাসক্রিয়া ও শ্বসন</h2>
      <a href="<?= $base_url ?>/Courses/chapter5">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৬. রেচন ও নিঃসরণ</h2>
      <a href="<?= $base_url ?>/Courses/chapter6">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৭. চলাচল ও অভ্যন্তরীণ পরিবহন</h2>
      <a href="<?= $base_url ?>/Courses/chapter7">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৮. স্নায়ু ও ইন্দ্রিয় তন্ত্র</h2>
      <a href="<?= $base_url ?>/Courses/chapter8">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>৯. প্রাণীর প্রজনন ও মানব প্রজনন ব্যবস্থা</h2>
      <a href="<?= $base_url ?>/Courses/chapter9">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>১০. জীনতত্ত্ব ও বিবর্তন</h2>
      <a href="<?= $base_url ?>/Courses/chapter10">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>১১. জীবপ্রযুক্তি</h2>
      <a href="<?= $base_url ?>/Courses/chapter11">দেখুন</a>
    </div>

    <div class="chapter-card">
      <h2>১২. পরিবেশ ও মানবকল্যাণ</h2>
      <a href="<?= $base_url ?>/Courses/chapter12">দেখুন</a>
    </div>
  </div>

  <footer>© 2025 Biology Academy</footer>
</body>
</html>
