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

    // Permission d'administration
    if ($operation === 'admin') {
      return AccessResult::allowedIfHasPermission($account, "vehicule admin");
    }

    // Permission pour tout autre operations.
    return AccessResult::allowedIfHasPermission($account, "vehicule use");
  }

  /**
   * {@inheritdoc}
   *
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'vehicule use');
  }

}
