<?php
namespace Edu\Cnm\jhawkins20\DataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__) . "../vendor/autoload.php");
use Edu\Cnm\DataDesign\ValidateUuid;
use Ramsey\Uuid\Uuid;
/**
 * Small Cross Section of a "Filmow" Ratings
 *
 * This is a cross section of what is stored in the database of a profile on filmow.com.
 *
 * @author Jullyane Hawkins <jhawkins20@cnm.edu>
 * @version 4.0.0
 **/
// The JsonSerializable is when you agree to implement the contract. JsonSerialize saves you the time of writing out the JSON code.
class Ratings implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * date when the movie was rated
	 * @var Uuid $ratingsDate
	 **/
	private $ratingsDate;
	/**
	 * id of the movie that this ratings is for; this is a foreign key
	 * @var Uuid $ratingsMovieId
	 **/
	private $ratingsMovieId;
	/**
	 * id of the Profile that sent this ratings; this is a foreign key
	 * @var Uuid $ratingsProfileId
	 **/
	private $ratingsProfileId;

	/**
	 * constructor for ratings
	 *
	 * @param string|Uuid $newRatingsDate id of this ratings or null if a new ratings
	 * @param string|Uuid $newRatingsMovieId id of the movie that was ratingsped
	 * @param string|Uuid $newRatingsProfileId id of the profile that ratingsped the movie
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation Documentation on Constructors and Destructors https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newRatingsDate, $newRatingsMovieId, $newRatingsProfileId) {
		try {
			$this->setRatingsDate($newRatingsDate);
			$this->setRatingsMovieId($newRatingsMovieId);
			$this->setRatingsProfileId($newRatingsProfileId);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for ratings id
	 *
	 * @return Uuid value of ratings id
	 **/
	public function getRatingsDate() : Uuid{
		return($this->ratingsDate);
	}
	/**
	 * mutator method for ratings id
	 *
	 * @param int|Uuid $newRatingsDate new value of ratingsDate
	 * @throws \RangeException if $newRatingsDate is not positive
	 * @throws \TypeError if data types violate type hints
	 **/
	public function setRatingsDate($newRatingsDate) : void {
		try {
			$uuid = self::validateUuid($newRatingsDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the ratings id
		$this->ratingsDate = $uuid;
	}

	/**
	 * accessor method for ratings movie id
	 *
	 * @return Uuid value of ratings movie id
	 **/
	public function getRatingsMovieId() : Uuid{
		return($this->ratingsMovieId);
	}
	/**
	 * mutator method for ratings movie id
	 *
	 * @param string | Uuid $newRatingsMovieId new value of ratings movie id
	 * @throws \RangeException if $newRatingsMovieId is not positive
	 * @throws \TypeError if data types violate type hints
	 **/
	public function setRatingsMovieId($newRatingsMovieId) : void {
		try {
			$uuid = self::validateUuid($newRatingsMovieId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->ratingsMovieId = $uuid;
	}
	/**
	 * accessor method for ratings profile id
	 *
	 * @return Uuid value of ratings profile id
	 **/
	public function getRatingsProfileId() : Uuid{
		return($this->ratingsProfileId);
	}
	/**
	 * mutator method for ratings profile id
	 *
	 * @param string|Uuid $newRatingsProfileId new value of ratings profile id
	 * @throws \RangeException if $newRatingsProfileId is not positive
	 * @throws \TypeError if data types violate type hints
	 **/
	public function setRatingsProfileId($newRatingsProfileId) : void {
		try {
			$uuid = self::validateUuid($newRatingsProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->ratingsProfileId = $uuid;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	// organize the state variables into an array:
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["ratingsDate"] = $this->ratingsDate->toString();
		$fields["ratingsMovieId"] = $this->ratingsMovieId->toString();
		$fields["ratingsProfileId"] = $this->ratingsProfileId->toString();

		//format the date so that the frontend can consume it
		// I don't currently have a date attribute relating to the profile entity in my ERD, so I'm commenting the following code out for now. 1/23/18
		// $fields["movieDateTime"] = round(floatval($this->movieDateTime->format("U.u")) * 1000);
		return($fields);
	}
}

