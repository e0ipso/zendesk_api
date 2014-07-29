<?php

/**
 * @file
 * Contains \ZendeskAPIEndpointVariable
 */

class ZendeskAPIEndpointVariable extends \ZendeskAPIEndpointBase implements \ZendeskAPIEndpointInterface {

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

    $this->baseUrl = variable_get($plugin['base_url_variable'], '');
    $this->token = variable_get($plugin['token_variable'], '');
    $this->username = variable_get($plugin['username_variable'], '');

    // Bail if there is no value for base url, username or token.
    if (empty($this->baseUrl)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => $plugin['base_url_variable'],
      )));
    }
    if (empty($this->token)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => $plugin['token_variable'],
      )));
    }
    if (empty($this->username)) {
      throw new ZendeskAPIException(format_string('No variable stored in @variable_name.', array(
        '@variable_name' => $plugin['username_variable'],
      )));
    }
  }

}
