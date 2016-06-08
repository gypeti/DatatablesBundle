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
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'details' => false,
            'rowId' => "",
        ));

        $resolver->setAllowedTypes('details', 'bool');
        $resolver->setAllowedTypes('rowId', 'string');

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
}
