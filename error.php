<?php
class Conf
{
    private $file;
    private $xml;
    private $lastmatch;
    public function __construct($file)
    {
        $this->file = $file;
        if (!file_exists($file)) {
            throw new FileException("file '$file' does not exist");
        }
        $this->xml = simplexml_load_file($file);
        if (!is_object($this->xml)) {
            throw new XmlException(libxml_get_last_error());
        }
        print(gettype($this->xml));
        $matches = $this->xml->Xpath("/conf");
        if (!count($matches)) {
            throw new ConfException("could not find root element: conf");
        }
    }
    public function write()
    {
        if (!is_writable($this->file)) {
            throw new FileException("file '{$this->file}' is not writeable");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }
    public function get($str)
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string) $matches[0];
        }
        return null;
    }
    public function set($key, $value)
    {
        if (!is_null($this->get($key))) {
            $this->lastmatch[0] = $value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}

try {
    $conf = new Conf(dirname(__FILE__) . "/conf01.xml");
    print("user:" . $conf->get('user') . "\n");
    print("host:" . $conf->get('host') . "\n");
    $conf->set("pass", time());
    $conf->write();
} catch (FileException $e) {
    // 文件权限问题或者文件不存在
    die($e->__toString());
} catch (XmlException $e) {
    // XML文件损坏
    die($e->__toString());
} catch (ConfException $e) {
    // 错误的XML文件格式
    die($e->__toString());
} catch (Exception $e) {
    // 后备捕捉器，正常情况下不应该被调用
}

class XmlException extends Exception
{
    private $error;
    function __construct(LibXmlError $error)
    {
        $shortfile   = basename($error->file);
        $msg         = "[{$shortfile}, line{$error->line},col{$error->column}]\n{$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }
    function getLibXmlError()
    {
        return $this->error;
    }
}
class FileException extends Exception
{}
class ConfException extends Exception
{}
