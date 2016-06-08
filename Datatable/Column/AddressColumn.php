<?php

namespace Sg\DatatablesBundle\Datatable\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

class AddressColumn extends VirtualColumn
{

    protected $country;
    protected $region;
    protected $zip_code;
    protected $city;
    protected $address;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return 'SgDatatablesBundle:Column:address.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'country' => null,
            'region' => null,
            'zip_code' => null,
            'city' => null,
            'address' => null
        ));

        $resolver->addAllowedTypes('country', 'string');
        $resolver->addAllowedTypes('region', 'string');
        $resolver->addAllowedTypes('zip_code', 'string');
        $resolver->addAllowedTypes('city', 'string');
        $resolver->addAllowedTypes('address', 'string');

        return $this;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setCountry($country)
    {
        if (empty($country) || !is_string($country)) {
            throw new InvalidArgumentException('setCountry(): Expecting non-empty string.');
        }
        $this->country = $country;
        return $this;
    }

    public function setRegion($region)
    {
        if (empty($region) || !is_string($region)) {
            throw new InvalidArgumentException('setRegion(): Expecting non-empty string.');
        }
        $this->region = $region;
        return $this;
    }

    public function setZipCode($zip_code)
    {
        if (empty($zip_code) || !is_string($zip_code)) {
            throw new InvalidArgumentException('setZipCode(): Expecting non-empty string.');
        }
        $this->zip_code = $zip_code;
        return $this;
    }

    public function setCity($city)
    {
        if (empty($city) || !is_string($city)) {
            throw new InvalidArgumentException('setCity(): Expecting non-empty string.');
        }
        $this->city = $city;
        return $this;
    }

    public function setAddress($address)
    {
        if (empty($address) || !is_string($address)) {
            throw new InvalidArgumentException('setAddress(): Expecting non-empty string.');
        }
        $this->address = $address;
        return $this;
    }
}
