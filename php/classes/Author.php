<?php
namespace jtredway\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");

//use Ramsey\Uuid\Uuid;

/**
 * Object-oriented assignment for DeepDive
 *
 * This assignment creates a mySQL table of authors and builds a PHP program
 * that populates and manipulates the table.
 *
 * @author Will Tredway <jtredway@cnm.edu>
 * @version 1.0.0
 **/
class Author {
	use ValidateDate;
	use ValidateUuid;

	/* The database attributes:
authorId binary(16) not null,
authorAvatarUrl varchar(255),
authorActivationToken char(32),
authorEmail varchar(128) not null,
authorHash char(97) not null,
authorUsername varchar(32) not null,
unique(authorEmail),
unique(authorUsername),
INDEX(authorEmail),
primary key(authorId)

simplified attribute names:
	authorId
	authorAvatarUrl
	authorActivationToken
	authorEmail
	authorHash
	authorUsername
	*/

	/**
	 * the author's ID; this is the primary key
	 * @var string $authorId
	 **/
	private $authorId;

	/**
	 * the URL that links to the author's avatar image file
	 * @var string authorAvatarUrl
	 **/
	private $authorAvatarUrl;

	/**
	 * the author's activation token
	 * @var string $authorActivationToken
	 **/
	private $authorActivationToken;

	/**
	 * the author's email address
	 * @var string authorEmail
	 **/
	private $authorEmail;

	/**
	 * the author's hash
	 * @var string $authorHash
	 **/
	private $authorHash;

	/**
	 * the author's user name
	 * @var string $authorUsername
	 **/
	private $authorUsername;


	/* START CONSTRUCTOR METHOD*/
	/**
	 * constructor for each new author object/ instance/ record
	 *
	 * @param string $newAuthorId id of this author
	 * @param string $newAuthorAvatarUrl url of the avatar image
	 * @param string $newAuthorActivationToken string containing activation token
	 * @param string $newAuthorEmail author's email address
	 * @param string $newAuthorHash string containing hash (password)
	 * @param string $newAuthorUsername author's user name
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newAuthorId, $newAuthorAvatarUrl, $newAuthorActivationToken, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	} /* END CONSTRUCTOR METHOD*/


	/* START AUTHOR ID METHODS*/
	/**
	 * GETTER accessor method for author id
	 *
	 * @return string value of author id
	 **/
	public function getAuthorId(): string {
		return ($this->authorId);
	}

	/**
	 * SETTER mutator method for author id
	 *
	 * @param string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/
	public function setAuthorId($newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author id
		$this->authorId = $uuid;
	}
	/* END AUTHOR ID METHODS*/


	/* START AVATAR URL METHODS*/
	/**
	 * GETTER accessor method for avatar url
	 *
	 * @return string value of avatar url
	 **/
	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}

	/**
	 * SETTER mutator method for avatar url
	 *
	 * @param string $newAuthorAvatarUrl new value of avatar url
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
	 * @throws \RangeException if $newAuthorAvatarUrl is > 140 characters
	 * @throws \TypeError if $newAuthorAvatarUrl is not a string
	 **/
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl): void {
		// verify the avatar url content is secure
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new \InvalidArgumentException("avatar url is empty or insecure"));
		}

		// verify the avatar url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("url too large"));
		}

		// store the avatar url
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	/* END AVATAR URL METHODS*/


	/* START ACTIVATION TOKEN METHODS*/
	/**
	 * GETTER accessor method for activation token
	 *
	 * @return string value of activation token
	 **/
	public function getAuthorActivationToken(): string {
		return ($this->authorActivationToken);
	}

	/**
	 * SETTER mutator method for activation token
	 *
	 * @param string $newAuthorActivationToken new value of activation token
	 * @throws \InvalidArgumentException if $newAuthorActivationToken is not a string or insecure
	 * @throws \RangeException if $newAuthorActivationToken is > 32 characters
	 * @throws \TypeError if $newAuthorActivationToken is not a string
	 **/
	public function setAuthorActivationToken(string $newAuthorActivationToken): void {
		// verify the activation token is secure
		$newAuthorActivationToken = trim($newAuthorActivationToken);
		$newAuthorActivationToken = filter_var($newAuthorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorActivationToken) === true) {
			throw(new \InvalidArgumentException("activation token is empty or insecure"));
		}

		// verify the activation token will fit in the database
		if(strlen($newAuthorActivationToken) > 255) {
			throw(new \RangeException("activation token too large"));
		}

		// store the activation token
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/* END ACTIVATION TOKEN METHODS*/


	/* START EMAIL METHODS*/
	/**
	 * GETTER accessor method for author email
	 *
	 * @return string value of author email
	 **/
	public function getAuthorEmail(): string {
		return ($this->authorEmail);
	}

	/**
	 * SETTER mutator method for author email
	 *
	 * @param string $newAuthorEmail new value of author email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a string or insecure
	 * @throws \RangeException if $newAuthorEmail is > 140 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 **/
	public function setAuthorEmail(string $newAuthorEmail): void {
		// verify the email content is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}

		// verify the author email will fit in the database
		if(strlen($newAuthorEmail) > 255) {
			throw(new \RangeException("author email too large"));
		}

		// store the author email
		$this->authorEmail = $newAuthorEmail;
	}
	/* END EMAIL METHODS*/


	/* START HASH METHODS*/
	/**
	 * GETTER accessor method for author's hash (password)
	 *
	 * @return string value of author's hash (password)
	 **/
	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 * SETTER mutator method for author's hash (password)
	 *
	 * @param string $newAuthorHash new value of author's hash (password)
	 * @throws \InvalidArgumentException if $newAuthorHash is not a string or insecure
	 * @throws \RangeException if $newAuthorHash is > 97 characters
	 * @throws \TypeError if $newAuthorHash is not a string
	 **/
	public function setAuthorHash(string $newAuthorHash): void {
		// verify the hash is secure
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = filter_var($newAuthorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author's hash (password) is empty or insecure"));
		}

		// verify the author's hash (password) url will fit in the database
		if(strlen($newAuthorHash) > 97) {
			throw(new \RangeException("author's hash (password) too large"));
		}

		// store the author's hash (password)
		$this->authorHash = $newAuthorHash;
	}
	/* END HASH METHODS*/


	/* START USERNAME METHODS*/
	/**
	 * GETTER accessor method for author's username
	 *
	 * @return string value of author's username
	 **/
	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}

	/**
	 * SETTER mutator method for author's username
	 *
	 * @param string $newAuthorUsername new value of author's username
	 * @throws \InvalidArgumentException if $newAuthorUsername is not a string or insecure
	 * @throws \RangeException if $newAuthorUsername is > 140 characters
	 * @throws \TypeError if $newAuthorUsername is not a string
	 **/
	public function setAuthorUsername(string $newAuthorUsername): void {
		// verify the author's username is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("author's username is empty or insecure"));
		}

		// verify the author's username will fit in the database
		if(strlen($newAuthorUsername) > 255) {
			throw(new \RangeException("author's username too large"));
		}

		// store the author's username
		$this->authorUsername = $newAuthorUsername;
	}
	/* END USER NAME METHODS*/

}



