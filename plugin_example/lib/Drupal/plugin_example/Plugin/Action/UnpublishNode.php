<?php

/**
 * @file
 * Contains \Drupal\node\Plugin\Action\UnpublishNode.
 */

namespace Drupal\plugin_example\Plugin\Action;

use Drupal\plugin\Core\Action\ActionBase;

/**
 * Unpublishes a node.
 *
 * @Action(
 *   id = "node_unpublish_action",
 *   label = "Unpublish selected content",
 *   type = "node"
 * )
 */
class UnpublishNode extends ActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {
    $entity->status = NODE_NOT_PUBLISHED;
    $entity->save();
  }

}
