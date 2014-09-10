<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\ContextDefinitionInterface.
 */

namespace Drupal\plugin\Core\Plugin\Context;

use Drupal\plugin\Component\Plugin\Context\ContextDefinitionInterface as ComponentContextDefinitionInterface;

/**
 * Interface for context definitions.
 */
interface ContextDefinitionInterface extends ComponentContextDefinitionInterface {

  /**
   * Returns the data definition of the defined context.
   *
   * @return \Drupal\plugin\Core\TypedData\DataDefinitionInterface
   *   The data definition object.
   */
  public function getDataDefinition();

}
