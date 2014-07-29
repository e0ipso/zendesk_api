<?php

/**
 * @file
 * Contains \ZendeskAPIPluginBase.
 */

class ZendeskAPIPluginBase {

  /**
   * @var array
   *
   * The plugin definition array.
   */
  protected $plugin;

  /**
   * Class constructor.
   *
   * @param array $plugin
   *   The plugin definition array.
   */
  public function __construct(array $plugin) {
    $this->plugin = $plugin;
  }

  /**
   * {@inheritdoc}
   */
  public function getPuginInfo() {
    return $this->plugin;
  }

}
