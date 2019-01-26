<?php

namespace App\Repository;

use App\Entity\Fiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Fiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fiche[]    findAll()
 * @method Fiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Fiche::class);
    }

	/**
	 * @param $agent
	 *
	 * @return mixed
	 */
	public function findFichesAgent( $agent )
	{
		return $this->createQueryBuilder('f')
			->andWhere('f.agent = :agent')
			->setParameter('agent', $agent)
			->getQuery()
			->getResult()
			;
	}

	/**
	 * @param $agent
	 *
	 * @param \DateTime|null $start
	 * @param \DateTime|null $end
	 *
	 * @return mixed
	 */
	public function findFichesFilterAgent( $agent,  ?\DateTime $start, ?\DateTime $end )
	{
		return $this->createQueryBuilder('f')
		            ->andWhere('f.agent = :agent')
			        ->andWhere('f.dateCreated BETWEEN :start AND :end ')
			        ->setParameter(':start', $start)
			        ->setParameter(':end', $end)
		            ->setParameter('agent', $agent)
		            ->getQuery()
		            ->getResult()
			;
	}

	/**
	 * @param $client
	 *
	 * @return mixed
	 */
	public function findFicheClient( $client )
	{
		return $this->createQueryBuilder('f')
			->andWhere('f.client = :client')
			->setParameter('client', $client)
			->getQuery()
			->getResult()
			;
	}

	/**
	 * @param $client
	 *
	 * @param \DateTime|null $start
	 * @param \DateTime|null $end
	 *
	 * @return mixed
	 */
	public function findFicheFilterClient( $client,  ?\DateTime $start, ?\DateTime $end )
	{
		return $this->createQueryBuilder('f')
		            ->andWhere('f.client = :client')
			        ->andWhere('f.dateCreated BETWEEN :start AND :end ')
			        ->setParameter(':start', $start)
			        ->setParameter(':end', $end)
		            ->setParameter('client', $client)
		            ->getQuery()
		            ->getResult()
			;
	}

	public function findFilterFiche( ?\DateTime $start, ?\DateTime $end )
	{
		return $this->createQueryBuilder('f')
			->andWhere('f.dateCreated BETWEEN :start AND :end ')
			->setParameter(':start', $start)
			->setParameter(':end', $end )
			->getQuery()
			->getResult()
			;
	}

	// /**
    //  * @return Fiche[] Returns an array of Fiche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fiche
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
