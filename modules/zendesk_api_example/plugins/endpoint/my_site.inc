<?php

// You can have a different endpoint than default.
$plugin = array(
  'label' => t('My Site'),
  'name' => 'my_site',
  'description' => t('Endpoint plugin for the My Site Zendesk instace.'),
  'class' => 'ZendeskAPIEndpointVariable',
  // I will probably set these variables in my settings.php with different
  // values per environment.
  'base_url_variable' => 'zendesk_api_my_site_account_endpoint',
  'base_url_token' => 'zendesk_api_my_site_account_token',
  'username_variable' => 'zendesk_api_my_site_account_username',
);
