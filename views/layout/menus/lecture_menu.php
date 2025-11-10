<?php
	echo Menu::item([
		"name"=>"Lecture",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"lecture/create","text"=>"Create Lecture","icon"=>"far fa-circle nav-icon"],
			["route"=>"lecture","text"=>"Manage Lecture","icon"=>"far fa-circle nav-icon"],
		]
	]);
