<?php

/**
 * @file
 * Contains \Drupal\plugin\Component\Plugin\Discovery\StaticDiscoveryDecorator.
 */

namespace Drupal\plugin\Component\Plugin\Discovery;

/**
 * A decorator that allows manual registration of undiscoverable definitions.
 */
class StaticDiscoveryDecorator extends StaticDiscovery {

  /**
   * The Discovery object being decorated.
   *
   * @var \Drupal\plugin\Component\Plugin\Discovery\DiscoveryInterface
   */
  protected $decorated;

  /**
   * A callback or closure used for registering additional definitions.
   *
   * @var \Callable
   */
  protected $registerDefinitions;

  /**
   * Constructs a \Drupal\plugin\Component\Plugin\Discovery\StaticDiscoveryDecorator object.
   *
   * @param \Drupal\plugin\Component\Plugin\Discovery\DiscoveryInterface $decorated
   *   The discovery object that is being decorated.
   * @param \Callable $registerDefinitions
   *   (optional) A callback or closure used for registering additional
   *   definitions.
   */
  public function __construct(DiscoveryInterface $decorated, $registerDefinitions = NULL) {
    $this->decorated = $decorated;
    $this->registerDefinitions = $registerDefinitions;
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinition($base_plugin_id, $exception_on_invalid = TRUE) {
    if (isset($this->registerDefinitions)) {
      call_user_func($this->registerDefinitions);
    }
    $this->definitions += $this->decorated->getDefinitions();
    return parent::getDefinition($base_plugin_id, $exception_on_invalid);
  }

  /**
   * Implements Drupal\plugin\Component\Plugin\Discovery\DiscoveryInterface::getDefinitions().
   */
  public function getDefinitions() {
    if (isset($this->registerDefinitions)) {
      call_user_func($this->registerDefinitions);
    }
    $this->definitions += $this->decorated->getDefinitions();
    return parent::getDefinitions();
  }

  /**
   * Passes through all unknown calls onto the decorated object
   */
  public function __call($method, $args) {
    return call_user_func_array(array($this->decorated, $method), $args);
  }
}
