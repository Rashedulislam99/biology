<style>
    #biology{
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
      margin-bottom: 10px;
      color: #fff;
      text-align: center;
    }
    p {
      color: #eef;
      text-align: center;
      margin-bottom: 30px;
    }
    .chapter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      width: 100%;
      max-width: 1000px;
    }
    .chapter-card {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .chapter-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .chapter-card h2 {
      font-size: 18px;
      color: #333;
      margin-bottom: 10px;
    }
    .chapter-card a {
      display: inline-block;
      margin-top: 8px;
      padding: 8px 16px;
      background: #4e54c8;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }
    .chapter-card a:hover {
      background: #5ac8fa;
    }
    footer {
      margin-top: 40px;
      color: #fff;
      font-size: 14px;
    }



</style>



<div id="biology">
    <h1>HSC Biology 1st Paper</h1>
  <p>২০২৪–২৫ শিক্ষাবর্ষের সব অধ্যায়ের তালিকা</p>

  <div class="chapter-grid">

 <?php
      $subject_id= $_GET["subject_id"] ?? 1;
      $paper_id= $_GET["paper_id"]?? 1;
      $data= Chapter::all_by_subject_id($subject_id,$paper_id);

    //   print_r($data);

     foreach ($data as $key => $value) {
       
      echo "
      
       <div class=\"chapter-card\">
            <h2>১.$value->name</h2>
            <a href=\" $base_url/Courses/lecture/$value->id\">দেখুন</a>
        </div>
      ";
     }
     
    ?>
  
  <!-- <div class="chapter-card">
      <h2>১. কোষের গঠন ও কার্যাবলি</h2>
      <a href="<?= $base_url ?>/Courses/chapter1">দেখুন</a>

    </div>






    <div class="chapter-card">
      <h2>২. কোষ বিভাজন</h2>
      <a href="<?= $base_url ?>/Courses/achapter2">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৩. জিনতত্ত্ব ও বিবর্তন</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৪. জীবের শ্রেণিবিন্যাস</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৫. উদ্ভিদ শারীরতত্ত্ব</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৬. উদ্ভিদ প্রজনন</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৭. প্রাণীর টিস্যু</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৮. মানব দেহের পরিপাকতন্ত্র</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>৯. মানব দেহের রক্ত সঞ্চালন তন্ত্র</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>১০. মানব দেহের শ্বসন তন্ত্র</h2>
      <a href="#">দেখুন</a>
    </div>
    <div class="chapter-card">
      <h2>১১. মানব দেহের নির্গমন তন্ত্র</h2>
      <a href="#">দেখুন</a>
    </div> -->
  </div>
</div>

