<?php

declare(strict_types=1);

namespace Container\Data\Custom;

interface CustomManipulatorInterface
{
  /**
   * Returns The CustomManipulator instance with the current or lastes value.
   * 
   * @param mixed $value [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function return($value);

  /**
   * Returns The CustomManipulator instance with previous or initial value.
   * 
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function prevWith();

  /**
   * Returns The CustomManipulator instance compile with current value.
   * 
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function compile();

  /**
   * Returns The CustomManipulator instance with override value.
   * 
   * @param mixed $value [required]
   * @return \Container\Data\Custom\CustomManipulatorInterface
   */
  public function override($value);
}
?>