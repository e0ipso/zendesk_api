<?php

$plugin = array(
  'label' => t('Submit ticket'),
  'name' => 'submit_ticket',
  'description' => t('Endpoint to the My Site ticket creation for submission purposes.'),
  // You will have to implement this class.
  'class' => 'ZendeskAPIEndpointTicket',
  // Import the settings from the my_site plugin endpoint. This will be handled
  // by ZendeskAPIEndpointTicket, not by the zendesk_api module. You can already
  // see the flexibility of this.
  'parent' => 'my_site',
);
