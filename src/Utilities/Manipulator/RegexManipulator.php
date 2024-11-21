<?php

declare(strict_types=1);

namespace Container\Data\Utilities\Manipulator;

use Container\Data\Utilities\Manipulator\StringManipulator;
use RegExp\RegExp;

final class RegexManipulator extends StringManipulator
{
  private $tempVal;
  private $regexp;

  /**
   * Create RegexManipulator constructor.
   * Initializes a new instance of RegexManipulator with the given value.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    $this->regexp  = \is_string($value) ? new RegExp($value) : $value;
    $this->tempVal = (string) $value;
    parent::__construct((string) $value);
  }

  private function regexp($value)
  {
    
  }

  /**
   * 
   * @param string $property
   * @return string|bool
   */
  public function __get($property)
  {
    return $this->regexp($this->tempVal)->$property ?? $this->regexp->$property;
  }
}
?>