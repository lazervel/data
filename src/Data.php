<?php

declare(strict_types=1);

namespace Data;

use Data\Custom\CustomManipulator;
use Data\Base\Base;

class Data extends Base
{
  protected $value;
  private $prev;

  /**
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    $this->value = $value;
    $this->prev  = $value;
    parent::__construct($value);
  }

  /**
   * Returns The Previous or Initial value.
   * 
   * @return mixed The Previous or Initial value.
   */
  public function prev()
  {
    return $this->prev;
  }

  /**
   * 
   * @param mixed $value [required]
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function prevWith()
  {
    return $this->with($this->prev);
  }

  /**
   * 
   * @param mixed $value [required]
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public static function with($value)
  {
    return CustomManipulator::create($value)->compile();
  }

  public function __get($property)
  {
    return $this->with($this->value)->$property;
  }

  /**
   * 
   * @param string $name      [required]
   * @param array  $arguments [optional]
   * 
   * @throws \Data\Exception\MethodNotFoundException When trying to access private or undefined method.
   * 
   * @return mixed The Manipulated data value.
   */
  public function __call($name, $arguments)
  {
    return $this->with($this->value)->$name(...$arguments);
  }
}
?>