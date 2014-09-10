<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Action\ActionBag.
 */

namespace Drupal\plugin\Core\Action;

use Drupal\plugin\Core\Plugin\DefaultSinglePluginBag;

/**
 * Provides a container for lazily loading Action plugins.
 */
class ActionBag extends DefaultSinglePluginBag {

  /**
   * {@inheritdoc}
   *
   * @return \Drupal\plugin\Core\Action\ActionInterface
   */
  public function &get($instance_id) {
    return parent::get($instance_id);
  }

}
