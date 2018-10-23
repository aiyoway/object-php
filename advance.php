<?php
class StaticExample
{
    public static $aNum = 0;
    public static function sayHello()
    {
        self::$aNum++;
        print("hello (" . self::$aNum . " )\n");
    }
}

// print(StaticExample::$aNum);
// StaticExample::sayHello();

interface Chargeable
{
    public function getPrice();
}

class ShopProduct implements Chargeable
{
    private $id = 0;
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

    public function cdInfo(CdProduct $prod){
        // ...
    }

    public function addProduct(ShopProduct $prod){
        // ..
    }

    public function addChargeableItem(Chargeable $item){
        // ..
    }

    public static function getInstance($id, PDO $pdo)
    {
        $stmt   = $pdo->prepare("select * from products where id=?");
        $result = $stmt->execute(array($id));
        $row    = $stmt->fetch();
        if (empty($row)) {
            return null;
        }
        if ($row['type'] == 'book') {
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price'],
                $row['num_pages']
            );
        } elseif ($row['type'] == 'cd') {
            $product = new CdProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price'],
                $row['playLength']
            );
        } else {
            $product = new ShopProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                $row['price']
            );
        }
        $product->setId($row['id']);
        $product->setDiscount($row['discount']);
        return $product;
    }
    public function setId($id)
    {
        $this->id = $id;
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
    public function getTitle()
    {
        return $this->title;
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
}

$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
$obj = ShopProduct::getInstance(1, $pdo);
echo $obj->getSummaryLine();
