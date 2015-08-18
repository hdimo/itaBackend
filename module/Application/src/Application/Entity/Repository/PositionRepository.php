<?php
/**
 * User: khaled
 * Date: 8/17/15 at 10:01 AM
 */

namespace Application\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class PositionRepository extends EntityRepository
{

    protected $conditions;

    //protected $timeToExpire = 3600;

    /**
     * @param array $conditions
     * @param null $offset
     * @param null $limit
     * @return array
     */
    public function getLastPosition($conditions = array(), $offset = null, $limit = null)
    {
        $this->conditions = $conditions;
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('p')
            ->from('\Application\Entity\Position', 'p');
        $this->filter($qb);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param QueryBuilder $qb
     * @return QueryBuilder
     */
    protected function filter(QueryBuilder &$qb)
    {

        if (isset($this->conditions['timeToExpire'])) {
            $currentTimeStamp = time();
            $timeToExpire = $this->conditions['timeToExpire'];
            $qb->where("{$currentTimeStamp} - p.created_date <= {$timeToExpire}");
            unset($this->conditions['timeToExpire']);
        }

        //apply other filter (where field = value)
        if (is_array($this->conditions) && count($this->conditions) > 0) {
            foreach ($this->conditions as $key => $value) {
                if ($value) {
                    $v = is_int($value) ? (int)$value : "'{$value}'";
                    $qb->andWhere("p.{$key} = {$v}");
                }
            }
        }
        return $qb;
    }

}