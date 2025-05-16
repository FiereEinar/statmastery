<?php

return [
  'client_id' => env('GOOGLE_CLIENT_ID'),
  'client_secret' => env('GOOGLE_CLIENT_SECRET'),
  'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
  'redirect_uri_admin' => env('GOOGLE_REDIRECT_URI_ADMIN'),
  'scopes' => [
    \Google\Service\Calendar::CALENDAR,
    \Google\Service\Calendar::CALENDAR_EVENTS,
    'https://www.googleapis.com/auth/calendar.events',
    'https://www.googleapis.com/auth/calendar',
    'https://www.googleapis.com/auth/userinfo.profile',
    'https://www.googleapis.com/auth/userinfo.email'
  ],
];