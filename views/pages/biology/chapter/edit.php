<?php
echo Page::title(["title"=>"Edit Chapter"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"chapter", "text"=>"Manage Chapter"]);
echo Page::context_open();
echo Form::open(["route"=>"chapter/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$chapter->id"]);
	echo Form::input(["label"=>"Subject","name"=>"subject_id","table"=>"subjects","value"=>"$chapter->subject_id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$chapter->name"]);
	echo Form::input(["label"=>"PDF","type"=>"file","name"=>"photo","value"=>$chapter->photo]);
	echo Form::input(["label"=>"Folder Name","type"=>"text","name"=>"folder_name","value"=>"$chapter->folder_name"]);
	echo Form::input(["label"=>"Paper","name"=>"paper_id","table"=>"papers","value"=>"$chapter->paper_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
