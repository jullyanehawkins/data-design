<?php
namespace Edu\Cnm\jhawkins20\DataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__) . "../vendor/autoload.php");
use Edu\Cnm\DataDesign\ValidateUuid;
use Ramsey\Uuid\Uuid;
/**
 * Small Cross Section of a "Filmow" Profile
 *
 * This is a cross section of what is stored in the database of a profile on filmow.com.
 *
 * @author Jullyane Hawkins <jhawkins20@cnm.edu>
 * @version 2.0.0
 **/
class Profile implements \JsonSerializable {
	use \Edu\Cnm\DataDesign\ValidateUuid;
	/**
	 * id for this profile: this is the primary key and it's an unique index
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/** token handed out to verify that account is not malicious
	* @var Uuid $profileActivationToken
	**/
	private $profileActivationToken;
	/**
	 * email associated with this profile; this is a unique index
	 * @var Uuid $profileEmail
	 **/
	private $profileEmail;
	/**
	 * hash for profile password
	 * @var mixed $profileHash
	 **/
	private $profileHash;
	/**
	 * name stored for this profile
	 * @var string $profileName
	 **/
	private $profileName;

	/**
	 * constructor for this Profile
	 *
	 * @param string|Uuid $newProfileId id of this Profile or null if a new Profile
	 * @param int $newProfileActivationToken integer verifying the profile user
	 * @param string $newProfileEmail string of user's email address
	 * @param $newProfileHash
	 * @param string $newProfileName string of the user's profile name
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, $newProfileActivationToken, string $newProfileEmail, $newProfileHash, $newProfileName) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileName($newProfileName);
		}
			//determine what exception type was thrown. List in priority order.
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			//rethrow the exception. Constructors are not the place to take action on exceptions, we want to "pass the buck."
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for profileId
	 *
	 * @return Uuid value of profileId
	 **/
	public function getProfileId(): Uuid {
		return $this->profileId;
	}
	/**
	 * mutator method for profileId
	 *
	 * @param Uuid $newProfileId new value of profileId
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a uuid
	 **/
	public function setProfileId($newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}
	/**
	* accessor method for account activation token
	*
	* @return Uuid value of the activation token
	**/
	public function getProfileActivationToken(): Uuid {
		return $this->profileActivationToken;
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param Uuid $newProfileActivationToken
	 * @throws \InvalidArgumentException  if the token is not Uuid
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not Uuid
	 **/
	public function setProfileActivationToken($newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}
	/**
	 * accessor method for profile email
	 *
	 * @return Uuid value of profile email
	 **/
	public function getProfileEmail(): Uuid {
		return $this->profileEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param Uuid|string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a uuid or string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		// store the email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of profile hash
	 **/
	public function getProfileHash(): string {
		return $this->profileHash;
	}
	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for profile name
	 *
	 * @return string value
	 **/
	public function getProfileName(): string {
		return $this->profileName;
	}
	/**
	 * mutator method for profile name
	 *
	 * @param string $newProfileName new value of name
	 * @throws \InvalidArgumentException if $newName is not a string or insecure
	 * @throws \RangeException if $newName is > 32 characters
	 * @throws \TypeError if $newName is not a string
	 **/
	public function setProfileName(string $newProfileName): void {
		//if $profileName is null return it right away
		if($newProfileName === null) {
			$this->profileName = null;
			return;
		}
		// verify the name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("profile name is empty or insecure"));
		}
		// verify the name will fit in the database
		if(strlen($newProfileName) > 32) {
			throw(new \RangeException("profile name is too large"));
		}
		// store the name
		$this->profileName = $newProfileName;
	}
}
/**
 * inserts the entire class of "profile" into mySQL
 *
 * @param \PDO $pdo PDO live connection to the database
 * @throws \PDOException when mySQL related error occurs. PDO's own label of exception.
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo) : void {
	//creates query template
	$query = "INSERT INTO profile(profileId, profileActivationToken, profileEmail, profileName) VALUES (:profileId, :profileActivationToken, :profileEmail, :profileName)";
	$statement = $pdo->prepare($query);
	//bind the member variables to the place holders in the template
	$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken->getBytes(), "profileEmail" => $this->profileEmail, "profileName" => $this->profileName];
	$statement->execute($parameters);
}
/**
 * deletes this profileId row from mySQL
 *
 * @param \PDO $pdo PDO connection object
 *
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo) : void {
	// creates a query template
	$query = "DELETE FROM profile WHERE profileId = :profileId";
	$statement = $pdo->prepare($query);
	// bind the member variables to the place holder in the template.
	$parameters = ["profileId" => $this->profileId->getBytes()];
	$statement->execute($parameters);
}
/**
 * updates this profile in mySQL
 *
 * @param \PDO $pdo PDO connection object
 *
 * @throws \PDOException when mySQL related errors occur
 * @thows \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo): void {
	//create query template
	$query = "UPDATE profile SET profileActivationToken = :profileActivationToken, profileEmail = :profileEmail, profileName = :profileName WHERE profileId = :profileId";
	$statement = $pdo->prepare($query);
	$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileProfileId->getBytes(), "profileEmail" => $this->profileEmail, "profileName" => $this->profileName];
	$statement->execute($parameters);
}
/**
 * gets the profile by profileId
 *
 * @param \PDO $pdo PDO connection object
 * @param Uuid|string $profileId profile id to search for
 *
 * @return Profile|null profile found or null if not found
 *
 * @throws \PDOException when mySQL related error occur
 * @throws \TypeError when a variable are not the correct data type
 **/
public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
	// sanitize the profileId before searching
	try {
		$profileId = self::validateUuid($profileId);
	}
	catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception)
	{
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	//create query template
	$query = "SELECT profileId, profileActivationToken, profileEmail, profileName FROM profile WHERE profileId = :profileId";
	$statement = $pdo->prepare($query);
	//bind the profile id to the placeholder in the template
	$parameters = ["profileId" => $profileId->getBytes()];
	$statement->execute($parameters);
	//grab the profile from mySQL
	try {
		$profile = null;
		//give results in the "associative array" format; grabs results one row at a time and returns false when done.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if ($row !== false) {
			$profile = new Profile ($row["profileId"], $row["profileActivationToken"], $row["profileEmail"], $row["profileName"]);
		}
	}
		//a fail safe to catch any further issues
	catch(\Exception $exception) {
		//if the row couldn't be converted, re-throw it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return($profile);
}
/**
 * gets the profile by ProfileEmail
 *
 * @param \PDO $pdo PDO connection object
 * @param Uuid|string $profileId profile id to search for
 *
 * @return Profile|null profile found or null if not found
 *
 * @throws \PDOException when mySQL related error occur
 * @throws \TypeError when a variable are not the correct data type
 **/
