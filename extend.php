<?php

class ShopProduct
{
    private $title;
    private $produncerMainName;
    private $produncerFirstName;
    protected $price;
    private $discount = 0;

    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title              = $title;
        $this->produncerFirstName = $firstName;
        $this->produncerMainName  = $mainName;
        $this->price              = $price;
    }

    public function getProducerFirstName()
    {
        return $this->produncerFirstName;
    }

    public function getProducerMainName()
    {
        return $this->produncerMainName;
    }

    public function setDiscount($num)
    {
        $this->discount = $num;
    }

    public function getDiscount($num)
    {
        return $this->discount;
    }

    public function getPrice()
    {
        return ($this->price - $this->discount);
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ( {$this->produncerMainName}, ";
        $base .= "{$this->produncerFirstName} )";
        return $base;
    }

    public function getProducer()
    {
        return "{$this->produncerFirstName}" . " {$this->produncerMainName}";
    }
}

class CdProduct extends ShopProduct
{
    private $playLength;

    public function __construct($title, $firstName, $mainName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }
    public function getPlayLenth()
    {
        return $this->playLength;
    }
    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": playing time - {$this->playLength}";
        return $base;
    }
}

class BookProduct extends ShopProduct
{
    public $numPages;
    // public $title;
    // public $produncerMainName;
    // public $produncerFirstName;
    // public $price;

    public function __construct($title, $firstName, $mainName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }
    public function getNumberOfPages()
    {
        return $this->numPages;
    }
    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": page count - {$this->numPages} \n";
        return $base;
    }
    public function getPrice()
    {
        return $this->price;
    }
    // public function getProducer()
    // {
    //     return "{$this->produncerFirstName}" . " {$this->produncerMainName}";
    // }
}

class ShopProductWriter
{
    private $products = array();
    public function addProduct(ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }
    public function write()
    {
        $str = '';
        foreach ($this->products as $shopProduct) {
            $str .= "{$shopProduct->title}: ";
            $str .= $shopProduct->getProducer();
            $str .= " ({$shopProduct->getPrice()})\n";
        }
        print($str);
    }
}

$book1 = new BookProduct('php入门', '编程', '计算机', '29.99', '299');
print("artist: {$book1->getSummaryLine()}");
