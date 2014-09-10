<?php

/**
 * @file
 * Contains \Drupal\plugin\Component\Discovery\DiscoverableInterface.
 */

namespace Drupal\plugin\Component\Discovery;

/**
 * Interface for classes providing a type of discovery.
 */
interface DiscoverableInterface {

  /**
   * Returns an array of discoverable items.
   *
   * @return array
   *   An array of discovered data.
   */
  public function findAll();

}
