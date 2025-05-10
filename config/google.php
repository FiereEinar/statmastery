<?php

return [
  'client_id' => env('GOOGLE_CLIENT_ID'),
  'client_secret' => env('GOOGLE_CLIENT_SECRET'),
  'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
  'scopes' => [
    \Google\Service\Calendar::CALENDAR,
    \Google\Service\Calendar::CALENDAR_EVENTS,
    'https://www.googleapis.com/auth/calendar.events',
    'https://www.googleapis.com/auth/calendar',
    'https://www.googleapis.com/auth/userinfo.profile',
    'https://www.googleapis.com/auth/userinfo.email'
  ],
];