<?php

declare(strict_types=1);

namespace Data\Custom;

use Data\Utilities\Manipulator\ArrayAssocManipulator;
use Data\Utilities\Manipulator\NumericManipulator;
use Data\Utilities\Manipulator\ObjectManipulator;
use Data\Utilities\Manipulator\ArrayManipulator;
use Data\Utilities\Manipulator\RegexManipulator;
use Data\Utilities\Manipulator\StringManipulator;
use Data\Utilities\Manipulator\FunctionManipulator;
use Data\Utilities\Manipulator\ResourceManipulator;
use RegExp\RegExp;

/**
 * @internal Compiler Trait
 */
trait Compiler
{
  /**
   * 
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
   * 
   * @param array $array [required]
   * @return bool
   */
  private function isAssoc(array $array) : bool
  {
    if (!\count($array)) return false;
    return \range(0, \count($array) - 1) !== \array_keys($array);
  }

  /**
   * 
   * 
   * @param mixed $value [required]
   * @return \Data\Custom\CustomManipulatorInterface
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