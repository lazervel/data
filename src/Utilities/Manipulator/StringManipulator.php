<?php

declare(strict_types=1);

namespace Container\Data\Utilities\Manipulator;

use Container\Data\Custom\CustomManipulator;

class StringManipulator extends CustomManipulator implements ManipulatorInterface
{
  public const whitespace = "\x20\t\r\n\f\0\x0B";
  public const CRLF = "\r\n";

  /**
   * Create StringManipulator constructor.
   * Initializes a new instance of StringManipulator with the given value.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    parent::__construct($value);
  }

  /**
   * strBox -
   * 
   * @param string   $fn        [required]
   * @param mixed ...$arguments [required]
   * 
   * @return mixed The result of the function call.
   */
  public function strBox(string $fn, ...$arguments)
  {
    return $this->proModel(('str'.$fn), $this->value, ...$arguments);
  }

  /**
   * Convert string touppercase format.
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function toupper()
  {
    return $this->return($this->strBox('toupper'));
  }

  /**
   * Convert string touppercase format.
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function tolower()
  {
    return $this->return($this->strBox('tolower'));
  }

  /**
   * Make a Tokenize string given with $token.
   * 
   * @param string|null $token [optional]
   * @return \Container\Data\Utilities\Manipulator\StringManipulator|\Data\Custom\CustomManipulatorInterface
   */
  public function tok(string $token = null)
  {
    return $this->return($this->strBox('tok', $token));
  }

  /**
   * Checks if $needle is found in $haystack and returns a boolean value
   * (true/false) whether or not the $needle was found.
   * 
   * @param string $needle [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function contains(string $needle)
  {
    return $this->return($this->strBox('_contains', $needle));
  }

  /**
   * Make a string's first character uppercase
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function ucfirst()
  {
    return $this->return($this->proModel('ucfirst', $this->value));
  }

  /**
   * Make a string's first character lowercase
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function lcfirst()
  {
    return $this->return($this->proModel('lcfirst', $this->value));
  }

  /**
   * Uppercase the first character of each word in a string
   * 
   * @param string $separators [optional]
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function ucwords(string $separators = "\t\r\n\f\v")
  {
    return $this->return($this->proModel('ucwords', $this->value));
  }

  /**
   * Strip whitespace (or other characters) from the beginning and end of a string
   * 
   * @param string|null $characters [optional]
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function trim(string $characters = null)
  {
    return $this->return($this->proModel('trim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * Strip whitespace (or other characters) from the beginning of a string
   * 
   * @param string|null $characters [optional]
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function ltrim(string $characters = null)
  {
    return $this->return($this->proModel('ltrim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * Strip whitespace (or other characters) from the end of a string
   * 
   * @param string|null $characters [optional]
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function rtrim(string $characters = null)
  {
    return $this->return($this->proModel('rtrim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * Finds the length of the initial segment of a string consisting
   * entirely of characters contained within a given mask
   * 
   * @param string   $characters [required]
   * @param int      $offset     [optional]
   * @param int|null $length     [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function spn(string $characters, int $offset = 0, int $length = null)
  {
    return $this->return($this->strBox('spn', $characters, $offset, $length));
  }

  /**
   * Find the position of the last occurrence of a substring in a string
   * 
   * @param string $needle [required]
   * @param int    $offset [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function rpos(string $needle, int $offset = 0)
  {
    return $this->return($this->strBox('rpos', $needle, $offset));
  }

  /**
   * Find the position of the first occurrence of a substring in a string
   * 
   * @param string $needle     [required]
   * @param int<0,max> $offset [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function pos(string $needle, int $offset = 0)
  {
    return $this->return($this->strBox('pos', $needle, $offset));
  }

  /**
   * Find the position of the first occurrence of a case-insensitive substring in a string
   * 
   * @param string $needle [required]
   * @param int    $offset [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function ipos(string $needle, int $offset = 0)
  {
    return $this->return($this->strBox('ipos', $needle, $offset));
  }

  /**
   * String comparisons using a "natural order" algorithm
   * 
   * @param string $string2 [required]
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function natcmp(string $string2)
  {
    return $this->return($this->strBox('natcmp', $string2));
  }

  /**
   * Binary safe case-insensitive string comparison of the first n characters
   * 
   * @param string $string2 [required]
   * @param int    $length  [required]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function ncasecmp(string $string2, int $length)
  {
    return $this->return($this->strBox('ncasecmp', $string2, $length));
  }

  /**
   * Binary safe string comparison of the first n characters
   * 
   * @param string $string2 [required]
   * @param int    $length  [required]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function ncmp(string $string2, int $length)
  {
    return $this->return($this->strBox('ncmp', $string2, $length));
  }

  /**
   * Case insensitive string comparisons using a "natural order" algorithm
   * 
   * @param string $string2 [required]
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function natcasecmp(string $string2)
  {
    return $this->return($this->strBox('natcasecmp', $string2));
  }

  /**
   * Locale based string comparison
   * 
   * @param string $string2 [required]
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function coll(string $string2)
  {
    return $this->return($this->strBox('coll', $string2));
  }

  /**
   * Find length of initial segment not matching mask
   * 
   * @param string   $characters [required]
   * @param int      $offset     [optional]
   * @param int|null $length     [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function cspn(string $characters, int $offset = 0, int $length = null)
  {
    return $this->return($this->strBox('cspn', $characters, $offset, $length));
  }

  /**
   * Search a string for any of a set of characters
   * 
   * @param string $charList   [required]
   * @param string $characters [required]
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function pbrk(string $charList = '', string $characters)
  {
    return $this->return($this->strBox('pbrk', $charList, $characters));
  }

  /**
   * Alias of strstr
   * Find the first occurrence of a string
   * 
   * @param string $needle       [required]
   * @param bool   $beforeNeedle [optional]
   * 
   * Alias:
   * {@see strstr}
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function chr(string $needle, bool $beforeNeedle = false)
  {
    return $this->str($needle, $beforeNeedle);
  }

  /**
   * Find the first occurrence of a string
   * 
   * @param string $needle       [required]
   * @param bool   $beforeNeedle [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function str(string $needle, bool $beforeNeedle = false)
  {
    return $this->return($this->strBox('str', $needle, $beforeNeedle));
  }

  /**
   * Get string length
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function length()
  {
    return $this->return($this->strBox('length'));
  }

  /**
   * Reverse a string
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function rev()
  {
    return $this->return($this->strBox('rev'));
  }

  /**
   * Parse about any English textual datetime description into a Unix timestamp
   * 
   * The string to parse. Before PHP 5.0.0,
   * microseconds weren't allowed in the time,
   * @since PHP 5.0.0 they are allowed but ignored.
   * 
   * @param int|null $baseTimestamp [optional]
   * @return \Container\Data\Utilities\Manipulator\NumericManipulator
   */
  public function totime(int $baseTimestamp = null)
  {
    return $this->return($this->strBox('totime', $baseTimestamp));
  }

