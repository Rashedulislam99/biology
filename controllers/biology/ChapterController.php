<?php
class ChapterController extends Controller{

    private $now;

    public function __construct(){
        date_default_timezone_set("Asia/Dhaka");
        $this->now = date("Y-m-d H:i:s");
    }

    public function index(){
        view("biology");
    }

    public function create(){
        view("biology");
    }

    public function save($data,$file){
        if(isset($data["create"])){

            $errors = [];

            if(count($errors) == 0){

                $chapter = new Chapter();
                $chapter->subject_id  = $data["subject_id"];
                $chapter->name        = $data["name"];
                $chapter->photo       = File::upload($file["photo"], "img");
                $chapter->folder_name = $data["folder_name"];
                $chapter->paper_id    = $data["paper_id"];
                $chapter->created_at  = $this->now;

                $chapter->save();
                redirect();

            }else{
                print_r($errors);
            }
        }
    }

    public function edit($id){
        view("biology", Chapter::find($id));
    }

    public function update($data,$file){
        if(isset($data["update"])){

            $errors = [];

            if(count($errors) == 0){

                $old = Chapter::find($data["id"]);

                $chapter = new Chapter();
                $chapter->id          = $data["id"];
                $chapter->subject_id  = $data["subject_id"];
                $chapter->name        = $data["name"];

                if($file["photo"]["name"] != ""){
                    $chapter->photo = File::upload($file["photo"], "img", $data["id"]);
                }else{
                    $chapter->photo = $old->photo;
                }

                $chapter->folder_name = $data["folder_name"];
                $chapter->paper_id    = $data["paper_id"];
                $chapter->created_at  = $old->created_at; // created_at change হবে না

                $chapter->update();
                redirect();

            }else{
                print_r($errors);
            }
        }
    }

    public function confirm($id){
        view("biology");
    }

    public function delete($id){
        Chapter::delete($id);
        redirect();
    }

    public function show($id){
        view("biology", Chapter::find($id));
    }
}
?>
