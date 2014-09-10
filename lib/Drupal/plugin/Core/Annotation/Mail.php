<?php

/**
 * @file
 * Contains \Drupal\plugin\Core\Annotation\Mail.
 */

namespace Drupal\plugin\Core\Annotation;

use Drupal\plugin\Component\Annotation\Plugin;

/**
 * Defines a Mail annotation object.
 *
 * Plugin Namespace: Plugin\Mail
 *
 * For a working example, see \Drupal\plugin\Core\Mail\Plugin\Mail\PhpMail
 *
 * @see \Drupal\plugin\Core\Mail\MailInterface
 * @see \Drupal\plugin\Core\Mail\MailManager
 * @see plugin_api
 *
 * @Annotation
 */
class Mail extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the mail plugin.
   *
   * @var \Drupal\plugin\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * A short description of the mail plugin.
   *
   * @var \Drupal\plugin\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
