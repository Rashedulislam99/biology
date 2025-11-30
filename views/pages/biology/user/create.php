<div class="container my-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Student Registration Form</h4>
    </div>

    <div class="card-body">
      <form id="regForm" action="<?php echo $base_url; ?>/user/save" method="post" enctype="multipart/form-data" novalidate>

        <div class="row g-3">


          <!-- Name -->
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter short name" required>
          </div>

          <!-- Full Name -->
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="Enter full name" required>
          </div>

          <!-- HSC Session -->
          <div class="col-md-6">
            <label class="form-label">HSC Session</label>
            <!-- <input type="text" name="hsc_session" class="form-control" placeholder="e.g. 2020–2021" required> -->
            <select name="hsc_session" class="form-control" required>
              <option value="">Select HSC Session</option>
              <option>2024-25</option>
              <option>2025-26</option>
              <option>2026-27</option>
              <option>2028-29</option>
              <option>2020-30</option>
            </select>

          </div>

          <!-- Class Roll -->
          <div class="col-md-6">
            <label class="form-label">Class Roll</label>
            <input type="text" name="class_roll" class="form-control" placeholder="Enter roll number" required>
          </div>

          <!-- Phone -->
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="tel" name="Phone" class="form-control" placeholder="+8801XXXXXXXXX" required>
          </div>

          <!-- Email -->
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
          </div>

          <!-- Photo -->
          <div class="col-md-6">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*" id="photoInput" required>
          </div>

          <!-- Password -->
          <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Minimum 6 Characters" minlength="6" required>
          </div>
        </div>

        <!-- Submit Btn -->
        <div class="mt-4 text-center">
          <button class="btn btn-primary px-5" name="create" type="submit">Register</button>
        </div>

      </form>
    </div>
  </div>

  <!-- Image Preview -->
  <div class="mt-3">
    <div id="previewBox" class="p-2 border rounded" style="width:150px; display:none;">
      <img id="previewImg" src="" class="img-fluid rounded" />
    </div>
  </div>
</div>



<!-- Image Preview JS -->
<script>
  const photoInput = document.getElementById('photoInput');
  const previewBox = document.getElementById('previewBox');
  const previewImg = document.getElementById('previewImg');

  photoInput.addEventListener('change', () => {
    const file = photoInput.files[0];
    if (file) {
      previewBox.style.display = 'block';
      previewImg.src = URL.createObjectURL(file);
    }
  });
</script>