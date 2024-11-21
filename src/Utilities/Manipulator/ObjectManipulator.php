<?php

declare(strict_types=1);

namespace Container\Data\Utilities\Manipulator;

use Container\Data\Custom\CustomManipulator;

final class ObjectManipulator extends CustomManipulator implements ManipulatorInterface
{
  /**
   * Create ObjectManipulator constructor.
   * Initializes a new instance of ObjectManipulator with the given value.
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