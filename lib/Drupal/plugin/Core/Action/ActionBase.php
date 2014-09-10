<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Action\ActionBase.
 */

namespace Drupal\plugin\Core\Action;

use Drupal\plugin\Core\Plugin\PluginBase;
use Drupal\plugin\Core\Action\ActionInterface;

/**
 * Provides a base implementation for an Action plugin.
 *
 * @see \Drupal\plugin\Core\Annotation\Action
 * @see \Drupal\plugin\Core\Action\ActionManager
 * @see \Drupal\plugin\Core\Action\ActionInterface
 * @see plugin_api
 */
abstract class ActionBase extends PluginBase implements ActionInterface {

  /**
   * {@inheritdoc}
   */
  public function executeMultiple(array $entities) {
    foreach ($entities as $entity) {
      $this->execute($entity);
    }
  }

}
