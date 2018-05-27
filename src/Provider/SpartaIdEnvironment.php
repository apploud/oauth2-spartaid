<?php declare (strict_types=1);

namespace Apploud\OAuth2\Client\Provider;

class SpartaIdEnvironment
{
    public const PRODUCTION = 'production';

    public const DEVELOPMENT = 'development';

    public const BASE_URL = [
        self::PRODUCTION => 'https://id.sparta.cz',
        self::DEVELOPMENT => 'https://spartaid-dev.apploud.cz',
    ];
}
