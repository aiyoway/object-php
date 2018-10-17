<?php
/**
 *
 */
class ShopProduct
{

    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    public function getProducer()
    {
        return "{$this->producerFirstName}" . " {$this->producerMainName}";
    }
}

$product1 = new ShopProduct('My Banana', 'Fruits', 'Yellow', 5.99);

// print("author: {$product1->getProducer()}\n");
class ShopProductWriter
{
    public function write(ShopProduct $shopProduct)
    {
        $str = "{$shopProduct->title}: " . $shopProduct->getProducer() . " ({$shopProduct->price})\n";
        print($str);
    }
}
class Wrong{}
$writer = new ShopProductWriter();
$product1 = new Wrong;
$writer->write($product1);

class AddressManager
{
    private $addresses = array(
        "192,132,34,157", "192,125,19,108");

    public function outputAddresses($resolve)
    {
        foreach ($this->addresses as $address) {
            print $address . "\n";
            if ($resolve) {
                print " {" . gethostbyaddr($address) . "}";
            }
            print "\n";
        }
    }
}
// $settings = simplexml_load_file('settings.xml');
// $manager  = new AddressManager();
// $manager->outputAddresses((string) $settings->resolvedomains);
