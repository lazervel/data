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
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface
   */
  public function toupper()
  {
    return $this->return($this->strBox('toupper'));
  }

  /**
   * Convert string touppercase format.
   * 
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface
   */
  public function tolower()
  {
    return $this->return($this->strBox('tolower'));
  }

  /**
   * Make a Tokenize string given with $token.
   * 
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface|\Data\Custom\CustomManipulatorInterface
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
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function contains(string $needle)
  {
    return $this->return($this->strBox('_contains', $needle));
  }

  /**
   * Make a string's first character uppercase
   * 
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface
   */
  public function ucfirst()
  {
    return $this->return($this->proModel('ucfirst', $this->value));
  }

  /**
   * Make a string's first character lowercase
   * 
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface
   */
  public function lcfirst()
  {
    return $this->return($this->proModel('lcfirst', $this->value));
  }

  /**
   * Uppercase the first character of each word in a string
   * 
   * @return \Data\Utilities\Manipulator\StringManipulatorInterface
   */
  public function ucwords(string $separators = "\t\r\n\f\v")
  {
    return $this->return($this->proModel('ucwords', $this->value));
  }
}
?>