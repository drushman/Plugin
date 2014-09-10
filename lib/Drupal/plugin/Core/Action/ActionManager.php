<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Action\ActionManager.
 */

namespace Drupal\plugin\Core\Action;

use Drupal\plugin\Core\Cache\CacheBackendInterface;
use Drupal\plugin\Core\Extension\ModuleHandlerInterface;
use Drupal\plugin\Core\Plugin\DefaultPluginManager;

/**
 * Provides an Action plugin manager.
 *
 * @see \Drupal\plugin\Core\Annotation\Action
 * @see \Drupal\plugin\Core\Action\ActionInterface
 * @see \Drupal\plugin\Core\Action\ActionBase
 * @see plugin_api
 */
class ActionManager extends DefaultPluginManager {

  /**
   * Constructs a new class instance.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\plugin\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\plugin\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces) {
    parent::__construct('Plugin/Action', $namespaces, 'Drupal\plugin\Core\Annotation\Action');
//    $this->alterInfo('action_info');
  }

  /**
   * Gets the plugin definitions for this entity type.
   *
   * @param string $type
   *   The entity type name.
   *
   * @return array
   *   An array of plugin definitions for this entity type.
   */
  public function getDefinitionsByType($type) {
    return array_filter($this->getDefinitions(), function ($definition) use ($type) {
      return $definition['type'] === $type;
    });
  }

}
