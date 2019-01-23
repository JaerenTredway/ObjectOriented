<?php
namespace jtredway\ObjectOriented;

require_once("../classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");

//use Ramsey\Uuid\Uuid;

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
	"0d5e6371ddb147e6814c188ce9c3e792",
	"www.myAvatar.com/1",
	"nananananananananananananananana",
	"arthurConanDoyle@gmail.com",
	"nananananananananananananananananananananananananananananananananananananananananananananananana",
	"SirArthur"
);

