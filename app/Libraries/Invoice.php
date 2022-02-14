<?php
namespace App\Libraries;
use TCPDF;

class Invoice extends TCPDF
{
    public function Header()
	{
		$pageMargins = $this->getMargins();
        
		$image_file = 'images/brand-logo.png';
		$this->header_logo = $image_file;
        $this->Image($image_file,$this->getX() ,$this->getY(), 20,20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$this->SetFont('helvetica', 'B', 16);
		$this->SetTextColor(79,66,181);
		$this->Text($this->getX(), $this->getY(), 'NODELABYR', false, false, true, 0, 1 ,'C', false,'https://nodelabyr.my.id',0,false,'T','M',false);
		
		$this->SetFont('helvetica','B',14);
		$this->SetTextColor(0,255,255);;
		$this->Text($this->getX(),$this->getY(),'SECURE AND STABLE',false,false,true,0,1,'C',false,'',0,false,'T','M',false);
		
		$style =  array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$this->Line($this->getX(), $pageMargins['top']+10, $this->getPageWidth()-$pageMargins['right'],$pageMargins['top']+10, $style);
	}

    public function Footer() 
	{
		
		$this->setAbsY(-5);
		// dd($this->getFooterMargin());
    	$this->SetFont('helvetica', 'B', 8);
		$this->SetTextColor(0,0,0);
		$this->Text($this->GetX(), $this->GetY(), 'Copyright © 2021 | Nodelabyr', false, false, true, 0, 1, 'L', false,'https://nodelabyr.my.id',0,false,'B','M',false);
    }
}