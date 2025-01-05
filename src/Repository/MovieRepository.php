<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @param Movie $movie
     *
     * @return void
     */
    public function create(Movie $movie)
    {
        $this->getEntityManager()->persist($movie);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $title
     * @param string $releaseDate
     *
     * @return Movie|null
     * @throws NonUniqueResultException
     */
    public function getByTitleAndReleaseDate(string $title, string $releaseDate): ?Movie
    {
        return $this->createQueryBuilder('movie')
            ->where('movie.title = :title')
            ->andWhere('movie.releaseDate = :releaseDate')
            ->setParameters([
                'title'        => $title,
                'releaseDate' => $releaseDate,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    // Find/search movies by title/synopsis
    public function findMoviesByName(string $query)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('p.title', ':query'),
                        $qb->expr()->like('p.synopsis', ':query'),
                    ),
                    $qb->expr()->isNotNull('p.releaseDate')
                )
            )
            ->setParameter('query', '%' . $query . '%')
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // /**
    //  * @return Movie[] Returns an array of Movie objects, 3 movies random from the movies table
    //  */
    /*
    public function randomMovies()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.title', 'RAND')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
