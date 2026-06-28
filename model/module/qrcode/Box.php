<?php
namespace MiMFa\Module\QRCode;
module("Image");
class Box extends \MiMFa\Module\Image
{
    public $AllowOrigin = true;
    public $AllowContent = false;
    public $Width = "100%";
    public $Height = "100%";
    public $Root = "https://api.qrserver.com/v1/create-qr-code/?data=";

    /**
     * Create the module
     * @param array|string|null $content The module source
     */
    public function __construct($content = null)
    {
        parent::__construct();
        $this->Content = $content;
    }

    public function GetInner()
    {
        $this->Source = $this->Convert($this->Content);
        yield from parent::GetInner();
        yield parent::GetScript();
        yield ($this->AllowContent ? $this->GetContent() : "");
    }

    public function Convert($val)
    {
        return $this->Root . urlencode(\MiMFa\Library\Convert::ToString($val));
    }
}
