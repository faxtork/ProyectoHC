<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel {

    private $excel;

    public function __construct() {
        require_once APPPATH . 'third_party/PHPExcel.php';
        require_once APPPATH . 'third_party/PHPExcel/IOFactory.php';

        $this->excel = new PHPExcel();
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save($path);
    }

 public function stream($filename, $data = null) {
       $styleArray = array(
                 'font' => array(
                    'name' => 'Arial',
                    'size' => '11',
                  ),
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                  ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                ),
            );

        if ($data != null) {

            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(strtoupper(str_replace("_", " ", $key)));
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $objPayable->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle($col.'1')->applyFromArray($styleArray);

            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(15);
            if($col=='B'){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(33);

            }
            if($col=='C'){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(22);

            }
            if($col=='E'){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(27);

            }

                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, str_replace(')','',str_replace('(','',str_replace('"','',$cell))));
                    $this->excel->getActiveSheet()->getStyle('A' . $rowNumber, $cell)->getFont()->setBold(true);
                    


            $this->excel->getActiveSheet()->getStyle($col.$rowNumber)->applyFromArray($styleArray);
                    $col++;
                }
                $rowNumber++;
            }
        }
        header('Content-type: application/ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("export/$filename");
        header("location: " . base_url() . "export/$filename");
        unlink(base_url() . "export/$filename");
}
 public function stream2($filename, $data = null) {
        $styleArray = array(
                 'font' => array(
                    'size' => '11',
                    'name' => 'Arial'
                  ),
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                  ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                ),
            );

        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(strtoupper(str_replace("_", " ", $key)));
                $this->excel->getActiveSheet()->getStyle($col . '1')->applyFromArray($styleArray);

                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);

                $objPayable->getFont()->setBold(true);

            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(15);

            if($col=='D' || $col=='F' || $col=='C'){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(33);

            }

                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    if($cell=='t') $cell="Asistio"; elseif($cell=='f') $cell="Ausente";
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, str_replace(')','',str_replace('(','',str_replace('"','',$cell))));
                    $this->excel->getActiveSheet()->getStyle('A' . $rowNumber, $cell)->getFont()->setBold(true);
                    


            $this->excel->getActiveSheet()->getStyle($col.$rowNumber)->applyFromArray($styleArray);
                    $col++;
                }
                $rowNumber++;
            }
        }
        header('Content-type: application/ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("export/$filename");
        header("location: " . base_url() . "export/$filename");
        unlink(base_url() . "export/$filename");
    }
     public function stream3($filename, $data = null) {
        $styleArray = array(
                 'font' => array(
                    'size' => '11',
                    'name' => 'Arial'
                  ),
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                  ),
                 'alignment' => array(
                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                ),
            );

        if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(strtoupper(str_replace("_", " ", $key)));
                $this->excel->getActiveSheet()->getStyle($col . '1')->applyFromArray($styleArray);

                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);

                $objPayable->getFont()->setBold(true);

            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(15);

            if($col=='D' || $col=='F' || $col=='C' || $col=='I'){
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(33);

            }

                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    if($cell=='t') $cell="Asistio"; elseif($cell=='f') $cell="Ausente";
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, str_replace(')','',str_replace('(','',str_replace('"','',$cell))));
                    $this->excel->getActiveSheet()->getStyle('A' . $rowNumber, $cell)->getFont()->setBold(true);
                    


            $this->excel->getActiveSheet()->getStyle($col.$rowNumber)->applyFromArray($styleArray);
                    $col++;
                }
                $rowNumber++;
            }
        }
        header('Content-type: application/ms-excel');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
        header("Cache-control: private");
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save("export/$filename");
        header("location: " . base_url() . "export/$filename");
        unlink(base_url() . "export/$filename");
    }
    
    public function __call($name, $arguments) {
        if (method_exists($this->excel, $name)) {
            return call_user_func_array(array($this->excel, $name), $arguments);
        }
        return null;
    }

}
