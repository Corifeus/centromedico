<?php

namespace PrincipalBundle\Services;
 
class Helpers 
{
 
    public function generatePDF($html,$pdf)
    {

        $pdf->SetAuthor('Sistema centro médico');
        $pdf->SetTitle(('Tus visitas'));
        $pdf->SetSubject('Centros médicos de valencia');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();
        
        $filename = 'visitas';
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly

    }

}

?>