<?php

namespace Sg\DatatablesBundle\Datatable\Column;

use Sg\DatatablesBundle\Datatable\Action\Action;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

class TitleWithDateColumn extends VirtualColumn
{

    protected $dateFormat;
    protected $date;
    protected $main;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return 'SgBundle:Column:titlewithdate.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'titlewithdate';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'date_format' => 'lll',
            'main' => null,
            'date' => null
        ));

        $resolver->addAllowedTypes('date_format', 'string');
        $resolver->addAllowedTypes('main', 'string');
        $resolver->addAllowedTypes('date', 'string');

        return $this;
    }

    public function setDateFormat($dateFormat)
    {
        if (empty($dateFormat) || !is_string($dateFormat)) {
            throw new InvalidArgumentException('setDateFormat(): Expecting non-empty string.');
        }

        $this->dateFormat = $dateFormat;

        return $this;
    }

    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setMain($main)
    {
        if (empty($main) || !is_string($main)) {
            throw new InvalidArgumentException('setMain(): Expecting non-empty string.');
        }
        $this->main = $main;
        return $this;
    }

    public function setDate($date)
    {
        if (empty($date) || !is_string($date)) {
            throw new InvalidArgumentException('setDate(): Expecting non-empty string.');
        }
        $this->date = $date;
        return $this;
    }
}
