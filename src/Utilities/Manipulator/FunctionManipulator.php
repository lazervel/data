<?php

declare(strict_types=1);

namespace Data\Utilities\Manipulator;

use Data\Custom\CustomManipulator;

final class FunctionManipulator extends CustomManipulator implements ManipulatorInterface
{
  /**
   * Create FunctionManipulator constructor.
   * Initializes a new instance of FunctionManipulator with the given value.
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