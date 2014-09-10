<?php
/**
 * @file
 * Definition of Drupal\plugin\Core\Plugin\Exception\InvalidDecoratedMethod.
 */

namespace Drupal\plugin\Component\Plugin\Exception;

use Drupal\plugin\Component\Plugin\Exception\ExceptionInterface;
use \BadMethodCallException;

/**
 * Exception thrown when a decorator's _call() method is triggered, but the
 * decorated object does not contain the requested method.
 *
 */
class InvalidDecoratedMethod extends BadMethodCallException implements ExceptionInterface { }
