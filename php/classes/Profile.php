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
	 * id for this profile: this is the primary key
	 * @var Uuid $profileId //I need to learn what this means, writing it here based on the example
	 **/
	private $profileId;
	/** token handed out to verify that account is not malicious
	* @var string $profileActivationToken //?
	**/
	private $profileActivationToken;
	/**
	 * email associated with this profile; this is a unique index
	 * @var string $profileEmail //?
	 **/
	private $profileEmail;
	/**
	 * hash for profile password
	 * @var string $profileHash //?
	 **/
	private $profileHash;
	/**
	 * name stored for this profile
	 * @var string $profileName //?
	 **/
	private $profileName;
	/**
	 * accessor method for getting profileId
	 *
	 * @return Uuid value for profileId (or null if new profile)
	 **/
	public function getProfileId() {
		return $this->profileId;
	}
	/**
	 * mutator method for profileId
	 *
	 * @param Uuid|string $newProfileId with the value of profileId
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError id profile id is not positive
	 **/
	public function setProfileId($profileId): void {
		$this->profileId = $profileId;
	}
	/**
	* accessor method for account activation token
	*
	* @return string value of the activation token
	**/
	public function getProfileActivationToken() {
		return $this->profileActivationToken;
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 **/
	public function setProfileActivationToken($profileActivationToken): void {
		$this->profileActivationToken = $profileActivationToken;
	}
	/**
	 * accessor method for profile email
	 *
	 * @return string value of profile email
	 **/
	public function getProfileEmail() {
		return $this->profileEmail;
	}
	/**
	 * mutator method for profile email
	 *
	 * @param string $newProfileEmail new value of profile email
	 * @throws \InvalidArgumentException if $newEmail is not a valid profile email or insecure
	 * @throws \RangeException if $newProfileEmail is > 128 characters
	 * @throws \TypeError if $newProfileEmail is not a string
	 **/
	public function setProfileEmail($profileEmail): void {
		$this->profileEmail = $profileEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of profile hash
	 **/
	public function getProfileHash() {
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
	public function setProfileHash($profileHash): void {
		$this->profileHash = $profileHash;
	}
	/**
	 * accessor method for profile name
	 *
	 * @return string value
	 **/
	public function getProfileName() {
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
	public function setProfileName($profileName): void {
		$this->profileName = $profileName;
	}

}