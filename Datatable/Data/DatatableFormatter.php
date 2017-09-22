<?php

/**
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sg\DatatablesBundle\Datatable\Data;

/**
 * Class DatatableFormatter
 *
 * @package Sg\DatatablesBundle\Datatable\Data
 */
class DatatableFormatter
{
    /**
     * @var DatatableQuery
     */
    private $datatableQuery;

    /**
     * @var array
     */
    private $output;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    public function __construct(DatatableQuery $datatableQuery)
    {
        $this->datatableQuery = $datatableQuery;
        $this->output = array('data' => array());
    }

    //-------------------------------------------------
    // Formatter
    //-------------------------------------------------

    public function runFormatter()
    {
        $columns = $this->datatableQuery->getColumns();
        $paginator = $this->datatableQuery->getPaginator();
        $lineFormatter = $this->datatableQuery->getLineFormatter();

        foreach ($paginator as $row) {
            // 0. escape html
            self::htmlEscapeArrayRecursively($row); //TODO make this optional for every column

            // 1. Call the the lineFormatter to format row items
            if (is_callable($lineFormatter)) {
                $row = call_user_func($lineFormatter, $row);
            }

            foreach ($columns as $column) {
                // 2. Add some special data to the output array. For example, the visibility of actions.
                $column->addDataToOutputArray($row);
                // 3. Call columns renderContent method to format row items (e.g. for images)
                $column->renderContent($row, $this->datatableQuery);
            }

            $this->output['data'][] = $row;
        }
    }

    //-------------------------------------------------
    // Helper
    //-------------------------------------------------

    /**
     * Runs the built-in HTML escaping function for every string in the multi-dimensional array recursively.
     * @see htmlspecialchars
     * @param array $array
     */
    public static function htmlEscapeArrayRecursively(array &$array) {
        foreach ($array as $k => $v) {
            if (is_string($v)) {
                $array[$k] = htmlspecialchars($v);
            } elseif (is_array($v)) {
                self::htmlEscapeArrayRecursively($array[$k]);
            }
        }
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Get output.
     *
     * @return array
     */
    public function getOutput()
    {
        return $this->output;
    }
}
