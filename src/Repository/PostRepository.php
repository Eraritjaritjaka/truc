<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository {

    public function getSearchText($txt) {
    	$req = $this->createQueryBuilder('p');
    	$req->where('p.message LIKE :bidule')
    	   ->orwhere('p.subject LIKE :bidule')
    	   ->setParameter('bidule', '%' . $txt . '%');
    	return $req->getQuery()->getResult();
    }

}