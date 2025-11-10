<?php
	echo Menu::item([
		"name"=>"Chapter",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"chapter/create","text"=>"Create Chapter","icon"=>"far fa-circle nav-icon"],
			["route"=>"chapter","text"=>"Manage Chapter","icon"=>"far fa-circle nav-icon"],
		]
	]);
