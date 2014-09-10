<?php
/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Factory\ContainerFactory.
 */

namespace Drupal\plugin\Core\Plugin\Factory;

use Drupal\plugin\Component\Plugin\Factory\DefaultFactory;

/**
 * Plugin factory which passes a container to a create method.
 */
class ContainerFactory extends DefaultFactory {

  /**
   * {@inheritdoc}
   */
  public function createInstance($plugin_id, array $configuration = array()) {
    $plugin_definition = $this->discovery->getDefinition($plugin_id);
    $plugin_class = static::getPluginClass($plugin_id, $plugin_definition);

    // If the plugin provides a factory method, pass the container to it.
    if (is_subclass_of($plugin_class, 'Drupal\plugin\Core\Plugin\ContainerFactoryPluginInterface')) {
      return $plugin_class::create(\Drupal\plugin::getContainer(), $configuration, $plugin_id, $plugin_definition);
    }

    // Otherwise, create the plugin directly.
    return new $plugin_class($configuration, $plugin_id, $plugin_definition);
  }

}
