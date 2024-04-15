<?php
require "../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['htmlContent'])) {
    $htmlContent = $_POST['htmlContent'];
    // Set options
    $options = new Options();
    $options->set('isPhpEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    // $htmlContent = str_replace('<table', '<div style="page-break-before: always;"></div><table', $htmlContent);


    $dompdf->setPaper('A4', 'landscape');
    $dompdf->loadHtml($htmlContent);
    $dompdf->render();
    $watermark = 'logo.png';

    $pages = $dompdf->get_canvas()->get_page_count();

        for ($i = 1; $i <= $pages; $i++) {
            $dompdf->get_canvas()->page_script('
                $pdf->set_opacity(.3, "Multiply");
                $pdf->image("' . $watermark . '", 250, 150, 350, 300);
            ', $i);
    }

    $outputFolder = "output";
    if (!file_exists($outputFolder)) {
        mkdir($outputFolder, 0777, true);
    }

    $date = microtime(true);
    $outputFilename = $outputFolder . "/export-{$date}.pdf";
    file_put_contents($outputFilename, $dompdf->output());
    if (file_exists($outputFilename)) {
        // echo "/" . $outputFilename;
        $url = preg_replace('/estimate\/.*$/', "controller/{$outputFilename}", $_SERVER["HTTP_REFERER"]);
        echo $url;
    }

    exit;
}


if(isset($_POST["deleteFileUrl"])){
    $url = preg_replace('~.*?/controller/~', '', $_POST["deleteFileUrl"]);
    // echo $url
    unlink($url);
}