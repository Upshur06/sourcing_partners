<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Users>
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function save(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Users[] Returns an array of Users objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function userData(){
    try{
        $sql = "SELECT `username`, `email_address`, `password`, `confirm_password` FROM `users`";
        
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        
        $query = $stmt->executeQuery();
        
        $result = $query->fetchAllAssociative();
        
        return $result;
    }
    catch(Exception $e){
        echo $e;
    }
}


public function insertUserData($name, $email, $password, $confirm){
    try{
        $sql = "INSERT INTO `users` (`username`, `email_address`, `password`, `confirm_password`) VALUES (?,?,?,?)";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
    
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $password);
        $stmt->bindValue(4, $confirm);
    
        $query = $stmt->executeQuery();
    
        // $result = $query->fetchAllAssociative();
    
        return true;
    }
    catch(Exception $e){
        echo $e;
    }
}

public function createdUser(){
    try{
        $sql = "SELECT `username` FROM `users` ORDER BY ID DESC LIMIT 1";
    
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
            
        $query = $stmt->executeQuery();
    
        $result = $query->fetchAssociative();
    
        return $result;
    }
    catch(Exception $e){
        echo $e;
    }
}

public function logIn(){
    try{
        $sql = "SELECT `username`, `password` FROM `users`";
    
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
    
        $query = $stmt->executeQuery();
    
        $result = $query->fetchAllAssociative();
    
        return $result;
    }
    catch(Exception $e){
        echo $e;
    }
}

}
