<?php

declare(strict_types=1);

namespace Data\Utilities\Manipulator;

use Data\Custom\CustomManipulator;

final class NumericManipulator extends CustomManipulator implements ManipulatorInterface
{
  /**
   * Create NumericManipulator constructor.
   * Initializes a new instance of NumericManipulator with the given value.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    parent::__construct($value);
  }
}
?>