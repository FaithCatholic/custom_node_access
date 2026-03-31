<?php

namespace Drupal\custom_node_access\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\user\Entity\Role;

/**
 * Plugin implementation of the 'access' formatter.
 *
 * @FieldFormatter(
 * id = "access_formatter",
 * label = @Translation("Access"),
 * field_types = {
 * "access_type"
 * }
 * )
 */
class AccessFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      // Get the comma-separated string from the field property
      // defined in your custom field type.
      $roles_string = $item->custom_node_access_view_roles;

      if (!empty($roles_string)) {
        // Split the string into individual role machine names
        $role_ids = explode(',', $roles_string);
        $role_labels = [];

        foreach ($role_ids as $role_id) {
          $role_id = trim($role_id);
          
          // Attempt to load the role entity to get its human-readable label
          $role_entity = Role::load($role_id);
          
          if ($role_entity) {
            $role_labels[] = $role_entity->label();
          } 
          else {
            // Fallback to the ID if the role entity can't be loaded
            $role_labels[] = $role_id;
          }
        }

        // Create the render array for the View column
        $elements[$delta] = [
          '#markup' => implode(', ', $role_labels),
        ];
      }
    }

    return $elements;
  }

}