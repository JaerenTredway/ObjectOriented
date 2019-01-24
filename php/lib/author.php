<?php
	namespace jtredway\ObjectOriented;

//	require_once("Author.php");
//	require_once("../classes/autoload.php");
	require_once(dirname(__DIR__, 1) . "/classes/Author.php");


	/*
	simplified attribute names:
		authorId
		authorAvatarUrl
		authorActivationToken
		authorEmail
		authorHash
		authorUsername
	*/

	$doyle = new Author(
		"fb766021-f5ab-4f64-8ef8-d5a333211741",
		"www.myAvatar.com/1",
		"nananananananananananananananana",
		"arthurConanDoyle@gmail.com",
		"nananananananananananananananananananananananananananananananananananananananananananananananana",
		"SirArthur"
	);

	var_dump($doyle);





