# Sparta ID OAuth2 provider

##Usage

```php
$config = [
    'clientId' => 'my-client-id',
    'clientSecret' => 'my-client-secret',
    'redirectUri' => 'https://my-uri.example.com',
    'environment' => Apploud\OAuth2\Client\Provider\SpartaIdEnvironment::PRODUCTION, 
    // OR
    'environment' => Apploud\OAuth2\Client\Provider\SpartaIdEnvironment::DEVELOPMENT, 
];

$provider = new Apploud\OAuth2\Client\Provider\SpartaId($config);
```

Afterwards, use this provider as you would otherwise do, with any other OAuth2 provider from PHPLeague ([see docs](https://github.com/thephpleague/oauth2-client)).