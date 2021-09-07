<?php

namespace Vasilvestre\Oauth2Brimetv;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class BrimeResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    private array $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getId()
    {
        return $this->getValueByKey($this->response, 'id');
    }

    public function toArray()
    {
        return $this->response;
    }
}
