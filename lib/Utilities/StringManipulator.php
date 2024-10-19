<?php

declare(strict_types=1);

namespace Data\Utilities;

use Data\Utilities\HTML\HtmlTags;
use Data\Custom\CustomReturner;

final class StringManipulator extends CustomReturner
{
  public const whitespace = "\x20\t\r\n\f\0\x0B";
  public const CRLF = "\r\n";

  use HtmlTags;

  /**
   * Override and store updated value to prepare returns and other compilation.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    parent::__construct($value);
  }

  /**
   * 
   * 
   * @param int $mode [optional]
   * @return \Data\Utilities\FunctionManipulator|\Data\Utilities\ObjectManipulator|\Data\Utilities\StringManipulator|\Data\Utilities\ArrayManipulator|\Data\Utilities\ArrayAssocManipulator|\Data\Utilities\RegexManipulator|\Data\Utilities\NumericManipulator
   */
  public function countchars(int $mode = 0)
  {
    return $this->return($this->phpModel('count_chars', $this->value, $mode));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function addslashes()
  {
    return $this->return($this->phpModel('addslashes', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function print()
  {
    return $this->return($this->phpModel('print', $this->value));
  }

  /**
   * 
   * 
   * @param string $characters [required]
   * @return \Data\Utilities\StringManipulator
   */
  public function addcslashes(string $characters)
  {
    return $this->return($this->phpModel('addcslashes', $this->value, $characters));
  }

  /**
   * 
   * 
   * @param string|int|float $values [optional]
   * @return \Data\Utilities\NumericManipulator
   */
  public function printf(...$values)
  {
    return $this->return($this->phpModel('printf', $this->value, $values));
  }
  
  /**
   * 
   * 
   * @param string $string2       [required]
   * @param int $insertaion_cost  [optional]
   * @param int $replacement_cost [optional]
   * @param int $deletion_cost    [optional]
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function levenshtein(string $string2, int $insertion_cost = 1, int $replacement_cost = 1, int $deletion_cost = 1)
  {
    return $this->return($this->phpModel('levenshtein', $this->value, $string2, $insertion_cost, $replacement_cost, $deletion_cost));
  }

  /**
   * 
   * 
   * @param array $values [required]
   * @return \Data\Utilities\NumericManipulator
   */
  public function vprintf(array $values)
  {
    return $this->return($this->phpModel('vprintf', $this->value, $values));
  }

  /**
   * 
   * 
   * @param array $values [required]
   * @return \Data\Utilities\NumericManipulator
   */
  public function vsprintf(array $values)
  {
    return $this->return($this->phpModel('vprintf', $this->value, $values));
  }

  /**
   * 
   * 
   * @param int    $length    [optional]
   * @param string $separator [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function chunksplit(int $length = 76, string $separator = null)
  {
    return $this->return($this->phpModel('chunk_split', $this->value, $length, $separator ?? self::CRLF));
  }

  /**
   * 
   * 
   * @param bool $use_xhtml [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function nl2br(bool $use_xhtml = true)
  {
    return $this->return($this->phpModel('nl2br', $this->value, $use_xhtml));
  }

  /**
   * 
   * 
   * @param float $number [required]
   * @return \Data\Utilities\StringManipulator
   */
  public function moneyFormat(float $number)
  {
    return $this->return($this->phpModel('money_format', $this->value, $number));
  }

  /**
   * 
   * 
   * @param int $max_phonenames [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function metaphone(int $max_phonenames = 0)
  {
    return $this->return($this->phpModel('metaphone', $this->value, $max_phonenames));
  }

  /**
   * 
   * 
   * @param string $niddle        [required]
   * @param bool   $before_niddle [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function chr(string $niddle, bool $before_niddle = false)
  {
    return $this->return($this->phpModel('strchr', $this->value, $niddle, $before_niddle));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function rawurldecode()
  {
    return $this->return($this->phpModel('rawurlencode', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function rawurlencode()
  {
    return $this->return($this->phpModel('rawurlencode', $this->value));
  }

  /**
   * 
   * 
   * @param string     $niddle [required]
   * @param int<0,max> $offset [optional]
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function strpos(string $niddle, int $offset = 0)
  {
    return $this->return($this->phpModel('strpos', $this->value, $niddle, $offset));
  }

  /**
   * 
   * 
   * @param string $suffix [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function basename(string $suffix = '')
  {
    return $this->return($this->phpModel('basename', $this->value, $suffix));
  }

  /**
   * 
   * 
   * @param int $length [optional]
   * @return \Data\Utilities\ArrayManipulator
   */
  public function split(string $separator = null, int $length = 1)
  {
    return $this->return($this->phpModel('str_split', $this->value, $length));
  }

  /**
   * 
   * 
   * @param int $times [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function repeat(int $times)
  {
    return $this->return($this->phpModel('str_repeat', $this->value, $times));
  }

  /**
   * 
   * 
   * @param int $levels [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function dirname(int $levels = 1)
  {
    return $this->return($this->phpModel('dirname', $this->value, $levels));
  }

  /**
   * 
   * 
   * @param int $offset      [required]
   * @param int|null $length [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function substr(int $offset, int $length = null)
  {
    return $this->return($this->phpModel('substr', $this->value, $offset, $length));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function toUpper()
  {
    return $this->return($this->phpModel('strtoupper', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function toLower()
  {
    return $this->return($this->phpModel('strtolower', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function ucfirst()
  {
    return $this->return($this->phpModel('ucfirst', $this->value));
  }

  /**
   * 
   * 
   * @param string $niddle [required]
   * @return \Data\Utilities\NumericManipulator
   */
  public function contains(string $niddle)
  {
    return $this->return($this->phpModel('str_contains', $this->value, $niddle));
  }

  /**
   * 
   * 
   * @param string   $characters [required]
   * @param int      $offset     [optional]
   * @param int|null $length     [optional]
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function cspn(string $characters, int $offset = 0, int $length = null)
  {
    return $this->return($this->phpModel('strcspn', $this->value, $characters, $offset, $length));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function lcfirst()
  {
    return $this->return($this->phpModel('lcfirst', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function ucwords()
  {
    return $this->return($this->phpModel('ucwords', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function urldecode()
  {
    return $this->return($this->phpModel('urldecode', $this->value));
  }

  /**
   * 
   * 
   * @param string|null $characters [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function urlencode()
  {
    return $this->return($this->phpModel('urlencode', $this->value));
  }

  /**
   * 
   * 
   * @param string|null $token [required]
   * @return \Data\Utilities\StringManipulator
   */
  public function strtok(?string $token = null)
  {
    return $this->return($this->phpModel('strlen', $this->value, $token));
  }

  /**
   * 
   * 
   * @param string $string2 [required]
   * @return \Data\Utilities\NumericManipulator
   */
  public function casecmp(string $string2)
  {
    return $this->return($this->phpModel('strcasecmp', $this->value, $string2));
  }

  /**
   * 
   * 
   * @param bool $binary [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function sha1(bool $binary = false)
  {
    return $this->return($this->phpModel('sha1', $this->value, $binary));
  }

  public function md5(bool $binary = false)
  {
    return $this->return($this->phpModel('md5', $this->value, $binary));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function strval()
  {
    return $this->return($this->phpModel('strval', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function strrev()
  {
    return $this->return($this->phpModel('strrev', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function length()
  {
    return $this->return($this->phpModel('strlen', $this->value));
  }

  /**
   * 
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function ord()
  {
    return $this->return($this->phpModel('ord', $this->value));
  }

  /**
   * 
   * 
   * @param int    $width        [optional]
   * @param string $break        [optional]
   * @param bool   $cutLongWords [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function wordwrap(int $width = 75, string $break = "\n", bool $cutLongWords = false)
  {
    return $this->return($this->phpModel('wordwrap', $this->value, $width, $break, $cutLongWords));
  }

  /**
   * 
   * 
   * @param int         $format     [required]
   * @param string|null $characters [optional]
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function wordcount(int $format = 0, string $characters = null)
  {
    return $this->return($this->phpModel('str_word_count', $this->value, $format, $characters));
  }

  /**
   * 
   * 
   * @param string $niddle        [required]
   * @param bool   $before_niddle [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function str(string $niddle, bool $before_niddle = false)
  {
    return $this->return($this->phpModel('strstr', $this->value, $niddle, $before_niddle));
  }

  /**
   * 
   * 
   * @param string|null $characters [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function ltrim(string $characters = null)
  {
    return $this->return($this->phpModel('ltrim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * 
   * 
   * @param string|null $characters [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function trim(string $characters = null)
  {
    return $this->return($this->phpModel('trim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * 
   * 
   * @param string|null $characters [optional]
   * @return \Data\Utilities\StringManipulator
   */
  public function rtrim(string $characters = null)
  {
    return $this->return($this->phpModel('rtrim', $this->value, $characters ?? self::whitespace));
  }

  /**
   * 
   * 
   * @param string|string[] $search  [required]
   * @param string|string[] $replace [required]
   * @param int $count [optional]
   * 
   * @return \Data\Utilities\StringManipulator
   */
  public function replace($search, $replace, int $count = null)
  {
    return $this->return($this->phpModel('str_replace', $search, $replace, $this->value, $count));
  }

  /**
   * 
   * 
   * @param string   $separator [required]
   * @param int|null $limit     [optional]
   * 
   * @return \Data\Utilities\ArrayManipulator
   */
  public function explode(string $separator, int $limit = null)
  {
    return $this->return($this->phpModel('explode', $separator, $this->value, $limit ?? \PHP_INT_MAX));
  }

  /**
   * 
   * 
   * @param int $component [optional]
   * @return \Data\Utilities\FunctionManipulator|\Data\Utilities\ObjectManipulator|\Data\Utilities\StringManipulator|\Data\Utilities\ArrayManipulator|\Data\Utilities\ArrayAssocManipulator|\Data\Utilities\RegexManipulator|\Data\Utilities\NumericManipulator
   */
  public function parseUrl(int $component = -1)
  {
    return $this->return($this->phpModel('parse_url', $this->value, $component));
  }
}
?>