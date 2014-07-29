<?php

/**
 * @file
 * Contains \ZendeskAPIEndpointSubmitTicket
 */

class ZendeskAPIEndpointSubmitTicket extends \ZendeskAPIEndpointBase implements \ZendeskAPIEndpointInterface {

  /**
   * Ticket URI.
   */
  const TICKET_URI = 'api/v2/tickets.json';

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

    // We just made this up for our convenience. 'parent' is no standard plugin
    // definition key.
    $endpoint = zendesk_api_get_plugin_handler($plugin['parent'], 'endpoint');
    $this->baseUrl = $endpoint->baseUrl;
    $this->token = $endpoint->token;
    $this->username = $endpoint->username;
    $this->setUri(self::TICKET_URI);

    // Bail if there is no value for base url, username or token.
    if (empty($this->baseUrl)) {
      throw new ZendeskAPIException(format_string('No base url set.'));
    }
    if (empty($this->token)) {
      throw new ZendeskAPIException(format_string('No base token set.'));
    }
    if (empty($this->username)) {
      throw new ZendeskAPIException(format_string('No base username set.'));
    }
  }

}