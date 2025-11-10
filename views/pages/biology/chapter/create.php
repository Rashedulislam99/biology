<?php
echo Page::title(["title"=>"Create Chapter"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"chapter", "text"=>"Manage Chapter"]);
echo Page::context_open();
echo Form::open(["route"=>"chapter/save"]);
	echo Form::input(["label"=>"Subject","name"=>"subject_id","table"=>"subjects"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"PDF","type"=>"file","name"=>"photo"]);
	echo Form::input(["label"=>"Folder Name","type"=>"text","name"=>"folder_name"]);
	echo Form::input(["label"=>"Paper","name"=>"paper_id","table"=>"papers"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
