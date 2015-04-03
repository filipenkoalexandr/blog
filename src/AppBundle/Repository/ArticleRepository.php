<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function getAdminArticles()
    {

        $query = $this->createQueryBuilder('a')
            ->where('a.author = :author')
            ->setParameter('author', 'admin')
            ->orderBy('a.author', 'ASC')
            ->getQuery();

        $articles = $query->getResult();
        return $articles;
    }

    public  function getFullArticle($id)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id' , $id)
            ->getQuery();

        $article = $query->getResult();
        return $article;

    }
}