<?php

namespace Sg\DatatablesBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sg\DatatablesBundle\Datatable\Data\DatatableQuery;
use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditableController
 *
 * @package Sg\DatatablesBundle\Controller
 * @Route("/sg/datatables")
 */
class IndexController extends Controller
{
    /**
     * @param Request $request
     * @param string $datatable_name
     *
     * @Route("/list/results/{datatable_name}", name="sg_datatables_list_results")
     * @Method({"GET", "POST"})
     */
    public function indexResultsAction(Request $request, $datatable_name)
    {
        /* @var $datatable AbstractDatatableView */
        $datatable = $this->get('app.datatable.' . $datatable_name);
        $datatable->buildDatatable();

        /* @var $query DatatableQuery */
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }


    /**
     *
     * @param Request $request
     * @param string $datatable_name
     * @param int $id
     *
     * @Route("/list/get_page_number/{datatable_name}/{id}", name="sg_datatables_get_page_number", options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function getPageNumberAction(Request $request, $datatable_name, $id)
    {
        $connection = $this->getDoctrine()->getManager()->getConnection();
        if ($connection->getDatabasePlatform()->getName() !== 'mysql') {
            throw new \Exception('getPageNumberAction() is only implemented for MySQL DBMS');
        }
        /* @var $datatable AbstractDatatableView */
        $datatable = $this->get('app.datatable.' . $datatable_name);
        $datatable->buildDatatable();

        /* @var $query DatatableQuery */
        $originalDtQuery = $this->get('sg_datatables.query')->getQueryFrom($datatable);
        $originalDtQuery->buildQuery();
        /* @var $qb QueryBuilder */
        $qb = $originalDtQuery->getQuery();
        $qb->setMaxResults(null)->setFirstResult(0);

        $query = $qb->getQuery();
        $sql = $query->getSQL();

        $fromPos = strpos($sql, 'FROM');
        $wherePos = strpos($sql, 'WHERE');
        $limitPos = strpos($sql, 'LIMIT');

        $afterSelect = substr($sql, $fromPos, $limitPos - $fromPos);
        if (!preg_match('~^(\w+) ?(\w*) ?(.*)$~', substr($sql, $fromPos + 5, $wherePos - 5), $matches)) {
            throw new Exception('No match');
        }
        $alias = $matches[2];

        $newSql = "SELECT $alias.id, @rownum := @rownum + 1 AS position $afterSelect";
        $outerSql = "SELECT * FROM ($newSql) innerSelect WHERE innerSelect.id = ?;";
        $connection->exec('SET @rownum := -1;');
        try {
            $result = $connection->executeQuery($outerSql, [$id])->fetch();
        } catch(\Doctrine\DBAL\Exception\DriverException $e) {
            if ($e->getSQLState() === 'HY093') {
                throw new \Exception('Inner datatable queries with parameters (like search strings) is not implemented', null, $e);
            } else {
                throw $e;
            }
        }

        return new JsonResponse(
            [
                'id' => $id,
                'position' => $result['position'],
            ]
        );
    }
}
