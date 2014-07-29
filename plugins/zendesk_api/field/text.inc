<?php

$plugin = array(
  'name' => 'text',
  'description' => t('A text field as defined in Zendesk.'),
  'class' => 'ZendeskAPIFieldText',
  'uri' => 'api/v2/ticket_fields/{id}.json',
);
