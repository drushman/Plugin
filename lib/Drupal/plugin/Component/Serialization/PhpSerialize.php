<?php

/**
 * @file
 * Contains \Drupal\plugin\Component\Serialization\PhpSerialize.
 */

namespace Drupal\plugin\Component\Serialization;

/**
 * Default serialization for serialized PHP.
 */
class PhpSerialize implements SerializationInterface {

  /**
   * {@inheritdoc}
   */
  public static function encode($data) {
    return serialize($data);
  }

  /**
   * {@inheritdoc}
   */
  public static function decode($raw) {
    return unserialize($raw);
  }

  /**
   * {@inheritdoc}
   */
  public static function getFileExtension() {
    return 'serialized';
  }

}
