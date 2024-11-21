<?php

declare(strict_types=1);

namespace Container\Data\Custom;

use Container\Data\Utilities\Manipulator\ArrayAssocManipulator;
use Container\Data\Utilities\Manipulator\NumericManipulator;
use Container\Data\Utilities\Manipulator\ObjectManipulator;
use Container\Data\Utilities\Manipulator\ArrayManipulator;
use Container\Data\Utilities\Manipulator\RegexManipulator;
use Container\Data\Utilities\Manipulator\StringManipulator;
use Container\Data\Utilities\Manipulator\FunctionManipulator;
use Container\Data\Utilities\Manipulator\ResourceManipulator;
use RegExp\RegExp;

/**
 * @internal Compiler Trait
 */
trait Compiler
{
  /**
   * Register all Manipulators with name, It's used to Compiling Manipulator
   * 
   * @var array<string,string> $MANIPULATORS
   */
  private $MANIPULATORS = [
    'resource' => ResourceManipulator::class,
    'numeric'  => NumericManipulator::class,
    'object'   => ObjectManipulator::class,
    'array'    => ArrayManipulator::class,
    'regex'    => RegexManipulator::class,
    'string'   => StringManipulator::class,
    'function' => FunctionManipulator::class,
    'assoc'    => ArrayAssocManipulator::class
  ];

  /**
   * Check array associative or none-associative of given $array, If $array is
   * associative then return true, Otherwise false
   * 
   * @param array $array [required]
   * @return bool If array assoc return true, Otherwise false
   */
  private function isAssoc(array $array) : bool
  {
    if (!\count($array)) return false;
    return \range(0, \count($array) - 1) !== \array_keys($array);
  }

  /**
   * Compiling the given $value and Returns a matched Manipulator instance
   * 
   * @param mixed $value [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  private function doCompile($value)
  {
    $manipulator = $this->MANIPULATORS[$this->gettype($value)];
    return new $manipulator($value);
  }

  /**
   * Get the Customized actual or original data type of a variable.
   * 
   * @param mixed $var [required]
   * @return string original type of variable instread.
   */
  private function gettype($var)
  {
    if (\is_string($var) && \class_exists($var)) return 'object';
    if (\is_callable($var)) return 'function';
    if (\is_numeric($var)) return 'numeric';
    if (\is_array($var) && $this->isAssoc($var)) return 'assoc';
    if (($var instanceof RegExp) || (\is_string($var) && @\preg_match($var, '') !== false)) return 'regex';
    return \gettype($var);
  }
}
?>