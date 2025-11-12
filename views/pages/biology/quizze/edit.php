<?php
echo Page::title(["title"=>"Edit Quizze"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"quizze", "text"=>"Manage Quizze"]);
echo Page::context_open();
echo Form::open(["route"=>"quizze/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$quizze->id"]);
	echo Form::input(["label"=>"Chapter","name"=>"chapter_id","table"=>"chapters","value"=>"$quizze->chapter_id"]);
	echo Form::input(["label"=>"Question","type"=>"textarea","name"=>"question","value"=>"$quizze->question"]);
	echo Form::input(["label"=>"Option A","type"=>"text","name"=>"option_a","value"=>"$quizze->option_a"]);
	echo Form::input(["label"=>"Option B","type"=>"text","name"=>"option_b","value"=>"$quizze->option_b"]);
	echo Form::input(["label"=>"Option C","type"=>"text","name"=>"option_c","value"=>"$quizze->option_c"]);
	echo Form::input(["label"=>"Option D","type"=>"text","name"=>"option_d","value"=>"$quizze->option_d"]);
	echo Form::input(["label"=>"Correct Ans","type"=>"text","name"=>"correct_ans","value"=>"$quizze->correct_ans"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
