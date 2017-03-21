<?php

namespace Drupal\custom_node_access\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'access' formatter.
 *
 * @FieldFormatter(
 *   id = "access_formatter",
 *   label = @Translation("Access"),
 *   field_types = {
 *     "access_type"
 *   }
 * )
 */
class AccessFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    return array();
  }

}
