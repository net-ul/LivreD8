<?php

namespace Drupal\vehicule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Returns responses for vehicule routes.
 */
class VehiculeController extends ControllerBase {

  /**
   * Displays add content links for available content types.
   */
  public function addPage() {
    $build = [
      '#theme' => 'table',
    ];

    $content = [];
    foreach ($this->entityManager()->getStorage('vehicule_type')->loadMultiple() as $type) {
      $link = Url::fromRoute('entity.vehicule.add', ['vehicule_type' => $type->id()]);
      $content[] = [$type->label(), $type->id(), $link];
    }

    $build['#rows'] = $content;

    return $build;
  }

}
