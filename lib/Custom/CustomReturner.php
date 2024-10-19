<?php

declare(strict_types=1);

namespace Data\Custom;

use Data\Base\CustomReturnerBase;
use Data\Utilities\ArrayAssocManipulator;
use Data\Utilities\NumericManipulator;
use Data\Utilities\ObjectManipulator;
use Data\Utilities\ArrayManipulator;
use Data\Utilities\RegexManipulator;
use Data\Utilities\StringManipulator;
use Data\Utilities\FunctionManipulator;
use Data\Exception\RTException;

class CustomReturner extends CustomReturnerBase implements CustomReturnerInterface
{
  private const MANIPULATORS = [
    'assoc'    => ArrayAssocManipulator::class,
    'numeric'  => NumericManipulator::class,
    'object'   => ObjectManipulator::class,
    'array'    => ArrayManipulator::class,
    'regexp'   => RegexManipulator::class,
    'string'   => StringManipulator::class,
    'function' => FunctionManipulator::class
  ];

  /** @var string $lastError phpModel error */
  protected $lastError;

  /** @var mixed $value Store last value */
  protected $value;

  private const REGEXP_MATCHER = '/^\/(?:.*|\s)+\/$/';

  /**
   * Override and store updated value to prepare returns and other compilation.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    parent::__construct($value, $this->dataType($value));
    $this->value = $value;
  }

  /**
   * Returns array status to check a Associative array
   * 
   * @param string $array [required]
   * @return bool
   */
  private function assoc(array $array)
  {
    if (!\count($array)) return false;
    return \range(0, \count($array) - 1) !== \array_keys($array);
  }

  /**
   * Create a CustomReturner instance to set value
   * 
   * @param mixed $value [required]
   * @return \Data\Custom\CustomReturnerInterface
   */
  public static function compile($value)
  {
    return new self($value);
  }

  /**
   * 
   * @internal Error Handler
   * 
   * @param int    $type
   * @param string $msg
   * 
   * @return void
   */
  private function error(int $type, string $msg)
  {
    $this->lastError = $msg;
  }

  /**
   * 
   * 
   * @param string $name [required]
   * @param mixed  $args [required]
   * 
   * @return mixed
   */
  protected function phpModel(callable $phpfunc, ...$args)
  {
    $this->throwIfFunctionNotExists($phpfunc);
    $this->lastError = null;
    set_error_handler($this->error(...));
    try {return $phpfunc(...$args);} finally {restore_error_handler();}
  }

  /**
   * Returns an modified dataType, It's used compile custom Manipulator.
   * 
   * @param mixed $value [required]
   * @return string
   */
  private function dataType($value) : string
  {
    if (\is_string($value) && \class_exists($value)) return 'object';
    if (\is_callable($value)) return 'function';
    if (\is_numeric($value)) return 'numeric';
    if (\is_array($value) && $this->assoc($value)) return 'assoc';
    if (\is_string($value) && \preg_match(self::REGEXP_MATCHER, $value)) return 'regexp';
    return \gettype($value);
  }

  /**
   * Returns an compiled Manipulator to initialized with class Object.
   * 
   * @param mixed $value [optional] Override current value
   * @return \Data\Utilities\FunctionManipulator|\Data\Utilities\ObjectManipulator|\Data\Utilities\StringManipulator|\Data\Utilities\ArrayManipulator|\Data\Utilities\ArrayAssocManipulator|\Data\Utilities\RegexManipulator|\Data\Utilities\NumericManipulator
   */
  public function return($value = null)
  {
    $this->value = $value ?? $this->value;
    $manipulator = self::MANIPULATORS[$this->dataType($this->value)];
    return new $manipulator($this->value);
  }

  /**
   * Create a throwIfFunctionNotExists thrower, to throw error if function does not exists.
   * 
   * @param string $func [required]
   * @return void
   * 
   * @throws RTException when file does not exists.
   */
  private static function throwIfFunctionNotExists(string $func) : void
  {
    if (!\function_exists($func)) {
      throw new RTException(\sprintf('Unable to perform filesystem operation because the "%s()" function has been disabled.'), $func);
    }
  }
}
?>