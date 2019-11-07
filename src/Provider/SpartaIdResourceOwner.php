<?php declare (strict_types=1);

namespace Apploud\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class SpartaIdResourceOwner implements ResourceOwnerInterface
{
	public const GENDER_MALE = 'Muž';
	public const GENDER_FEMALE = 'Žena';

    /**
     * @var mixed[]
     */
    private $data;


    /**
     * @param mixed[] $data
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


    public function getGender(): string
    {
        return $this->data['gender'];
    }


    public function getSalesforceId(): string
    {
        return $this->data['salesforce_id'];
    }


	public function hasActiveMembership(): bool
	{
		return $this->data['has_membership'];
	}


	public function getYourpassUrl(): ?string
	{
		return $this->data['yourpass_url'] ?: null;
	}


    public function toArray(): array
    {
        return $this->data;
    }
}
