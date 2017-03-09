<?php

/**
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sg\DatatablesBundle\Datatable\Column;

use Sg\DatatablesBundle\Datatable\Action\Action;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * Class ArrayColumn
 *
 * @package Sg\DatatablesBundle\Datatable\Column
 */
class TranslationColumn extends Column
{

    private $translation;
    private $field;

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return 'SgDatatablesBundle:Column:translation.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->remove('editable');
        $resolver->remove('editable_if');

        $resolver->setRequired(array('translation', 'field'));

        $resolver->setAllowedTypes('translation', 'string');
        $resolver->setAllowedTypes('field', 'string');

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'translation';
    }

    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    public function getTranslation()
    {
        return $this->translation;
    }

    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    public function getField()
    {
        return $this->field;
    }
}
