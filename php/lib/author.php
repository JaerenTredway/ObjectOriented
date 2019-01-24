<?php
	namespace jtredway\ObjectOriented;

	require_once("../classes/autoload.php");
	require_once(dirname(__DIR__, 2) . "/php/classes/autoload.php");

	use Ramsey\Uuid\Uuid;

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

	echo $doyle;




