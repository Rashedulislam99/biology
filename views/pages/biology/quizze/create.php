<?php
echo Page::title(["title"=>"Create Quizze"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"quizze", "text"=>"Manage Quizze"]);
echo Page::context_open();
echo Form::open(["route"=>"quizze/save"]);
	echo Form::input(["label"=>"Chapter","name"=>"chapter_id","table"=>"chapters"]);
	echo Form::input(["label"=>"Question","type"=>"textarea","name"=>"question"]);
	echo Form::input(["label"=>"Option A","type"=>"text","name"=>"option_a"]);
	echo Form::input(["label"=>"Option B","type"=>"text","name"=>"option_b"]);
	echo Form::input(["label"=>"Option C","type"=>"text","name"=>"option_c"]);
	echo Form::input(["label"=>"Option D","type"=>"text","name"=>"option_d"]);
	echo Form::input(["label"=>"Correct Ans","type"=>"text","name"=>"correct_ans"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
