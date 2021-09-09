<?php

namespace Vasilvestre\Oauth2Brimetv\Test;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Vasilvestre\Oauth2Brimetv\Brime;
use PHPUnit\Framework\TestCase;

class BrimeTest extends TestCase
{
    private Brime $provider;

    public function tearDown(): void
    {
        parent::tearDown();
    }

    protected function setUp(): void
    {
        $this->provider = new Brime([
            'clientId' => 'mock_client_id',
            'clientSecret' => 'mock_secret',
            'redirectUri' => 'none'
        ]);
    }

    public function testGetResourceOwnerDetailsUrl()
    {
        $token = new AccessToken(['access_token' => 'mock_access_token']);
        $url = $this->provider->getResourceOwnerDetailsUrl($token);
        $uri = parse_url($url);
        $this->assertEquals(Brime::USER_RESOURCE, $uri['path']);
    }

    public function testGetBaseAccessTokenUrl()
    {
        $params = [];
        $url = $this->provider->getBaseAccessTokenUrl($params);
        $uri = parse_url($url);
        $this->assertEquals(Brime::OAUTH_TOKEN_PATH, $uri['path']);
    }
}
