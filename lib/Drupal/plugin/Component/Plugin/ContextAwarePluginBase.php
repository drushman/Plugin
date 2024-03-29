<?php

/**
 * @file
 * Contains \Drupal\plugin\Component\Plugin\ContextAwarePluginBase
 */

namespace Drupal\plugin\Component\Plugin;

use Drupal\plugin\Component\Plugin\Context\ContextInterface;
use Drupal\plugin\Component\Plugin\Exception\ContextException;
use Drupal\plugin\Component\Plugin\Context\Context;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Base class for plugins that are context aware.
 */
abstract class ContextAwarePluginBase extends PluginBase implements ContextAwarePluginInterface {

  /**
   * The data objects representing the context of this plugin.
   *
   * @var \Drupal\plugin\Component\Plugin\Context\ContextInterface[]
   */
  protected $context;

  /**
   * Overrides \Drupal\plugin\Component\Plugin\PluginBase::__construct().
   *
   * Overrides the construction of context aware plugins to allow for
   * unvalidated constructor based injection of contexts.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    $context = array();
    if (isset($configuration['context'])) {
      $context = $configuration['context'];
      unset($configuration['context']);
    }
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    foreach ($context as $key => $value) {
      $context_definition = $this->getContextDefinition($key);
      $this->context[$key] = new Context($context_definition);
      $this->context[$key]->setContextValue($value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getContextDefinitions() {
    $definition = $this->getPluginDefinition();
    return !empty($definition['context']) ? $definition['context'] : array();
  }

  /**
   * {@inheritdoc}
   */
  public function getContextDefinition($name) {
    $definition = $this->getPluginDefinition();
    if (empty($definition['context'][$name])) {
      throw new ContextException(sprintf("The %s context is not a valid context.", $name));
    }
    return $definition['context'][$name];
  }

  /**
   * {@inheritdoc}
   */
  public function getContexts() {
    // Make sure all context objects are initialized.
    foreach ($this->getContextDefinitions() as $name => $definition) {
      $this->getContext($name);
    }
    return $this->context;
  }

  /**
   * {@inheritdoc}
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
  public function setContext($name, ContextInterface $context) {
    $this->context[$name] = $context;
  }

  /**
   * {@inheritdoc}
   */
  public function getContextValues() {
    $values = array();
    foreach ($this->getContextDefinitions() as $name => $definition) {
      $values[$name] = isset($this->context[$name]) ? $this->context[$name]->getContextValue() : NULL;
    }
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function getContextValue($name) {
    return $this->getContext($name)->getContextValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setContextValue($name, $value) {
    $this->getContext($name)->setContextValue($value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function validateContexts() {
    $violations = new ConstraintViolationList();
    // @todo: Implement symfony validator API to let the validator traverse
    // and set property paths accordingly.

    foreach ($this->getContexts() as $context) {
      $violations->addAll($context->validate());
    }
    return $violations;
  }

}
