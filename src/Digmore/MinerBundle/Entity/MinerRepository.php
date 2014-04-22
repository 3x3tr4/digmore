<?php

namespace Digmore\MinerBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MinerRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM MinerBundle:Miner m ORDER BY m.name ASC')
            ->getResult();
    }
}
