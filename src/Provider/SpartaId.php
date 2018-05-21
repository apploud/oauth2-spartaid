<?php declare (strict_types=1);

namespace Apploud\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class SpartaId extends AbstractProvider
{
    use BearerAuthorizationTrait;

    public const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'id';

    private const BASE = 'https://id.sparta.cz';


    public function getBaseAuthorizationUrl(): string
    {
        return self::BASE . '/oauth2/authorize?returnUrl=' . $this->getRequestUri();
    }


    public function getBaseAccessTokenUrl(array $params): string
    {
        return self::BASE . '/oauth2/access-token';
    }


    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return self::BASE . '/api/1.0/profile';
    }


    public function getProfileUrl(): string
    {
        return self::BASE . '/?returnUrl=' . $this->getRequestUri();
    }


    public function getEditProfileUrl(): string
    {
        return self::BASE . '/user/edit-profile?returnUrl=' . $this->getRequestUri();
    }


    public function getRegistrationUrl(): string
    {
        return self::BASE . '/sign/up?returnUrl=' . $this->getRequestUri();
    }


    /**
     * @return string[]
     */
    protected function getDefaultScopes(): array
    {
        return ['profile'];
    }


    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                $data['message'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                (array) $response
            );
        }
    }


    protected function createResourceOwner(array $response, AccessToken $token): SpartaIdResourceOwner
    {
        return new SpartaIdResourceOwner($response);
    }


    protected function getRequestUri(): string
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return '';
        }

        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $actualLink = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $actualLink;
    }
}
