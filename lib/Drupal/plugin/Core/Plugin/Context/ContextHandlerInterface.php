<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Plugin\Context\ContextHandlerInterface.
 */

namespace Drupal\plugin\Core\Plugin\Context;

use Drupal\plugin\Component\Plugin\ContextAwarePluginInterface;
use Drupal\plugin\Core\TypedData\DataDefinitionInterface;

/**
 * Provides an interface for handling sets of contexts.
 */
interface ContextHandlerInterface {

  /**
   * Determines plugins whose constraints are satisfied by a set of contexts.
   *
   * @todo Use context definition objects after https://Drupal\plugin.org/node/2281635.
   *
   * @param \Drupal\plugin\Component\Plugin\Context\ContextInterface[] $contexts
   *   An array of contexts.
   * @param array $definitions .
   *   An array of plugin definitions.
   *
   * @return array
   *   An array of plugin definitions.
   */
  public function filterPluginDefinitionsByContexts(array $contexts, array $definitions);

  /**
   * Checks a set of requirements against a set of contexts.
   *
   * @todo Use context definition objects after https://Drupal\plugin.org/node/2281635.
   *
   * @param \Drupal\plugin\Component\Plugin\Context\ContextInterface[] $contexts
   *   An array of available contexts.
   * @param \Drupal\plugin\Core\TypedData\DataDefinitionInterface[] $requirements
   *   An array of requirements.
   *
   * @return bool
   *   TRUE if all of the requirements are satisfied by the context, FALSE
   *   otherwise.
   */
  public function checkRequirements(array $contexts, array $requirements);

  /**
   * Determines which contexts satisfy the constraints of a given definition.
   *
   * @todo Use context definition objects after https://Drupal\plugin.org/node/2281635.
   *
   * @param \Drupal\plugin\Component\Plugin\Context\ContextInterface[] $contexts
   *   An array of contexts.
   * @param \Drupal\plugin\Core\TypedData\DataDefinitionInterface $definition
   *   The definition to satisfy.
   *
   * @return \Drupal\plugin\Component\Plugin\Context\ContextInterface[]
   *   An array of matching contexts.
   */
  public function getMatchingContexts(array $contexts, DataDefinitionInterface $definition);

  /**
   * Prepares a plugin for evaluation.
   *
   * @param \Drupal\plugin\Component\Plugin\ContextAwarePluginInterface $plugin
   *   A plugin about to be evaluated.
   * @param \Drupal\plugin\Component\Plugin\Context\ContextInterface[] $contexts
   *   An array of contexts to set on the plugin. They will only be set if they
   *   match the plugin's context definitions.
   * @param array $mappings
   *   (optional) A mapping of the expected assignment names to their context
   *   names. For example, if one of the $contexts is named 'entity', but the
   *   plugin expects a context named 'node', then this map would contain
   *   'entity' => 'node'.
   *
   * @throws \Drupal\plugin\Component\Plugin\Exception\ContextException
   *   Thrown when a context assignment was not satisfied.
   */
  public function applyContextMapping(ContextAwarePluginInterface $plugin, $contexts, $mappings = array());

}
