<?php

/**
 * @file
 * Contains \ZendeskAPIEndpointInterface
 */

interface ZendeskAPIEndpointInterface {

  /**
   * Gets the configured endpoint uri.
   *
   * @return string
   *   The URI for the current endpoint.
   */
  public function getUri();

  /**
   * Sets the configured endpoint uri.
   *
   * @param string $uri
   *   The URI for the current endpoint.
   */
  public function setUri($uri);

  /**
   * Gets the token.
   *
   * @return string
   *   The token for the current endpoint.
   */
  public function getToken();

  /**
   * Gets the username.
   *
   * @return string
   *   The token for the current endpoint.
   */
  public function getUsername();

  /**
   * Gets the full URL to query.
   */
  public function getUrl();

  /**
   * Process a call over to Zendesk web service.
   *
   * @param string $method
   *   The HTTP method for the HTTP request.
   * @param array $body
   *   The body array to submit to Zendesk.
   *
   * @return array
   *   An array containing the response from Zendesk.
   *
   * @throws \ZendeskAPIException on error.
   */
  public function call($method = 'POST', array $body = array());

}
