<?php

namespace Drupal\custom_node_access\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'access' widget.
 *
 * @FieldWidget(
 *   id = "access_widget",
 *   label = @Translation("Access"),
 *   field_types = {
 *     "access_type"
 *   }
 * )
 */
class AccessWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $realms = array(
      'custom_node_access_view' => 'View access',
      'custom_node_access_edit' => 'Edit access',
      'custom_node_access_author' => 'Delete access',
    );

    $roles = [];
    foreach (user_roles() as $role) {
      if (!$role->isAdmin()) {
        $roles[$role->id()] = $role->label();
      }
    }

    foreach ($realms as $realm_id => $realm_label) {
      if ($items[$delta]->{$realm_id .'_roles'} != '') {
        $enabled_default = 1;
      } else {
        $enabled_default = 0;
      }
      $element[$realm_id .'_enabled'] = array(
        '#type' => 'checkbox',
        '#title' => t($realm_label),
        '#default_value' => $enabled_default,
      );
      $element[$realm_id .'_roles'] = array(
        '#description' => 'Ctrl+click to select multiple.',
        '#default_value' => isset($items[$delta]->{$realm_id .'_roles'}) ? explode(',', $items[$delta]->{$realm_id .'_roles'}) : NULL,
        '#empty_value' => '_none',
        '#multiple' => TRUE,
        '#options' => $roles,
        '#required' => FALSE,
        '#type' => 'select',
        '#states' => array(
          'invisible' => array(
            'input[name="field_access[0]['. $realm_id .'_enabled]"]' => array('checked' => FALSE),
          ),
        ),
      );
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach($values[0] as $key => &$value) {

      // Clear data if realm is unchecked in form.
      if ($key === 'custom_node_access_view_enabled' && $value !== 1) {
        $values[0]['custom_node_access_view_roles'] = NULL;
      }
      if ($key === 'custom_node_access_edit_enabled' && $value !== 1) {
        $values[0]['custom_node_access_edit_roles'] = NULL;
      }
      if ($key === 'custom_node_access_author_enabled' && $value !== 1) {
        $values[0]['custom_node_access_author_roles'] = NULL;
      }

      // Suppress primitive error by converting array value to a string value.
      // Combine multiple roles into a comma seperated value.
      $value = implode(',', $value);

    }
    return $values;
  }

}
