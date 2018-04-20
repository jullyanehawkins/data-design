<?php
/**
 * Small Cross Section of a "Filmow" Profile
 *
 * This is a cross section of what is stored in the database of a profile on filmow.com.
 *
 * @author Jullyane Hawkins <jhawkins20@cnm.edu>
 * @version 1.0.0
 **/

class Profile {
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