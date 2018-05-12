<?php declare (strict_types=1);

namespace Apploud\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class SpartaIdResourceOwner implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    private $data;


    /**
     * @param string[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function getId()
    {
        return $this->data['id'];
    }


    public function getEmail(): string
    {
        return $this->data['email'];
    }


    public function getFirstName(): string
    {
        return $this->data['first_name'];
    }


    public function getLastName(): string
    {
        return $this->data['last_name'];
    }


    public function getSalesforceId(): string
    {
        return $this->data['salesforce_id'];
    }


    public function toArray(): array
    {
        return $this->data;
    }
}
