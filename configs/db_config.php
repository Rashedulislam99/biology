<?php   
   //Remote
   
    //  define("SERVER","localhost");
    //  define("USER","root");
    //  define("DATABASE","biology_academy");
    //  define("PASSWORD","");

   //Local
   
    define("SERVER","localhost");
    define("USER","root");//rajib
    define("DATABASE","admin2");
    define("PASSWORD","");



    // define("SERVER","localhost");
    // define("USER","rashedul");//rajib
    // define("DATABASE","wdpf66_rashedul");
    // define("PASSWORD","7057@;;");

    $db=new mysqli(SERVER,USER,PASSWORD,DATABASE);
    $tx="bio_";

   
  

?>