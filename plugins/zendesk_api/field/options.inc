<?php

$plugin = array(
  'name' => 'options',
  'description' => t('A select field with allowed options defined in Zendesk.'),
  'class' => 'ZendeskAPIFieldOptions',
  'uri' => 'api/v2/ticket_fields/{id}.json',
);