  /**
   * Pad a string to a certain length with another string
   * 
   * @param int $length [required]
   * @param string $padString [optional]
   * @param int $padType [optional]
   * Optional argument pad_type can be
   * STR_PAD_RIGHT
   * STR_PAD_LEFT
   * STR_PAD_BOTH
   * 
   * default:
   * STR_PAD_RIGHT
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function pad(int $length, string $padString = " ", int $padType = \STR_PAD_RIGHT)
  {
    return $this->return($this->strBox('_pad', $length, $padString, $padType));
  }

  /**
   * Parse a CSV string into an array
   * 
   * @param string $separator [optional]
   * @param string $enclosure [optional]
   * @param string $escape    [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\ArrayManipulator
   */
  public function getcsv(string $separator = ",", string $enclosure = '"', string $escape = "\\")
  {
    return $this->return($this->strBox('_getcsv', $separator, $enclosure, $escape));
  }

  /**
   * Replace all occurrences of the search string with the replacement string
   * 
   * @param string $search  [required]
   * @param string $replace [required]
   * @param string $subject [required]
   * @param int|null $count [optional]
   * 
   * @return \Container\Data\Utilities\Manipulator\ManipulatorInterface
   */
  public function replace(string $search, string $replace, string $subject, int $count = null)
  {
    return $this->return($this->strBox('_replace', $search, $replace, $subject, $count));
  }

  /**
   * Uuencode a string
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function uuencode()
  {
    return $this->return($this->proModel('convert_uuencode', $this->value));
  }

  /**
   * Decode a uuencoded string
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function uudecode()
  {
    return $this->return($this->proModel('convert_uudecode', $this->value));
  }

  /**
   * Convert from one Cyrillic character set to another
   * 
   * @param string $from [required]
   * @param string $to   [required]
   * 
   * @return \Container\Data\Utilities\Manipulator\StringManipulator
   */
  public function cyrstr(string $from, string $to)
  {
    return $this->return($this->proModel('convert_cyr_str', $this->value, $from, $to));
  }
}
?>