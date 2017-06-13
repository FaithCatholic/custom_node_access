<?php

namespace Drupal\custom_node_access;

use Drupal\file\FileInterface;
use Drupal\file\FileUsage\DatabaseFileUsageBackend;

/**
 * Defines the database file usage backend. This is the default Drupal backend.
 */
class CustomFileUsage extends DatabaseFileUsageBackend {

  /**
   * {@inheritdoc}
   */
  public function add(FileInterface $file, $module, $type, $id, $count = 1) {
    // Prevent node grants from interfering with file access.
    if ($module === 'editor' && $type === 'node') {
      $type = 'file';
    }

    parent::add($file, $module, $type, $id, $count);
  }

  /**
   * {@inheritdoc}
   */
  public function delete(FileInterface $file, $module, $type = NULL, $id = NULL, $count = 1) {
    // Prevent node grants from interfering with file access.
    if ($module === 'editor' && $type === 'node') {
      $type = 'file';
    }

    parent::delete($file, $module, $type, $id, $count);
  }

}
