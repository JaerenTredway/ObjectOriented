<?php
	namespace jtredway\ObjectOriented;

require_once("../classes/Author.php");
require_once("../classes/autoload.php");
	// use autoload via composer (PHP's package manager:
	require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");


	/*
	simplified attribute names:
		authorId
		authorAvatarUrl
		authorActivationToken
		authorEmail
		authorHash
		authorUsername
	*/
	/**
	 * New Author Generator
	 *
	 * This is a code that creates a new instance of the Author class with all of the attributes the database requires.
	 *
	 */
	$doyle = new Author(
		"fb766021-f5ab-4f64-8ef8-d5a333211741",
		"www.myAvatar.com/1",
		"nananananananananananananananana",
		"arthurConanDoyle@gmail.com",
		"nananananananananananananananananananananananananananananananananananananananananananananananana",
		"SirArthur"
	);

	//insert($doyle);
	
	var_dump($doyle);