public static function getProfileByProfileEmail(\PDO $pdo, $profileId) : ?Profile {
	// sanitize the profileId before searching
	try {
		$profileEmail = self::validateUuid($profileEmail);
	}
	catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception)
	{
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	//create query template
	$query = "SELECT profileId, profileActivationToken, profileEmail, profileName FROM profile WHERE profileEmail = :profileEmail";
	$statement = $pdo->prepare($query);
	//bind the profile id to the placeholder in the template
	$parameters = ["profileEmail" => $profileEmail->getBytes()];
	$statement->execute($parameters);
	//grab the profile from mySQL
	try {
		$profile = null;
		//give results in the "associative array" format; grabs results one row at a time and returns false when done.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if ($row !== false) {
			$profileEmail = new ProfileEmail ($row["profileId"], $row["profileActivationToken"], $row["profileEmail"], $row["profileName"]);
		}
	}
		//a fail safe to catch any further issues
	catch(\Exception $exception) {
		//if the row couldn't be converted, re-throw it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return($profileEmail);
}
/**
 * gets all profiles
 *
 * @param \PDO $pdo PDO connection object
 *
 * @return \SplFixedArray SplFixedArray of profiles found or null if not found
 *
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getAllProfiles(\PDO $pdo) : \SPLFixedArray {
	//create a query template
	$query = "SELECT profileId, profileActivationToken, profileEmail, profileName FROM profile";
	$statement = $pdo->prepare($query);
	$statement->execute();
	//builds an array of profiles
	$profiles = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$profile = new Profile ($row ["profileId"], $row["profileActivationToken"], $row["profileEmail"], $row["profileName"]);
			$profiles[$profiles->key()] = $profile;
			$profiles->next();
		}
		catch(\Exception $exception){
			//if the row couldn't be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return ($profiles);
}
/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
// organize the state variables into an array:
public function jsonSerialize() : array {
	$fields = get_object_vars($this);
	$fields["profileId"] = $this->profileId->toString();
	// I had initially included profileActivationToken, but learned that you don't want anything that's a security risk to be included in JSON (like activation token, hash, salt, email). Commenting out to keep for reference.
	//format the date so that the frontend can consume it
	// I don't currently have a date attribute relating to the profile entity in my ERD, but I want to keep the following code for reference. 1/23/18
	//$fields["profileDate"] = round(floatval($this->profileDate->format("U.u")) * 1000);
	// unset the aspects we don't want to be public
	unset($fields["profileHash"]);
	unset($fields["profileSalt"]);
	return($fields);
}