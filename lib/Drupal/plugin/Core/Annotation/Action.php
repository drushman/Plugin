<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Annotation\Action.
 */

namespace Drupal\plugin\Core\Annotation;

use Drupal\plugin\Component\Annotation\Plugin;

/**
 * Defines an Action annotation object.
 *
 * Plugin Namespace: Plugin\Action
 *
 * For a working example, see \Drupal\plugin\node\Plugin\Action\UnpublishNode
 *
 * @see \Drupal\plugin\Core\Action\ActionInterface
 * @see \Drupal\plugin\Core\Action\ActionManager
 * @see \Drupal\plugin\Core\Action\ActionBase
 * @see plugin_api
 *
 * @Annotation
 */
class Action extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the action plugin.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\plugin\Core\Annotation\Translation
   */
  public $label;

  /**
   * The path for a confirmation form for this action.
   *
   * @todo Change this to accept a route.
   * @todo Provide a more generic way to allow an action to be confirmed first.
   *
   * @var string (optional)
   */
  public $confirm_form_path = '';

  /**
   * The entity type the action can apply to.
   *
   * @todo Replace with \Drupal\plugin\Core\Plugin\Context\Context.
   *
   * @var string
   */
  public $type = '';

}
