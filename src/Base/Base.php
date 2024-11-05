<?php

declare(strict_types=1);

namespace Data\Base;

/**
 * @internal
 */
abstract class Base
{
  /** @var mixed $value Store the current latest value. */
  protected $value;

  /** @var object $stack Store the error stacks. */
  protected $stack;

  /**
   * Returns The CustomManipulator instance with previous or initial value.
   * 
   * @return \Data\Custom\CustomManipulatorInterface
   */
  abstract public function prevWith();

  /**
   * Returns The Previous or Initial value.
   * 
   * @return mixed The Previous or Initial value.
   */
  abstract public function prev();

  /**
   * Create Base constructor.
   * Initializes a new instance of Base with the given value.
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    $this->value = $value;
  }

  /**
   * refModel - By Reference Model Handler
   * Calls a given function with reference arguments and handles exceptions.
   * 
   * @param string   $fn        [required]
   * @param mixed ...$arguments [required]
   * 
   * @return mixed The result of the function call.
   */
  public function refModel($fn, &...$arguments)
  {
    $this->throwIfFunctionNotExists($fn);
    try {return $fn(...$arguments);} catch(\Exception $e) {$this->stack = $e;}
  }

  /**
   * Returns the current value converted with object format.
   * 
   * @return object The value converted with object format.
   */
  public function toObject()
  {
    return (object) $this->value;
  }

  /**
   * Returns the current value converted with string format.
   * 
   * @return string The value converted with string format.
   */
  public function toString()
  {
    echo $this->value;
  }

  /**
   * procModel - By Process Model Handler
   * Calls a given function with provided arguments and handles exceptions.
   * 
   * @param string    $fn        [required]
   * @param mixed &...$arguments [required]
   * 
   * @return mixed The result of the function call.
   */
  public function proModel($fn, ...$arguments)
  {
    $this->throwIfFunctionNotExists($fn);
    try {return $fn(...$arguments);} catch(\Exception $e) {$this->stack = $e;}
  }

  /**
   * Return the original current value.
   * 
   * @return mixed The original latest or current value.
   */
  public function valueOf()
  {
    return $this->value;
  }

  /**
   * Returns the current value converted with array format.
   * 
   * @return array The value converted with array format.
   */
  public function toArray()
  {
    return (array) $this->value;
  }

  /**
   * Retrieves the source code of the function stored in current value.
   * This method uses reflection to obtain the filename and line numbers of the
   * function, reads the file, and extracts the relevant lines to return
   * the function's code as a string.
   * 
   * @return string The source code of the function.
   */
  private function fnToString()
  {
    $reflection = new \ReflectionFunction($this->value);
    $filename   = $reflection->getFileName();
    $startLine  = $reflection->getStartLine() - 1; // 0-based index
    $endLine    = $reflection->getEndLine();
    
    // File ka content padhein
    $lines = file($filename);
    
    // Function ke lines ko extract karein
    $functionCode = \implode("", array_slice($lines, $startLine, $endLine - $startLine));

    return $functionCode;
  }

  /**
   * __toString magic method.
   * Returns the string representation of the array or object.
   *
   * This magic method is called when the object is treated as a string,
   * such as when echoing or printing the array or object.
   *
   * @return string The string representation of the array or object.
   */
  public function __toString()
  {
    return \is_array($this->value) ? \implode(',', $this->value) : (string) $this->value;
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
      throw new RTException(\sprintf('Unable to perform data operation because the "%s()" function has been disabled.'), $func);
    }
  }
}
?>