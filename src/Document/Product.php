<?php
namespace App\Document;
use App\Repository\ProductRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;



/**
 * @MongoDB\Document(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @MongoDB\Id
     */
    private $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $price;

    public function getId()
    {
        return $this->id ;
    }
    public function getName()
    {
        return $this->name ;
    }
    public function setName(string $name)
    {
        return $this->name= $name ;
    }
    public function getPrice()
    {
        return $this->price ;
    }
    public function setPrice(float $price)
    {
        return $this->price= $price ;
    }

}