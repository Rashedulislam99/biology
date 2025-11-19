<style>
    /* Reset & base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    #body {
      font-family: 'Noto Sans Bengali', sans-serif;
      background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
      min-height: 100vh;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* PDF Viewer Page Styles */
    div.pdf-viewer-page {
      background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #a5d6a7 100%);
      padding: 0;
      margin: 0;
    }

    body.pdf-viewer-page {
      background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #a5d6a7 100%);
      padding: 0;
      margin: 0;
      overflow: hidden;
    }

    /* Header */
    h1 {
      color: #fff;
      text-align: center;
      font-size: 2rem;
      margin-bottom: 40px;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
    }

    /* Back button */
    .back-btn {
      display: inline-block;
      background: #fff;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      color: #333;
      font-weight: 600;
      margin-bottom: 30px;
      box-shadow: 0 4px 12px rgba(186, 24, 24, 0.15);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .back-btn:hover {
      background: #f0f0f0;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    /* PDF Grid */
    .pdf-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      width: 100%;
      max-width: 900px;
    }

    /* PDF Card */
    .pdf-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      padding: 24px 20px;
      text-align: center;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 180px;
    }

    .pdf-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 18px 32px rgba(0, 0, 0, 0.25);
    }

    .pdf-card h3 {
      color: #333;
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    .pdf-card button {
      display: inline-block;
      background: #4e54c8;
      color: #fff;
      padding: 10px 20px;
      border-radius: 12px;
      border: none;
      font-weight: 600;
      font-family: 'Noto Sans Bengali', sans-serif;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .pdf-card button:hover {
      background: #5ac8fa;
      transform: scale(1.05);
    }

    /* Full Page PDF Viewer - FULL WIDTH NO HEADER */
    .pdf-viewer-container {
      width: 100vw;
      height: 100vh;
      display: none;
      flex-direction: column;
     background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #a5d6a7 100%);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
    }

    .pdf-viewer-container.active {
      display: flex;
    }

    .pdf-header {
      display: none; /* HIDDEN */
    }

    /* Close button - Floating */
    .close-viewer {
      position: fixed;
      top: 20px;
      right: 20px;
      background: rgba(231, 76, 60, 0.9);
      border: none;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      padding: 10px 24px;
      border-radius: 8px;
      font-family: 'Noto Sans Bengali', sans-serif;
      font-weight: 600;
      transition: all 0.3s ease;
      z-index: 10000;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .close-viewer:hover {
      background: rgba(192, 57, 43, 1);
      transform: scale(1.05);
    }

    .pdf-content {
      flex: 1;
      width: 100%;
      height: 100vh;
      overflow: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 60px 20px 20px;
      position: relative;
    }

    .pdf-page {
      margin-bottom: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
      position: relative;
      max-width: 100%;
    }

    /* Watermark */
    .watermark {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-45deg);
      font-size: 72px;
      color: rgba(255, 255, 255, 0.08);
      pointer-events: none;
      z-index: 50;
      white-space: nowrap;
      font-weight: bold;
    }

    /* Loading spinner */
    .loading {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      font-size: 1.5rem;
      z-index: 10000;
    }

    .loading.active {
      display: block;
    }

    .spinner {
      border: 4px solid rgba(255, 255, 255, 0.3);
      border-top: 4px solid #fff;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 500px) {
      h1 {
        font-size: 1.6rem;
      }
      .pdf-card {
        height: auto;
        padding:10px;
      }
      .pdf-card h3 {
        font-size: 1rem;
      }
      .pdf-header h2 {
        font-size: 1rem;
      }
      .watermark {
        font-size: 36px;
      }
      .close-viewer {
        top: 10px;
        right: 10px;
        padding: 8px 16px;
        font-size: 14px;
      }
    }

    @media print {
      body { display: none !important; }
      * { display: none !important; }
    }
  </style>


<div id="body">
  <a class="back-btn" href="javascript:history.back()">← ফিরে যান</a>
  <h1></h1>

  <div class="pdf-grid">


    <?php  
    
    //  print_r($courses);

     foreach ($courses as $key => $value) {
      echo "
      
      <div class=\"pdf-card\">
      <h3> $value->name</h3>
      <button onclick=\"openPDFNewTab('$value->photo', '$value->name')\">দেখুন</button>
      </div>
      
      ";
     }
    
    
    
    ?>


  </div>

  <!-- Full Page PDF Viewer -->
  <div class="pdf-viewer-container" id="pdfViewerContainer">
    <button class="close-viewer" onclick="closeViewer()">✕ বন্ধ করুন</button>
    <div class="pdf-content" id="pdfContent">
      <div class="watermark">শুধুমাত্র দেখার জন্য</div>
    </div>
  </div>

  <div class="loading" id="loading">
    <div class="spinner"></div>
    <div>লোড হচ্ছে...</div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script>
    // PDF.js setup
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    let pdfDoc = null;
    let scale = 1.5;

    // Disable right-click
    document.addEventListener('contextmenu', e => {
      e.preventDefault();
      return false;
    });

    // Disable keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      // Ctrl+S, Ctrl+P, Ctrl+C
      if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p' || e.key === 'c')) {
        e.preventDefault();
        return false;
      }
      // F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
      if (e.keyCode === 123 || 
          (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) ||
          (e.ctrlKey && e.keyCode === 85)) {
        e.preventDefault();
        return false;
      }
    });

    // Prevent screenshot on Windows
    document.addEventListener('keyup', e => {
      if (e.key === 'PrintScreen') {
        navigator.clipboard.writeText('');
        alert('স্ক্রিনশট নেওয়া নিষিদ্ধ!');
      }
    });

    // Block printing
    window.onbeforeprint = function() {
      alert('প্রিন্ট করা নিষিদ্ধ!');
      return false;
    };

    // Render all pages
    async function renderAllPages(pdfContent) {
      const numPages = pdfDoc.numPages;
      
      for (let num = 1; num <= numPages; num++) {
        const page = await pdfDoc.getPage(num);
        const viewport = page.getViewport({ scale: scale });
        
        const canvas = document.createElement('canvas');
        canvas.className = 'pdf-page';
        const ctx = canvas.getContext('2d');
        
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        
        pdfContent.appendChild(canvas);
        
        const renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        
        await page.render(renderContext).promise;
      }
    }

    function openPDFNewTab(filename, title) {
      // Create new window/tab with this page
      const pdfUrl = `http://localhost/index.php/admin/admin/pdf/${filename}`;
      
      // Encode data in URL
      const viewerUrl = `${window.location.href.split('?')[0]}?pdf=${encodeURIComponent(pdfUrl)}&title=${encodeURIComponent(title)}`;
      window.open(viewerUrl, '_blank');
    }

    function closeViewer() {
      window.close();
      // If window.close() doesn't work (security restrictions)
      if (!window.closed) {
        window.history.back();
      }
    }

    // Check if this page should load a PDF
    window.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const pdfUrl = urlParams.get('pdf');
      const title = urlParams.get('title');
      
      if (pdfUrl && title) {
        // Hide main content, show viewer
        document.querySelector('.back-btn').style.display = 'none';
        document.querySelector('h1').style.display = 'none';
        document.querySelector('.pdf-grid').style.display = 'none';
        document.getElementById('pdfViewerContainer').classList.add('active');
        document.body.classList.add('pdf-viewer-page');

        // Hide header/footer if exists
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');
        if (header) header.style.display = 'none';
        if (footer) footer.style.display = 'none';
        
        // Update title
        document.title = decodeURIComponent(title);
        
        // Show loading
        document.getElementById('loading').classList.add('active');
        
        const pdfContent = document.getElementById('pdfContent');
        
        // Load PDF
        pdfjsLib.getDocument(decodeURIComponent(pdfUrl)).promise.then(pdf => {
          pdfDoc = pdf;
          // Clear loading message
          pdfContent.innerHTML = '<div class="watermark">শুধুমাত্র দেখার জন্য</div>';
          document.getElementById('loading').classList.remove('active');
          
          renderAllPages(pdfContent);
        }).catch(err => {
          document.getElementById('loading').classList.remove('active');
          alert('PDF লোড করতে সমস্যা হয়েছে: ' + err.message);
          window.close();
        });
      }
    });

  </script>

  </div>