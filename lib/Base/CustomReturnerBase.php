<?php

declare(strict_types=1);

namespace Data\Base;

abstract class CustomReturnerBase
{
  abstract protected function phpModel(callable $phpfunc, ...$args);

  private const def = '/^(?:string|regexp)$/';
  protected $value;
  private $type;
  private const construct = [
    'regexp'   => '/(?:)/',
    'string'   => '',
    'numeric'  => 0,
    'array'    => [],
    'assoc'    => '<!ASSOC ,>',
    'function' => 'Function',
    'object'   => '{}'
  ];

  /**
   * Override and store updated value to prepare returns and other compilation.
   * 
   * @param mixed  $value [required]
   * @param string $type  [required]
   * 
   * @return void
   */
  public function __construct($value, $type)
  {
    $this->value = $value;
    $this->type  = $type;
  }

  /**
   * Returns latest last update value to string format
   * 
   * @return string
   */
  public function toString()
  {
    $method = $this->type;
    return \preg_match(self::def, $this->type) ? $this->_default() : $this->$method();
  }

  /**
   * Return latest last update value mutual to finish
   * 
   * @return mixed
   */
  public function valueOf()
  {
    return $this->value;
  }

  /**
   * 
   * @return mixed modified previous value
   */
  public function parent()
  {
    return $this->prev;
  }

  /**
   * Return latest last update value
   * 
   * @return mixed
   */
  public function finish()
  {
    return $this->valueOf();
  }

  /**
   * Returns Associative array to string
   * 
   * @return string
   */
  private function assoc()
  {
    return '<!ASSOC '.$this->array().'>';
  }

  /**
   * Returns numeric to string
   * 
   * @return string
   */
  private function numeric()
  {
    return (string) $this->value;
  }

  /**
   * Returns current value of constructor
   * 
   * @return mixed An constructor
   */
  public function constructor()
  {
    return self::construct[$this->type];
  }

  /**
   * Returns object to string
   * 
   * @return string
   */
  private function object()
  {
    return serialize($this->value);
  }

  /**
   * Returns to string like string regexp
   * 
   * @return string
   */
  private function _default()
  {
    return $this->numeric();
  }

  /**
   * Returns array to string with comma separated
   * 
   * @return string
   */
  private function array()
  {
    return \implode(',', $this->value);
  }

  /**
   * Returns function to string
   * 
   * @return string
   */
  private function function()
  {
    $reflection = new \ReflectionFunction($this->value);
    $filename = $reflection->getFileName();
    $startLine = $reflection->getStartLine() - 1; // 0-based index
    $endLine = $reflection->getEndLine();
    
    // File ka content padhein
    $lines = file($filename);
    
    // Function ke lines ko extract karein
    $functionCode = implode("", array_slice($lines, $startLine, $endLine - $startLine));
    
    return $functionCode;
  }
}
?>