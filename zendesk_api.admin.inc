<?php

/**
 * @file
 * Admin file implementations.
 */

function zendesk_api_settings_form($form, &$form_state) {
  $form['zendesk_api_default_account_endpoint'] = array(
    '#type' => 'textfield',
    '#title' => t('Default endpoint'),
    '#description' => t('The endpoint that will be used if the endpoint plugin does not specify another one.'),
    '#default_value' => variable_get('zendesk_api_default_account_endpoint', ''),
  );
  $form['zendesk_api_default_account_token'] = array(
    '#type' => 'textfield',
    '#title' => t('Default token'),
    '#description' => t('The token that will be used if the endpoint plugin does not specify another one.'),
    '#default_value' => variable_get('zendesk_api_default_account_token', ''),
  );
  $form['zendesk_api_default_account_username'] = array(
    '#type' => 'textfield',
    '#title' => t('Default username'),
    '#description' => t('The username that will be used if the endpoint plugin does not specify another one.'),
    '#default_value' => variable_get('zendesk_api_default_account_username', ''),
  );
  return system_settings_form($form);
}
