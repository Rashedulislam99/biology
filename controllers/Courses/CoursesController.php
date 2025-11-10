<?php
class CoursesController{
    public function __construct(){

    }

    


    public function index(){
       view("Courses");
    }

    public function biology(){
       view("Courses");
    }
    public function lecture($id){
       
     $data= Lecture::all_chapter_id($id);


      view("Courses", $data);
      // print_r($id);
    }

     public function biologySecond(){
       view("Courses");
    }
     public function chapter1(){
       view("Courses");
    }

    public function achapter2(){
       view("Courses");
    }


   



    // public function view(){
    //     $base_url = "http://localhost/Biology_JR/admin/admin";
    //     view("Courses", ['base_url' => $base_url]);
    // }
  

    
}

?>