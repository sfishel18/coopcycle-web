<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function findUnassignedByDate(\DateTime $date)
    {
        $start = clone $date;
        $end = clone $date;

        return $this->findByDateRangeQuery($this->createQueryBuilder('t'), $start, $end)
            ->andWhere(sprintf('t.%s IS NULL', 'assignedTo'))
            ->getQuery()
            ->getResult();
    }

    public function findByDate(\DateTime $date)
    {
        $start = clone $date;
        $end = clone $date;

        return $this->findByDateRange($start, $end);
    }

    public function findByDateRange(\DateTime $start, \DateTime $end)
    {
        // @see https://github.com/martin-georgiev/postgresql-for-doctrine
        // @see https://www.postgresql.org/docs/9.4/rangetypes.html
        // @see https://www.postgresql.org/docs/9.4/functions-range.html

        return $this->findByDateRangeQuery($this->createQueryBuilder('t'), $start, $end)
            ->getQuery()
            ->getResult();
    }

    private function findByDateRangeQuery($builder, \DateTime $start, \DateTime $end)
    {
        return $builder
            ->andWhere('OVERLAPS(TSRANGE(t.doneAfter, t.doneBefore), CAST(:range AS tsrange)) = TRUE')
            ->setParameter('range', sprintf('[%s, %s]', $start->format('Y-m-d 00:00:00'), $end->format('Y-m-d 23:59:59')));
    }
}
