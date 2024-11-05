<?php

declare(strict_types=1);

namespace Data\Utilities\Manipulator;

use Data\Custom\CustomManipulator;

final class ArrayManipulator extends CustomManipulator implements ManipulatorInterface
{
  /**
   * Create ArrayManipulator constructor.
   * Initializes a new instance of ArrayManipulator with the given value.
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