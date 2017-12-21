<?php

namespace Drupal\vehicule;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access controller for the comment entity.
 */
class VehiculeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    // Permission d'administration.
    if ($operation === 'admin') {
      return AccessResult::allowedIfHasPermission($account, "vehicule admin");
    }
    
    // Voir les entité.
    if ($operation === 'view') {
      return AccessResult::allowedIfHasPermission($account, "vehicule view");
    }
    
    // modifications des entité.
    if (in_array($operation, ['update', 'edit', 'delete'])) {
      return AccessResult::allowedIfHasPermission($account, "vehicule edit");
    }

    // Tout autre opérations sont interdite.
    return AccessResult::forbidden();
  }

  /**
   * {@inheritdoc}
   *
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'vehicule edit');
  }

}
