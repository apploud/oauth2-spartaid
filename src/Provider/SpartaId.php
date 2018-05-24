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

    /**
     * @var bool
     */
    private $environment = SpartaIdEnvironment::DEVELOPMENT;

    /**
     * @var string
     */
    private $returnUrl;


    public function setReturnUrl(string $url): void
    {
        $this->returnUrl = $url;
    }


    public function getBaseAuthorizationUrl(): string
    {
        return $this->getBaseUrl() . '/oauth2/authorize?returnUrl=' . $this->getReturnUrl();
    }


    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->getBaseUrl() . '/oauth2/access-token';
    }


    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $this->getBaseUrl() . '/api/1.0/profile?returnUrl=' . $this->getReturnUrl();
    }


    public function getProfileUrl(): string
    {
        return $this->getBaseUrl() . '/?returnUrl=' . $this->getReturnUrl();
    }


    public function getEditProfileUrl(): string
    {
        return $this->getBaseUrl() . '/user/edit-profile?returnUrl=' . $this->getReturnUrl();
    }


    public function getRegistrationUrl(): string
    {
        return $this->getBaseUrl() . '/sign/up?returnUrl=' . $this->getReturnUrl();
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


    protected function getReturnUrl(): string
    {
        if ($this->returnUrl) {
            return urlencode($this->returnUrl);
        }

        if (!isset($_SERVER['REQUEST_URI'])) {
            return '';
        }

        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $actualLink = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return urlencode($actualLink);
    }


    private function getBaseUrl(): string
    {
        return SpartaIdEnvironment::BASE_URL[$this->environment];
    }
}
