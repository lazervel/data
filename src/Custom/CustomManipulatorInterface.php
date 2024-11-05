<?php

declare(strict_types=1);

namespace Data\Custom;

interface CustomManipulatorInterface
{
  /**
   * 
   * @param mixed $value [required]
   * @return
   */
  public function return($value);

  /**
   * 
   * @return
   */
  public function prevWith();

  /**
   * 
   * @return
   */
  public function compile();

  /**
   * @param mixed $value [required]
   * @return
   */
  public function override($value);
}
?>