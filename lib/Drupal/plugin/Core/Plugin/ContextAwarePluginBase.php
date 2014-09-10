<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\ContextAwarePluginBase
 */

namespace Drupal\plugin\Core\Plugin;

use Drupal\plugin\Component\Plugin\ContextAwarePluginBase as ComponentContextAwarePluginBase;
use Drupal\plugin\Component\Plugin\Exception\ContextException;
use Drupal\plugin\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\plugin\Core\Plugin\Context\Context;
use Drupal\plugin\Core\StringTranslation\StringTranslationTrait;
use Drupal\plugin\Core\TypedData\TypedDataTrait;
use Drupal\plugin\Component\Plugin\Context\ContextInterface as ComponentContextInterface;
use Drupal\plugin\Core\Plugin\Context\ContextInterface;

/**
 * Base class for plugins that are context aware.
 */
abstract class ContextAwarePluginBase extends ComponentContextAwarePluginBase {
  use TypedDataTrait;
  use StringTranslationTrait;
  use DependencySerializationTrait;

  /**
   * {@inheritdoc}
   *
   * This code is identical to the Component in order to pick up a different
   * Context class.
   */
  public function getContext($name) {
    // Check for a valid context value.
    if (!isset($this->context[$name])) {
      $this->context[$name] = new Context($this->getContextDefinition($name));
    }
    return $this->context[$name];
  }

  /**
   * {@inheritdoc}
   */
  public function setContext($name, ComponentContextInterface $context) {
    // Check that the context passed is an instance of our extended interface.
    if (!$context instanceof ContextInterface) {
      throw new ContextException("Passed $name context must be an instance of \\Drupal\plugin\\Core\\Plugin\\Context\\ContextInterface");
    }
    parent::setContext($name, $context);
  }

}
