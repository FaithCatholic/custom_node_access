<?php

namespace Drupal\custom_node_access\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'access' field type.
 *
 * @FieldType(
 *   id = "access_type",
 *   label = @Translation("Access"),
 *   description = @Translation("A custom node access field."),
 *   default_widget = "access_widget",
 *   default_formatter = "access_formatter"
 * )
 */
class AccessType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['custom_node_access_view_roles'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('View roles'))
      ->setRequired(FALSE);
    // $properties['custom_node_access_edit_roles'] = DataDefinition::create('string')
    //   ->setLabel(new TranslatableMarkup('Edit roles'))
    //   ->setRequired(FALSE);
    // $properties['custom_node_access_author_roles'] = DataDefinition::create('string')
    //   ->setLabel(new TranslatableMarkup('Author roles'))
    //   ->setRequired(FALSE);
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'custom_node_access_view_roles' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        // 'custom_node_access_edit_roles' => [
        //   'type' => 'varchar',
        //   'length' => 255,
        // ],
        // 'custom_node_access_author_roles' => [
        //   'type' => 'varchar',
        //   'length' => 255,
        // ],
      ],
    ];

    return $schema;
  }

}
