<?php

declare(strict_types=1);

namespace Data;

use Data\Custom\CustomReturner;

class Data
{
  private $value;

  /**
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    $this->value = $value;
  }

  public function __call($method, $arguments)
  {
    return $this->input($this->value)->$method(...$arguments);
  }

  /**
   * 
   * 
   * @return \Data\Utilities\FunctionManipulator|\Data\Utilities\ObjectManipulator|\Data\Utilities\StringManipulator|\Data\Utilities\ArrayManipulator|\Data\Utilities\ArrayAssocManipulator|\Data\Utilities\RegexManipulator|\Data\Utilities\NumericManipulator
   */
  public static function input($value)
  {
    return CustomReturner::compile($value)->return();
  }
}
?>