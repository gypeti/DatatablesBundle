<?php
namespace Sg\DatatablesBundle\Datatable\View;

use Symfony\Component\OptionsResolver\OptionsResolver;

class MyOptions extends Options
{

    /**
     *
     * @var boolean
     */
    protected $details;

    /**
     *
     * @var string
     */
    protected $rowId;

    /**
     *
     * @var int
     */
    protected $startId;

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'details' => false,
            'rowId' => "",
            'startId' => 0,
        ));

        $resolver->setAllowedTypes('details', 'bool');
        $resolver->setAllowedTypes('rowId', 'string');
        $resolver->setAllowedTypes('startId', 'int');

        return parent::configureOptions($resolver);
    }

    /**
     * Set Details.
     *
     * @param boolean $details
     *
     * @return $this
     */
    protected function setDetails($details)
    {
        $this->details = (boolean) $details;

        return $this;
    }

    /**
     * Get Details.
     *
     * @return boolean
     */
    public function getDetails()
    {
        return (boolean) $this->details;
    }

    /**
     * Get RowId.
     *
     * @return string
     */
    public function getRowId()
    {
        return (string) $this->rowId;
    }

    /**
     * Set RowId.
     *
     * @param string $rowId
     *
     * @return $this
     */
    protected function setRowId($rowId)
    {
        $this->rowId = (string) $rowId;

        return $this;
    }

    /**
     * Get StartId.
     *
     * @return int
     */
    public function getStartId()
    {
        return (int) $this->startId;
    }

    /**
     * Set StartId.
     *
     * @param int $rowId
     *
     * @return $this
     */
    protected function setStartId($startId)
    {
        $this->startId = (int) $startId;

        return $this;
    }
}
