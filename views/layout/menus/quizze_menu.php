<?php
	echo Menu::item([
		"name"=>"Quizze",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"quizze/create","text"=>"Create Quizze","icon"=>"far fa-circle nav-icon"],
			["route"=>"quizze","text"=>"Manage Quizze","icon"=>"far fa-circle nav-icon"],
		]
	]);
