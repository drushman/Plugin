<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Action\ConfigurableActionBase.
 */

namespace Drupal\plugin\Core\Action;

use Drupal\plugin\Component\Plugin\ConfigurablePluginInterface;
use Drupal\plugin\Core\Action\ActionBase;
use Drupal\plugin\Core\Form\FormStateInterface;
use Drupal\plugin\Core\Plugin\PluginFormInterface;

/**
 * Provides a base implementation for a configurable Action plugin.
 */
abstract class ConfigurableActionBase extends ActionBase implements ConfigurablePluginInterface, PluginFormInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->configuration += $this->defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfiguration(array $configuration) {
    $this->configuration = $configuration;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    return array();
  }

}
