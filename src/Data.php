<?php

declare(strict_types=1);

/**
 * Data PHP library for simplifying string, array, and object manipulation with intuitive methods.
 * 
 * The (data) Github repository
 * @see       https://github.com/lazervel/data
 * 
 * @author    Shahzada Modassir <shahzadamodassir@gmail.com>
 * @author    Shahzadi Afsara   <shahzadiafsara@gmail.com>
 * 
 * @copyright (c) Shahzada Modassir
 * @copyright (c) Shahzadi Afsara
 * 
 * @license   MIT License
 * @see       https://github.com/lazervel/data/blob/main/LICENSE
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Container\Data;

use Container\Data\Custom\CustomManipulator;
use Container\Data\Base\Base;

/**
 * Data PHP library for simplifying string, array, and object manipulation with intuitive methods.
 * 
 * @author Shahzada Modassir <shahzadamodassir@gmail.com>
 * @see    https://github.com/lazervel/data
 */
class Data extends Base
{
  /**
   * Store the current latest value.
   * 
   * @var mixed
   */
  protected $value;

  /**
   * Store the previous or Initial value.
   * 
   * @var mixed
   */
  private $prev;

  /**
   * Creates a new Data constructor.
   * Initializes a new instance of [Data] with the given value.
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
   * Returns The CustomManipulator instance with previous or initial value.
   * 
   * @param mixed $value [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function prevWith()
  {
    return $this->with($this->prev);
  }

  /**
   * Create a new CustomManipulator instance with the given value.
   * 
   * @param mixed $value [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public static function with($value)
  {
    return CustomManipulator::create($value)->compile();
  }

  /**
   * Magic method __get is called when trying to access a non-existing or inaccessible property.
   * 
   * @param string $property [required]
   * @return mixed The value of the property if it exists in the $data array,
   *               or a message indicating that the property is not found.
   */
  public function __get($property)
  {
    return $this->with($this->value)->$property;
  }

  /**
   * Magic method __call is called when trying to invoke a non-existing or inaccessible method.
   * 
   * @param string $name      [required]
   * @param array  $arguments [optional]
   * 
   * @throws \Container\Data\Exception\MethodNotFoundException When trying to access private or undef method.
   * 
   * @return mixed The Manipulated data value,
   *               A message or value based on the requested method.
   */
  public function __call($name, $arguments)
  {
    return $this->with($this->value)->$name(...$arguments);
  }
}
?>