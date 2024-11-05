<?php

declare(strict_types=1);

namespace Data\Custom;

use Data\Exception\MethodNotFoundException;
use Data\Base\Base;

/**
 * @uses Compiler
 */
class CustomManipulator extends Base implements CustomManipulatorInterface
{
  /** @var mixed $prev Store the previous or Initial value. */
  private $prev;

  use Compiler;

  /**
   * Create CustomManipulator constructor.
   * Initializes a new instance of CustomManipulator with the given value.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value) {
    parent::__construct($value);
  }

  /**
   * Returns The CustomManipulator instance with the current or lastes value.
   * 
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function return($value)
  {
    $manipulator = $this->create($value)->compile();
    $manipulator->prev = $this->value;
    return $manipulator;
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
   * Returns The CustomManipulator instance with previous or initial value.
   * 
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function prevWith()
  {
    return $this->return($this->prev);
  }

  /**
   * Returns The CustomManipulator instance with override value.
   * 
   * @param mixed $value [required]
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function override($value)
  {
    // SET: null, Reset the previous value.
    $this->value = null;
    return $this->return($value);
  }

  /**
   * Create a new CustomManipulator instance with the given value.
   * 
   * @param mixed $value [required]
   * @return \Dotenv\Custom\CustomManipulatorInterface
   */
  public static function create($value)
  {
    return new self($value);
  }

  /**
   * Returns The CustomManipulator instance compile with current value.
   * 
   * @return \Data\Custom\CustomManipulatorInterface
   */
  public function compile()
  {
    if (\is_bool($this->value) || $this->value === null) {
      return $this;
    }

    return $this->doCompile($this->value);
  }

  /**
   * Handles calls to undefined or private methods.
   * AutoCall The magic method [__call] is triggered when an inaccessible or undefined method is called.
   * 
   * @param string $name      [required]
   * @param array  $arguments [optional]
   * 
   * @throws \Data\Exception\MethodNotFoundException When trying to access private or undefined method.
   */
  public function __call($name, $arguments) : void
  {
    throw new MethodNotFoundException(\sprintf('Cannot access method [%s] not found or removed.', $name));
  }
}
?>