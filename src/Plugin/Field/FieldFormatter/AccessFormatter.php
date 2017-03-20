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
    // $elements = [];

    // foreach ($items as $delta => $item) {
    //   $markup = '';

    //   if ($item->value1) {
    //     $markup .= $item->value1;
    //   }
    //   if ($item->value1 && $item->value1) {
    //     $markup .= ' ';
    //   }
    //   if ($item->value2) {
    //     $markup .= $item->value2;
    //   }

    //   if ($markup != '') {
    //     $elements[$delta] = ['#markup' => $markup];
    //   }
    // }

    // return $elements;
    return array();
  }

}
