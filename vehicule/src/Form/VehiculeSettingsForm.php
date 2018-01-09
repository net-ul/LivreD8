<?php

namespace Drupal\vehicule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class VehiculeSettingsForm.
 *
 * @package Drupal\vehicule\Form
 *
 * @ingroup vehicule
 */
class VehiculeSettingsForm extends FormBase {

  /**
   * Get Form ID.
   */
  public function getFormId() {
    return 'vehicule_entity_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['contact_settings']['#markup'] = 'Settings form for Vehicule Entity. Manage field settings here.';
    return $form;
  }

}
