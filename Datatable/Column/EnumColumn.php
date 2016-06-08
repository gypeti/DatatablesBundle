<?php

namespace Sg\DatatablesBundle\Datatable\Column;

use Symfony\Component\OptionsResolver\OptionsResolver;

class EnumColumn extends Column
{

    protected $enumType;
    protected $map;

    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return 'SgDatatablesBundle:Column:enum.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'enum';
    }

    //-------------------------------------------------
    // OptionsInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('enum_type', null);

        $resolver->addAllowedTypes('enum_type', 'string');

        return $this;
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Set enumType.
     *
     * @param string $enumType
     *
     * @return $this
     */
    public function setEnumType($enumType)
    {
        $this->enumType = $enumType;
        $this->map = $enumType::getChoices();

        return $this;
    }

    /**
     * Get enumType.
     *
     * @return string
     */
    public function getEnumType()
    {
        return $this->enumType;
    }

    /**
     *
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }
}
