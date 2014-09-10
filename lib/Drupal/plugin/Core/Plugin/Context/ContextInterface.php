<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\ContextInterface.
 */

namespace Drupal\plugin\Core\Plugin\Context;

use Drupal\plugin\Component\Plugin\Context\ContextInterface as ComponentContextInterface;
use Drupal\plugin\Core\TypedData\TypedDataInterface;

/**
 * Interface for context.
 */
interface ContextInterface extends ComponentContextInterface {

  /**
   * Gets the context value as typed data object.
   *
   * @return \Drupal\plugin\Core\TypedData\TypedDataInterface
   */
  public function getContextData();

  /**
   * Sets the context value as typed data object.
   *
   * @param \Drupal\plugin\Core\TypedData\TypedDataInterface $data
   *   The context value as a typed data object.
   *
   * @return $this
   */
  public function setContextData(TypedDataInterface $data);

}
