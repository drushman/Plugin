<?php
/**
 * @file
 * Contains \Drupal\plugin\Component\Plugin\Factory\FactoryInterface.
 */

namespace Drupal\plugin\Component\Plugin\Factory;

/**
 * Factory interface implemented by all plugin factories.
 */
interface FactoryInterface {

  /**
   * Returns a pre-configured instance of a plugin.
   *
   * @param string $plugin_id
   *   The ID of the plugin being instantiated.
   * @param array $configuration
   *   An array of configuration relevant to the plugin instance.
   *
   * @return object
   *   A fully configured plugin instance.
   *
   * @throws \Drupal\plugin\Component\Plugin\Exception\PluginException
   *   If the instance cannot be created, such as if the ID is invalid.
   */
  public function createInstance($plugin_id, array $configuration = array());

}
