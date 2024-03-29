<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Discovery\YamlDiscovery.
 */

namespace Drupal\plugin\Core\Plugin\Discovery;

use Drupal\plugin\Component\Plugin\Discovery\DiscoveryInterface;
use Drupal\plugin\Component\Discovery\YamlDiscovery as ComponentYamlDiscovery;
use Drupal\plugin\Component\Plugin\Discovery\DiscoveryTrait;

/**
 * Allows YAML files to define plugin definitions.
 */
class YamlDiscovery implements DiscoveryInterface {

  use DiscoveryTrait;

  /**
   * YAML file discovery and parsing handler.
   *
   * @var \Drupal\plugin\Component\Discovery\YamlDiscovery
   */
  protected $discovery;

  /**
   * Construct a YamlDiscovery object.
   *
   * @param string $name
   *   The file name suffix to use for discovery. E.g. 'test' will become
   *   'MODULE.test.yml'.
   * @param array $directories
   *   An array of directories to scan.
   */
  function __construct($name, array $directories) {
    $this->discovery = new ComponentYamlDiscovery($name, $directories);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinitions() {
    $plugins = $this->discovery->findAll();

    // Flatten definitions into what's expected from plugins.
    $definitions = array();
    foreach ($plugins as $provider => $list) {
      foreach ($list as $id => $definition) {
        $definitions[$id] = $definition + array(
          'provider' => $provider,
          'id' => $id,
        );
      }
    }

    return $definitions;
  }
}
