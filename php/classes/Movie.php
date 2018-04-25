<?php
namespace Edu\Cnm\jhawkins20\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__) . "autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Small Cross Section of a "Filmow" Movie
 *
 * This is a cross section of what is stored in the database of a profile on filmow.com.
 *
 * @author Jullyane Hawkins <jhawkins20@cnm.edu>
 * @version 4.0.0
 * @package Edu\Cnm\DataDesign
 **/

class Movie implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this movie: primary key
	 * @var Uuid $movieID
	 **/
	private $movieId; // these private variables are the state variables 1/21
	/**
	 * movie name
	 * @var Uuid $movieName
	 **/
	private $movieName;
	/**
	 * text Director of the movie
	 * @var string $movieDirector
	 **/
	private $movieDirector;
	/**
	 * movie genre
	 * @var \string $movieGenre
	 **/
	private $movieGenre;
	/**
	 * the Length of the movie
	 * @var string $movieLength
	 */
	private $movieLength;
	/**
	 * constructor for this movie
	 *
	 * @param string|Uuid $newMovieId id of this movie or null if a new movie
	 * @param string|Uuid $newMovieName id of the Profile that sent this movie
	 * @param string $newMovieDirector string containing actual movie data
	 * @param \string string|null $newMovieGenre, the date and time movie was sent or null if set to current date and time
	 * @param string $newMovieLength string containing Length of the movie
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation Documentation on Constructors and Destructors https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newMovieId, $newMovieName, string $newMovieDirector, $newMovieGenre = null, string $newMovieLength) {
		try {
			$this->setMovieId($newMovieId);
			$this->setMovieName($newMovieName);
			$this->setMovieDirector($newMovieDirector);
			$this->setMovieGenre($newMovieGenre);
			$this->setMovieLength($newMovieLength);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for movie id
	 *
	 * @return Uuid value of movie id
	 **/
	public function getMovieId(): Uuid {
		return ($this->movieId);
	}
	/**
	 * mutator method for movie id
	 *
	 * @param Uuid/string $newMovieId new value of movie id
	 * @throws \RangeException if $newMovieId is not positive
	 * @throws \TypeError if $newMovieId is not a uuid or string
	 **/
	public function setMovieId($newMovieId) : void {
		try {
			$uuid = self::validateUuid($newMovieId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the movie id
		$this->movieId = $uuid;
	}
	/**
	 * accessor method for movie author's profile id
	 *
	 * @return Uuid value of movie author's profile id
	 **/
	public function getMovieName(): Uuid {
		return ($this->movieName);
	}
	/**
	 * mutator method for movie author's profile id
	 *
	 * @param string | Uuid $newMovieName new value of movie author's profile id
	 * @throws \RangeException if $newName is not positive
	 * @throws \TypeError if $newMovieName is not an integer
	 **/
	public function setMovieName($newMovieName) : void {
		try {
			$uuid = self::validateUuid($newMovieName);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->movieName = $uuid;
	}
	/**
	 * accessor method for movie Director
	 *
	 * @return string value of aricle Director
	 **/
	public function getMovieDirector(): string {
		return ($this->movieDirector);
	}
	/**
	 * mutator method for movie Director
	 *
	 * @param string $newMovieDirector new value of movie Director
	 * @throws \InvalidArgumentException if $enwMovieDirector is not a string or insecure
	 * @throws \RangeException if $newMovieDirector is > 140 characters (unrealistic, but that is how I build the database)
	 * @throws \TypeError if $newMovieDirector is not a string
	 **/
	public function setMovieDirector(string $newMovieDirector) : void {
		// verify the movie Director is secure
		$newMovieDirector = trim($newMovieDirector);
		$newMovieDirector = filter_var($newMovieDirector, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newMovieDirector) === true) {
			throw(new \InvalidArgumentException("movie Director is empty or insecure"));
		}
		// verify the movie Director will fit in the database
		if(strlen($newMovieDirector) > 140) {
			throw(new \RangeException("movie Director is too large"));
		}
		// store the movie Director
		$this->movieDirector = $newMovieDirector;
	}
	/**
	 * accessor method for movie date
	 *
	 * @return \Genre value of movie date
	 **/
	public function getMovieGenre(): \Genre {
		return ($this->movieGenre);
	}
	/**
	 * mutator method for movie date
	 *
	 * @param \Genre|string|null $newMovieGenre movie date as a Genre object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newMovieGenre is not a valid object or string
	 * @throws \RangeException if $newMovieGenre is a date that does not exist
	 **/
	public function setMovieGenre($newMovieGenre = null) : void {
		// base case: if the date is null, use the current date and time
		if($newMovieGenre === null) {
			$this->movieGenre = new \Genre();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newMovieGenre = self::validateGenre($newMovieGenre);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->movieGenre = $newMovieGenre;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	// organize the state variables into an array:
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["movieId"] = $this->movieId->toString();
		$fields["movieName"] = $this->movieName->toString();
		$fields["movieDirector"] = $this->movieDirector->toString();
		$fields["movieLength"] = $this->movieLength->toString();

		//format the date so that the frontend can consume it
		$fields["movieGenre"] = round(floatval($this->movieGenre->format("U.u")) * 1000);
		return($fields);
	}
}

