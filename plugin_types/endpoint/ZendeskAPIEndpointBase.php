<?php

/**
 * @file
 * Contains \ZendeskAPIEndpointBase
 */

abstract class ZendeskAPIEndpointBase extends \ZendeskAPIPluginBase implements \ZendeskAPIEndpointInterface {

  /**
   * @var string
   *
   * The base URL.
   */
  protected $baseUrl;

  /**
   * @var string
   *
   * The base URL.
   */
  protected $token;

  /**
   * @var string
   *
   * The username.
   */
  protected $username;

  /**
   * @var string
   *
   * The URI for the endpoint to set.
   */
  protected $uri;

  /**
   * @var int
   *
   * The timeout for the CURL call.
   */
  protected $timeout = 10;

  /**
   * Maximum numbers of redirects allowed before calling infinite recursion.
   */
  const MAX_REDIRECTS = 10;

  /**
   * Constructor.
   */
  public function __construct(array $plugin) {
    parent::__construct($plugin);
    // Allow timeout overrides.
    if (!empty($plugin['timeout'])) {
      $this->timeout = $plugin['timeout'];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function call($method = 'POST', array $body = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, self::MAX_REDIRECTS);

    curl_setopt($ch, CURLOPT_USERPWD, $this->getUsername() . "/token:". $this->getToken());
    switch($method){
      case 'POST':
      case 'PUT':
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_POSTFIELDS, drupal_json_encode($body));
        break;
      case 'DELETE':
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        break;
      case 'GET':
        // I
        $url = url($this->getUrl(), array(
          'query' => $body,
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        break;
      default:
        break;
    }
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_USERAGENT, 'Drupal (+http://drupal.org/)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
    $output = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($output);
    if (!empty($decoded->error)) {
      throw new \ZendeskAPIException($decoded->error);
    }
    return $decoded;
  }

  /**
   * {@inheritdoc}
   */
  public function getUri() {
    return $this->uri;
  }

  /**
   * {@inheritdoc}
   */
  public function setUri($uri) {
    $this->uri = $uri;
  }

  /**
   * {@inheritdoc}
   */
  public function getUrl() {
    return $this->baseUrl . '/' . $this->getUri();
  }

  /**
   * {@inheritdoc}
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * {@inheritdoc}
   */
  public function getUsername() {
    return $this->username;
  }

}