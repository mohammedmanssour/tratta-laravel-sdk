<?php

return [
    /**
     * The Tratta API is available in production and sandbox environments. The sandbox environment can be used to test your integration
     *
     * @see https://docs.tratta.io/api.html#environments
     */
    'environment' => env('TRATTA_ENVIRONMENT', 'sandbox'),

    'org_id' => env('TRATTA_ORG_ID', ''),

    /**
     * Tratta API uses Access Tokens to authenticate requests. Request access token from https://share.hsforms.com/1rJiX8oLjT1qvYwaJTwEOXA39vzd
     *
     * @see https://docs.tratta.io/api.html#authentication
     */
    'api_key' => env('TRATTA_API_KEY', ''),
];
