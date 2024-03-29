<?php

/**
 * @file
 * Contains \Drupal\plugin\Component\Plugin\Context\Context.
 */

namespace Drupal\plugin\Component\Plugin\Context;

use Drupal\plugin\Component\Plugin\Exception\ContextException;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

/**
 * A generic context class for wrapping data a plugin needs to operate.
 */
class Context implements ContextInterface {

  /**
   * The value of the context.
   *
   * @var mixed
   */
  protected $contextValue;

  /**
   * The definition to which a context must conform.
   *
   * @var \Drupal\plugin\Component\Plugin\Context\ContextDefinitionInterface
   */
  protected $contextDefinition;

  /**
   * Sets the contextDefinition for us without needing to call the setter.
   *
   * @param \Drupal\plugin\Component\Plugin\Context\ContextDefinitionInterface $context_definition
   *   The context definition.
   */
  public function __construct(ContextDefinitionInterface $context_definition) {
    $this->contextDefinition = $context_definition;
  }

  /**
   * Implements \Drupal\plugin\Component\Plugin\Context\ContextInterface::setContextValue().
   */
  public function setContextValue($value) {
    $this->contextValue = $value;
  }

  /**
   * Implements \Drupal\plugin\Component\Plugin\Context\ContextInterface::getContextValue().
   */
  public function getContextValue() {
    // Support optional contexts.
    if (!isset($this->contextValue)) {
      $definition = $this->getContextDefinition();
      if ($definition->isRequired()) {
        $type = $definition->getDataType();
        throw new ContextException(sprintf("The %s context is required and not present.", $type));
      }
      return NULL;
    }
    return $this->contextValue;
  }

  /**
   * {@inheritdoc}
   */
  public function setContextDefinition(ContextDefinitionInterface $context_definition) {
    $this->contextDefinition = $context_definition;
  }

  /**
   * Implements \Drupal\plugin\Component\Plugin\Context\ContextInterface::getContextDefinition().
   */
  public function getContextDefinition() {
    return $this->contextDefinition;
  }

  /**
   * Implements \Drupal\plugin\Component\Plugin\Context\ContextInterface::getConstraints().
   */
  public function getConstraints() {
    if (empty($this->contextDefinition['class'])) {
      throw new ContextException("An error was encountered while trying to validate the context.");
    }
    return array(new Type($this->contextDefinition['class']));
  }

  /**
   * Implements \Drupal\plugin\Component\Plugin\Context\ContextInterface::validate().
   */
  public function validate() {
    $validator = Validation::createValidatorBuilder()
      ->getValidator();
    return $validator->validateValue($this->getContextValue(), $this->getConstraints());
  }

}
