<?php

namespace Drupal\specbee_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SpecbeeLocation extends ConfigFormBase {

  /**
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'specbee_location.adminsettings',  
    ];  
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'specbee_location_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('specbee_location.adminsettings');
    // Country field.
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
      '#description' => $this->t('Site country.'),
    ];
    // City field.
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
      '#description' => $this->t('Site city.'),
    ];
    // Timezone select field.
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#default_value' => $config->get('timezone'),
      '#options' => $this->timezoneOptions(),
    ];

    return $form;
  }

  public function timezoneOptions() {
    return [
      '1' => $this->t('America/Chicago'),
      '2' => $this->t('America/New_York'),
      '3' => $this->t('Asia/Tokyo'),
      '4' => $this->t('Asia/Kolkata'),
      '5' => $this->t('Europe/Amsterdam'),
      '6' => $this->t('Europe/Oslo'),
      '7' => $this->t('Europe/London'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('specbee_location.adminsettings');
    $config->set('country', $form_state->getValue('country'));
    $config->set('city', $form_state->getValue('city'));
    $config->set('timezone', $form_state->getValue('timezone'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }
}
