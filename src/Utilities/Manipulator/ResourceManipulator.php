<?php

declare(strict_types=1);

namespace Data\Utilities\Manipulator;

use Data\Custom\CustomManipulator;

final class ResourceManipulator extends CustomManipulator implements ManipulatorInterface
{
  /**
   * Create ResourceManipulator constructor.
   * Initializes a new instance of ResourceManipulator with the given value.
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