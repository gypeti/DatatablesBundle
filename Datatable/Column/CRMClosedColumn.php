<?php

namespace Sg\DatatablesBundle\Datatable\Column;

use Sg\DatatablesBundle\Datatable\Action\Action;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

class CRMClosedColumn extends VirtualColumn
{

    protected $dateFormat;
    protected $closed;
    protected $closedby;
    protected $reason;
    protected $date;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return 'SgDatatablesBundle:Column:crmclosed.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'crmclosed';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'date_format' => 'lll',
            'closed' => null,
            'closedby' => null,
            'reason' => null,
            'date' => null
        ));

        $resolver->addAllowedTypes('date_format', 'string');
        $resolver->addAllowedTypes('closed', 'string');
        $resolver->addAllowedTypes('closedby', 'string');
        $resolver->addAllowedTypes('reason', 'string');
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

    public function setDate($date)
    {
        if (empty($date) || !is_string($date)) {
            throw new InvalidArgumentException('setDate(): Expecting non-empty string.');
        }

        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getClosed()
    {
        return $this->closed;
    }

    public function getClosedby()
    {
        return $this->closedby;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setClosed($closed)
    {
        if (empty($closed) || !is_string($closed)) {
            throw new InvalidArgumentException('setClosed(): Expecting non-empty string.');
        }
        $this->closed = $closed;
        return $this;
    }

    public function setClosedby($closedby)
    {
        if (empty($closedby) || !is_string($closedby)) {
            throw new InvalidArgumentException('setClosedby(): Expecting non-empty string.');
        }
        $this->closedby = $closedby;
        return $this;
    }

    public function setReason($reason)
    {
        if (empty($reason) || !is_string($reason)) {
            throw new InvalidArgumentException('setReason(): Expecting non-empty string.');
        }
        $this->reason = $reason;
        return $this;
    }
}
