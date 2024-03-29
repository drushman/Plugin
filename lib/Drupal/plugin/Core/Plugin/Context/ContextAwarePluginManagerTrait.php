<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\ContextAwarePluginManagerTrait.
 */

namespace Drupal\plugin\Core\Plugin\Context;

/**
 * Provides a trait for plugin managers that support context-aware plugins.
 */
trait ContextAwarePluginManagerTrait {

  /**
   * Wraps the context handler.
   *
   * @return \Drupal\plugin\Core\Plugin\Context\ContextHandlerInterface
   */
  protected function contextHandler() {
    return \Drupal\plugin::service('context.handler');
  }

  /**
   * See \Drupal\plugin\Core\Plugin\Context\ContextAwarePluginManagerInterface::getDefinitionsForContexts().
   */
  public function getDefinitionsForContexts(array $contexts = array()) {
    return $this->contextHandler()->filterPluginDefinitionsByContexts($contexts, $this->getDefinitions());
  }

  /**
   * See \Drupal\plugin\Component\Plugin\Discovery\DiscoveryInterface::getDefinitions().
   */
  abstract public function getDefinitions();

}
