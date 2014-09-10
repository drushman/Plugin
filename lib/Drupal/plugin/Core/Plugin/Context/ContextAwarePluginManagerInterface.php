<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\ContextAwarePluginManagerInterface.
 */

namespace Drupal\plugin\Core\Plugin\Context;

use Drupal\plugin\Component\Plugin\PluginManagerInterface;

/**
 * Provides an interface for plugin managers that support context-aware plugins.
 */
interface ContextAwarePluginManagerInterface extends PluginManagerInterface {

  /**
   * Determines plugins whose constraints are satisfied by a set of contexts.
   *
   * @todo Use context definition objects after https://Drupal\plugin.org/node/2281635.
   *
   * @param \Drupal\plugin\Component\Plugin\Context\ContextInterface[] $contexts
   *   An array of contexts.
   *
   * @return array
   *   An array of plugin definitions.
   */
  public function getDefinitionsForContexts(array $contexts = array());

}
