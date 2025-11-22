<?php
//URL Functions 
function slugify($text, string $divider = '-'){
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
  
    // trim
    $text = trim($text, $divider);
  
    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);
  
    // lowercase
    $text = strtolower($text);
  
    if (empty($text)) {
      return 'n-a';
    }
  
    return $text;
  }



  function slugify2($text, string $divider = '-') {

    // Replace any non-letter/digit with divider
    $text = preg_replace('~[^\p{L}\p{N}]+~u', $divider, $text);

    // Normalize Bangla and other Unicode characters
    if (class_exists('Transliterator')) {
        // Optional: convert spaces, normalize forms (keeps Bengali)
        $transliterator = Transliterator::create('NFD; [:Nonspacing Mark:] Remove; NFC');
        $text = $transliterator->transliterate($text);
    }

    // Trim dividers from start and end
    $text = trim($text, $divider);

    // Remove duplicate dividers
    $text = preg_replace('~' . preg_quote($divider, '~') . '+~', $divider, $text);

    // Lowercase (Unicode aware)
    $text = mb_strtolower($text, 'UTF-8');

    return $text ?: 'n-a';
}





?>