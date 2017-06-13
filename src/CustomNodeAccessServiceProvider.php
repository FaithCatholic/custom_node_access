<?php

namespace Drupal\custom_node_access;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

class CustomNodeAccessServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    if ($container->hasDefinition('file.usage')) {
      $container->getDefinition('file.usage')->setClass(CustomFileUsage::class);
    }
  }

}
