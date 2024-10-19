<?php

declare(strict_types=1);

namespace Data\Utilities;

use Data\Custom\CustomReturner;

final class RegexManipulator extends CustomReturner
{
  /**
   * Override and store updated value to prepare returns and other compilation.
   * 
   * @var mixed $value
   */
  protected $value;

  /**
   * 
   * 
   * @param mixed $value [required]
   * @return void
   */
  public function __construct($value)
  {
    $this->value = $value;
    parent::__construct($value);
  }
}
?>