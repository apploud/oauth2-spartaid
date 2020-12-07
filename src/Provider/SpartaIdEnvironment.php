<?php declare (strict_types=1);

namespace Apploud\OAuth2\Client\Provider;

class SpartaIdEnvironment
{
    public const PRODUCTION = 'production';

    public const STAGING = 'staging';

    public const DEVELOPMENT = 'development';

    public const CLIENT = 'client';

    public const BASE_URL = [
        self::PRODUCTION => 'https://id.sparta.cz',
        self::STAGING => 'https://sparta-id.apploud.cz',
        self::DEVELOPMENT => 'https://ssr7dev.apploud.cz/sparta/id',
        self::CLIENT => 'https://ssr7client.apploud.cz/sparta/id',
    ];
}
