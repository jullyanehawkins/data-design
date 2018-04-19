<?php
/**
 * Small Cross Section of a "Filmow" Profile
 *
 * This is a cross section of what is stored in the database of a profile on filmow.com.
 *
 * @author Jullyane Hawkins <jhawkins20@cnm.edu>
 * @version 4.0.0
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
	private $profileAtHandle;
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
	 * @return mixed
	 */
	public function getProfileId() {
		return $this->profileId;
	}

	/**
	 * @param mixed $profileId
	 */
	public function setProfileId($profileId): void {
		$this->profileId = $profileId;
	}

	/**
	 * @return mixed
	 */
	public function getProfileActivationToken() {
		return $this->profileActivationToken;
	}

	/**
	 * @param mixed $profileActivationToken
	 */
	public function setProfileActivationToken($profileActivationToken): void {
		$this->profileActivationToken = $profileActivationToken;
	}

	/**
	 * @return mixed
	 */
	public function getProfileAtHandle() {
		return $this->profileAtHandle;
	}

	/**
	 * @param mixed $profileAtHandle
	 */
	public function setProfileAtHandle($profileAtHandle): void {
		$this->profileAtHandle = $profileAtHandle;
	}

	/**
	 * @return mixed
	 */
	public function getProfileEmail() {
		return $this->profileEmail;
	}

	/**
	 * @param mixed $profileEmail
	 */
	public function setProfileEmail($profileEmail): void {
		$this->profileEmail = $profileEmail;
	}

	/**
	 * @return mixed
	 */
	public function getProfileHash() {
		return $this->profileHash;
	}

	/**
	 * @param mixed $profileHash
	 */
	public function setProfileHash($profileHash): void {
		$this->profileHash = $profileHash;
	}

	/**
	 * @return mixed
	 */
	public function getProfileName() {
		return $this->profileName;
	}

	/**
	 * @param mixed $profileName
	 */
	public function setProfileName($profileName): void {
		$this->profileName = $profileName;
	}

}