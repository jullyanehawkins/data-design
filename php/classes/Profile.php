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

	public function getProfileId() {
		return $this->profileId;
	}

	public function setProfileId($profileId): void {
		$this->profileId = $profileId;
	}

	public function getProfileActivationToken() {
		return $this->profileActivationToken;
	}

	public function setProfileActivationToken($profileActivationToken): void {
		$this->profileActivationToken = $profileActivationToken;
	}

	public function getProfileAtHandle() {
		return $this->profileAtHandle;
	}

	public function setProfileAtHandle($profileAtHandle): void {
		$this->profileAtHandle = $profileAtHandle;
	}

	public function getProfileEmail() {
		return $this->profileEmail;
	}

	public function setProfileEmail($profileEmail): void {
		$this->profileEmail = $profileEmail;
	}

	public function getProfileHash() {
		return $this->profileHash;
	}

	public function setProfileHash($profileHash): void {
		$this->profileHash = $profileHash;
	}

	public function getProfileName() {
		return $this->profileName;
	}

	public function setProfileName($profileName): void {
		$this->profileName = $profileName;
	}

}