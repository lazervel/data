<?php

declare(strict_types=1);

namespace Data\Utilities;

use Data\Custom\CustomReturner;

final class ArrayManipulator extends CustomReturner
{
  /**
   * Override and store updated value to prepare returns and other compilation.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct(&$value)
  {
    $this->value = &$value;
    parent::__construct($value);
  }

  /**
   * 
   * 
   * @param mixed $value  [required]
   * @param mixed $values [optional]
   * 
   * @return \Data\Utilities\NumericManipulator
   */
  public function push($value, ...$values)
  {
    return $this->return(\array_push($this->value, $value, ...$values), $this->value);
  }
}
?>