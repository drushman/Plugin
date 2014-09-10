<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Action\ActionInterface.
 */

namespace Drupal\plugin\Core\Action;

use Drupal\plugin\Component\Plugin\PluginInspectionInterface;
//use Drupal\plugin\Core\Executable\ExecutableInterface;

/**
 * Provides an interface for an Action plugin.
 *
 * @see \Drupal\plugin\Core\Annotation\Action
 * @see \Drupal\plugin\Core\Action\ActionManager
 * @see \Drupal\plugin\Core\Action\ActionBase
 * @see plugin_api
 */
interface ActionInterface extends PluginInspectionInterface {

  /**
   * Executes the plugin for an array of objects.
   *
   * @param array $objects
   *   An array of entities.
   */
  public function executeMultiple(array $objects);

}
