<?php

namespace Vasilvestre\Oauth2Brimetv;

use Exception;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Brime extends AbstractProvider
{
    use BearerAuthorizationTrait;

    private $basicUrl = "https://auth.brime.tv";

    public function getBaseAuthorizationUrl(): string
    {
        return $this->basicUrl . "/authorize";
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->basicUrl . "/oauth/token";
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return "https://api.brime.tv/v1/account/me";
    }

    protected function getDefaultScopes(): array
    {
        return ['email'];
    }

    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if ($response->getStatusCode() >= 400) {
            throw new Exception($response->getBody());
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token): BrimeResourceOwner
    {
        return new BrimeResourceOwner($response);
    }
}
