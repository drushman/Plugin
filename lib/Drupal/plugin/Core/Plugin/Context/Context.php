<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\Context.
 */

namespace Drupal\plugin\Core\Plugin\Context;

use Drupal\plugin\Component\Plugin\Context\Context as ComponentContext;
use Drupal\plugin\Component\Plugin\Exception\ContextException;
use Drupal\plugin\Component\Utility\String;
use Drupal\plugin\Core\Entity\ContentEntityInterface;
use Drupal\plugin\Core\TypedData\TypedDataInterface;
use Drupal\plugin\Core\TypedData\TypedDataTrait;

/**
 * A Drupal\plugin specific context wrapper class.
 */
class Context extends ComponentContext implements ContextInterface {

  use TypedDataTrait;

  /**
   * The data associated with the context.
   *
   * @var \Drupal\plugin\Core\TypedData\TypedDataInterface
   */
  protected $contextData;

  /**
   * The definition to which a context must conform.
   *
   * @var \Drupal\plugin\Core\Plugin\Context\ContextDefinitionInterface
   */
  protected $contextDefinition;

  /**
   * {@inheritdoc}
   */
  public function getContextValue() {
    if (!isset($this->contextData)) {
      $definition = $this->getContextDefinition();
      if ($definition->isRequired()) {
        $type = $definition->getDataType();
        throw new ContextException(String::format("The @type context is required and not present.", array('@type' => $type)));
      }
      return NULL;
    }
    // Special case entities.
    // @todo: Remove once entities do not implemented TypedDataInterface.
    if ($this->contextData instanceof ContentEntityInterface) {
      return $this->contextData;
    }
    return $this->contextData->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setContextValue($value) {
    if ($value instanceof TypedDataInterface) {
      return $this->setContextData($value);
    }
    else {
      return $this->setContextData($this->getTypedDataManager()->create($this->contextDefinition->getDataDefinition(), $value));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    return $this->contextDefinition->getConstraints();
  }

  /**
   * {@inheritdoc}
   */
  public function getContextData() {
    return $this->contextData;
  }

  /**
   * {@inheritdoc}
   */
  public function setContextData(TypedDataInterface $data) {
    $this->contextData = $data;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getContextDefinition() {
    return $this->contextDefinition;
  }

  /**
   * {@inheritdoc}
   */
  public function validate() {
    return $this->getContextData()->validate();
  }

}
