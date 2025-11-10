<?php
	echo Menu::item([
		"name"=>"Subject",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"subject/create","text"=>"Create Subject","icon"=>"far fa-circle nav-icon"],
			["route"=>"subject","text"=>"Manage Subject","icon"=>"far fa-circle nav-icon"],
		]
	]);
