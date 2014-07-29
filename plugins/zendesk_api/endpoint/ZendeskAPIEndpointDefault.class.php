<?php

/**
 * @file
 * Contains \ZendeskAPIEndpointDefault
 */

class ZendeskAPIEndpointDefault extends \ZendeskAPIEndpointBase implements \ZendeskAPIEndpointInterface {

  /**
   * Constructor.
   *
   * @param array $plugin
   *   The plugin definition array.
   *
   * @throws \ZendeskAPIException
   */
  public function __construct(array $plugin) {
    parent::__construct($plugin);

    $this->baseUrl = variable_get('zendesk_api_default_account_endpoint', '');
    $this->token = variable_get('zendesk_api_default_account_token', '');
    $this->username = variable_get('zendesk_api_default_account_username', '');

    // Bail if there is no value for base url, username or token.
    if (empty($this->baseUrl)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => 'zendesk_api_default_account_endpoint',
      )));
    }
    if (empty($this->token)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => 'zendesk_api_default_account_token',
      )));
    }
    if (empty($this->username)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => 'zendesk_api_default_account_username',
      )));
    }
  }

}
