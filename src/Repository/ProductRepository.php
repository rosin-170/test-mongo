<?php
namespace App\Repository;

use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;

class ProductRepository  extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        $uow = $dm->getUnitOfWork();
        $classMetaData = $dm->getClassMetadata(Product::class);
        parent::__construct($dm, $uow, $classMetaData);
    }
        
    public function findAllOrderedByName()
    {
        return $this->createQueryBuilder()
            ->sort('name', 'ASC')
            ->getQuery()
            ->execute();
    }
    public function native()
    {
       $documentManager = $this->container->get('doctrine_mongodb')->getManager();
       $mongoClient = $documentManager->getConnection()->getMongoClient();
       $db = $mongoClient->selectDB('symfony');
       $collection = $mongoClient->selectCollection($db,'Product');
       $collection->find();
       return 1;
    }
    public function natives()
    {
    //  $test =    $this->getDManager('doctrine_mongodb');
    // $db = $test->selectDB('symfony');
    // $col = $test->selectCollection($db,'Product');
    // $col->find();
    $connection = $this->getDocumentManager();
       return $connection;
    }
}