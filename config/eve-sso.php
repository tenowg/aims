<?php
use EveEsi\Scopes;

return [
    'database' => env('EVE_SSO_DATABASE', 'mysql'),
    'baseurl' => 'https://esi.evetech.net/latest/',
    'useragent' => 'Eve ESI Laravel package (Jenny Dawn)',
    'commit_data' => true,
    'scopes' => [
        Scopes::MAIL_SEND,
        Scopes::CONTACTS_CHARACTER_READ
    ],
    'main_host' => false
];