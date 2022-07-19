<?php

class process_lucky_export {
    private $json_luckyexcel;
    public function __construct($json_luckyexcel = "") {
        $this->json_luckyexcel = $json_luckyexcel;
        $this->export();
    }
    public function export(){
        if(isset($_SERVER) && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
            if($this->json_luckyexcel != ""){
                $this->export_process();
            }
        }
    }
    public function export_process(){
        ini_set("display_errors", 0);
        error_reporting(0);
        ob_start();
        require_once __DIR__.'/phpexcel/PHPExcel.php';
        $json_all = json_decode(json_encode($this->json_luckyexcel));
        $style_border_top = array(
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_border_bottom = array(
            'borders' => array(
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_border_right = array(
            'borders' => array(
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_border_left = array(
            'borders' => array(
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_align_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ) 
        ); 
        $style_align_right = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ) 
        );
        $style_vertical_middle = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ) 
        );

        $excel = new PHPExcel();
        $excel
            ->getProperties()->setCreator('Luckyexcel YKKBI')
            ->setLastModifiedBy('Luckyexcel YKKBI')
            ->setTitle("Luckyexcel YKKBI")
            ->setSubject("Luckyexcel YKKBI")
            ->setDescription("Luckyexcel YKKBI")
            ->setKeywords("Luckyexcel YKKBI");
        
        for($i = 0; $i < sizeof($json_all); $i++){
            if($i > 0){
                $excel->createSheet($i);
            }
            $newsheet = $excel->setActiveSheetIndex($i);
            $newsheet->setTitle($json_all[$i]->name);
            for($j = 0; isset($json_all[$i]->celldata) && $j < sizeof($json_all[$i]->celldata); $j++){
                if(isset($json_all[$i]->celldata[$j]->v->f)){
                    $newsheet->setCellValue(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1), $json_all[$i]->celldata[$j]->v->f);
                    if(isset($json_all[$i]->celldata[$j]->v->ct)){
                        if(isset($json_all[$i]->celldata[$j]->v->ct->fa)){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getNumberFormat()->setFormatCode($json_all[$i]->celldata[$j]->v->ct->fa);
                        }
                    }
                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_vertical_middle);
                    if(isset($json_all[$i]->celldata[$j]->v->ht)){
                        if($json_all[$i]->celldata[$j]->v->ht == 0){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_align_center);
                        }
                        if($json_all[$i]->celldata[$j]->v->ht == 2){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_align_right);
                        }
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->bl) && $json_all[$i]->celldata[$j]->v->bl){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setBold(true);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->it) && $json_all[$i]->celldata[$j]->v->it){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setItalic(true);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->fc)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->getColor()->setRGB(substr($json_all[$i]->celldata[$j]->v->fc, 1));
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->fs)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setSize($json_all[$i]->celldata[$j]->v->fs);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->ff)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray(array("font" => array("name" => $json_all[$i]->celldata[$j]->v->ff)));
                    }
                } 
                else if(isset($json_all[$i]->celldata[$j]->v->v)){
                    $newsheet->setCellValue(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1), $json_all[$i]->celldata[$j]->v->v);
                    if(isset($json_all[$i]->celldata[$j]->v->ct)){
                        if(isset($json_all[$i]->celldata[$j]->v->ct->fa)){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getNumberFormat()->setFormatCode($json_all[$i]->celldata[$j]->v->ct->fa);
                        }
                    }
                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_vertical_middle);
                    if(isset($json_all[$i]->celldata[$j]->v->ht)){
                        if($json_all[$i]->celldata[$j]->v->ht == 0){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_align_center);
                        }
                        if($json_all[$i]->celldata[$j]->v->ht == 2){
                            $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_align_right);
                        }
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->bl) && $json_all[$i]->celldata[$j]->v->bl){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setBold(true);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->it) && $json_all[$i]->celldata[$j]->v->it){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setItalic(true);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->fc)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->getColor()->setRGB(substr($json_all[$i]->celldata[$j]->v->fc, 1));
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->fs)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setSize($json_all[$i]->celldata[$j]->v->fs);
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->ff)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray(array("font" => array("name" => $json_all[$i]->celldata[$j]->v->ff)));
                    }
                }

                if(isset($json_all[$i]->celldata[$j]->v)){
                    if(isset($json_all[$i]->celldata[$j]->v->bg)){
                        $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray(array(
                            "fill" => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => substr($json_all[$i]->celldata[$j]->v->bg, 1))
                            )
                        ));
                    }
                    if(isset($json_all[$i]->celldata[$j]->v->ct->s)){
                        $value_all = "";
                        for($h = 0; $h < sizeof($json_all[$i]->celldata[$j]->v->ct->s); $h++){
                            $font_info = $json_all[$i]->celldata[$j]->v->ct->s[$h];
                            if(isset($font_info->v)){
                                $value_all = $value_all . $font_info->v;
                                $newsheet->setCellValue(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1), $value_all);
                                $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray($style_vertical_middle);
                                if(isset($font_info->bl) && $font_info->bl){
                                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setBold(true);
                                }
                                if(isset($font_info->it) && $font_info->it){
                                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setItalic(true);
                                }
                                if(isset($font_info->fc) && $font_info->fc && isset($json_all[$i]->celldata[$j]->v->fc) && $json_all[$i]->celldata[$j]->v->fc){
                                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->getColor()->setRGB(substr($json_all[$i]->celldata[$j]->v->fc, 1));
                                }
                                if(isset($font_info->fs) && $font_info->fs){
                                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->getFont()->setSize($font_info->fs);
                                }
                                if(isset($font_info->ff) && $font_info->ff){
                                    $newsheet->getStyle(convert_alphabet($json_all[$i]->celldata[$j]->c)[0] . ((int) $json_all[$i]->celldata[$j]->r + 1))->applyFromArray(array("font" => array("name" => $font_info->ff)));
                                }
                            }
                        }
                    }
                }
            }
            
            // Config
            if(isset($json_all[$i]->config)){
                if(isset($json_all[$i]->config->colhidden)){
                    $keys_colhidden = array_keys((array) $json_all[$i]->config->colhidden);
                    for($j = 0; $j < sizeof($keys_colhidden); $j++){
                        $newsheet->getColumnDimension(convert_alphabet($keys_colhidden[$j])[0])->setVisible(false);
                    }
                }
                if(isset($json_all[$i]->config->rowhidden)){
                    $keys_rowhidden = array_keys((array) $json_all[$i]->config->rowhidden);
                    for($j = 0; $j < sizeof($keys_rowhidden); $j++){
                        $newsheet->getRowDimension(($keys_rowhidden[$j] + 1))->setVisible(false);
                    }
                }
                if(isset($json_all[$i]->config->borderInfo)){
                    for($j = 0; $j < sizeof($json_all[$i]->config->borderInfo); $j++){
                        $borderInfo = $json_all[$i]->config->borderInfo[$j];
                        if(isset($borderInfo->color) && $borderInfo->color){
                            $border_style = PHPExcel_Style_Border::BORDER_THIN;
                            if($borderInfo->color == "#000"){
                                $borderInfo->color = "#000000";
                            }
                            if($borderInfo->style == "1"){
                                $border_style = PHPExcel_Style_Border::BORDER_THIN;
                            }
                            if($borderInfo->style == "3"){
                                $border_style = PHPExcel_Style_Border::BORDER_DOTTED;
                            }
                            if($borderInfo->style == "4"){
                                $border_style = PHPExcel_Style_Border::BORDER_DASHED;
                            }
                            if($borderInfo->style == "5"){
                                $border_style = PHPExcel_Style_Border::BORDER_DASHDOT;
                            }
                            if($borderInfo->style == "6"){
                                $border_style = PHPExcel_Style_Border::BORDER_DASHDOTDOT;
                            }
                            if($borderInfo->style == "8"){
                                $border_style = PHPExcel_Style_Border::BORDER_MEDIUM;
                            }
                            if($borderInfo->style == "9"){
                                $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHED;
                            }
                            if($borderInfo->style == "10"){
                                $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                            }
                            if($borderInfo->style == "11"){
                                $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                            }
                            if($borderInfo->style == "13"){
                                $border_style = PHPExcel_Style_Border::BORDER_THICK;
                            }
                            $style_border_top = array(
                                'borders' => array(
                                    'top' => array(
                                        'style' => $border_style,
                                        'color' => array('rgb' => substr($borderInfo->color, 1))
                                    )
                                )
                            );
                            $style_border_bottom = array(
                                'borders' => array(
                                    'bottom' => array(
                                        'style' => $border_style,
                                        'color' => array('rgb' => substr($borderInfo->color, 1))
                                    )
                                )
                            );
                            $style_border_right = array(
                                'borders' => array(
                                    'right' => array(
                                        'style' => $border_style,
                                        'color' => array('rgb' => substr($borderInfo->color, 1))
                                    )
                                )
                            );
                            $style_border_left = array(
                                'borders' => array(
                                    'left' => array(
                                        'style' => $border_style,
                                        'color' => array('rgb' => substr($borderInfo->color, 1))
                                    )
                                )
                            );
                        }
                        if($borderInfo->rangeType == "range"){
                            if($borderInfo->borderType == "border-all"){
                                $column_info = $borderInfo->range[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                        $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                        $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                        $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                    }
                                }
                            }
                            if($borderInfo->borderType == "border-right"){
                                $column_info = $borderInfo->range[0];
                                $column_active = $column_info->column[1];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    $newsheet->getStyle(convert_alphabet($column_active)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                }
                            }
                            if($borderInfo->borderType == "border-left"){
                                $column_info = $borderInfo->range[0];
                                $column_active = $column_info->column[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    $newsheet->getStyle(convert_alphabet($column_active)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                }
                            }
                            if($borderInfo->borderType == "border-top"){
                                $column_info = $borderInfo->range[0];
                                $row_active = $column_info->row[0];
                                for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                    $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$row_active + 1))->applyFromArray($style_border_top);
                                }
                            }
                            if($borderInfo->borderType == "border-bottom"){
                                $column_info = $borderInfo->range[0];
                                $row_active = $column_info->row[1];
                                for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                    $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$row_active + 1))->applyFromArray($style_border_bottom);
                                }
                            }
                            if($borderInfo->borderType == "border-inside"){
                                $column_info = $borderInfo->range[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        if($k == $column_info->row[0]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                            else if($h > $column_info->column[0] && $h < $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            else if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                        }
                                        else if($k > $column_info->row[0] && $k < $column_info->row[1]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                            else if($h > $column_info->column[0] && $h < $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            else if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                        }
                                        else if($k == $column_info->row[1]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                            else if($h > $column_info->column[0] && $h < $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            else if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                        }
                                    }
                                }
                            }
                            if($borderInfo->borderType == "border-outside"){
                                $column_info = $borderInfo->range[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        if($k == $column_info->row[0]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            if($h > $column_info->column[0] && $h < $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                            }
                                            if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_top);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                        }
                                        if($k > $column_info->row[0] && $k < $column_info->row[1]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                        }
                                        if($k == $column_info->row[1]){
                                            if($h == $column_info->column[0]){
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                            }
                                            if($h > $column_info->column[0] && $h < $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                            }
                                            if($h == $column_info->column[1]) {
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                                $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                            }
                                        }
                                    }
                                }
                            }
                            if($borderInfo->borderType == "border-horizontal"){
                                $column_info = $borderInfo->range[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        if($k >= $column_info->row[0] && $k < $column_info->row[1]){
                                            $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                        }
                                        if($k == $column_info->row[0] && $k == $column_info->row[1]){
                                            $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_bottom);
                                        }
                                    }
                                }
                            }
                            if($borderInfo->borderType == "border-vertical"){
                                $column_info = $borderInfo->range[0];
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        if($h >= $column_info->column[0] && $h < $column_info->column[1]){
                                            $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                        }
                                        if($h == $column_info->column[0] && $h == $column_info->column[1]){
                                            $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                        }
                                    }
                                }
                            }
                            if($borderInfo->borderType == "border-none"){
                                $column_info = $borderInfo->range[0];
                                $style_border = array(
                                    'borders' => array(
                                        'allborders' => array(
                                            'style' => PHPExcel_Style_Border::BORDER_NONE
                                        )
                                    )
                                );
                                $style_border_right = array(
                                    'borders' => array(
                                        'right' => array(
                                            'style' => PHPExcel_Style_Border::BORDER_NONE
                                        )
                                    )
                                );
                                $style_border_left = array(
                                    'borders' => array(
                                        'left' => array(
                                            'style' => PHPExcel_Style_Border::BORDER_NONE
                                        )
                                    )
                                );
                                $style_border_top = array(
                                    'borders' => array(
                                        'top' => array(
                                            'style' => PHPExcel_Style_Border::BORDER_NONE
                                        )
                                    )
                                );
                                $style_border_bottom = array(
                                    'borders' => array(
                                        'bottom' => array(
                                            'style' => PHPExcel_Style_Border::BORDER_NONE
                                        )
                                    )
                                );
                                for($k = $column_info->row[0]; $k <= $column_info->row[1]; $k++){
                                    for($h = $column_info->column[0]; $h <= $column_info->column[1]; $h++){
                                        $newsheet->getStyle(convert_alphabet($h)[0] . ((int)$k + 1))->applyFromArray($style_border);
                                        $newsheet->getStyle(convert_alphabet($h - 1)[0] . ((int)$k + 1))->applyFromArray($style_border_right);
                                        $newsheet->getStyle(convert_alphabet($h + 1)[0] . ((int)$k + 1))->applyFromArray($style_border_left);
                                        $newsheet->getStyle(convert_alphabet($h)[0] . (((int)$k + 1) - 1))->applyFromArray($style_border_bottom);
                                        $newsheet->getStyle(convert_alphabet($h)[0] . (((int)$k + 1) + 1))->applyFromArray($style_border_top);
                                    }
                                }
                            }
                        }
                        if($borderInfo->rangeType == "cell"){
                            if(is_object($borderInfo->value)){
                                if(isset($borderInfo->value->t)){
                                    $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    if($borderInfo->value->t->color == "#000"){
                                        $borderInfo->value->t->color = "#000000";
                                    }
                                    if($borderInfo->value->t->style == "1"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    }
                                    if($borderInfo->value->t->style == "3"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DOTTED;
                                    }
                                    if($borderInfo->value->t->style == "4"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHED;
                                    }
                                    if($borderInfo->value->t->style == "5"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOT;
                                    }
                                    if($borderInfo->value->t->style == "6"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOTDOT;
                                    }
                                    if($borderInfo->value->t->style == "8"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUM;
                                    }
                                    if($borderInfo->value->t->style == "9"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHED;
                                    }
                                    if($borderInfo->value->t->style == "10"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                                    }
                                    if($borderInfo->value->t->style == "11"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                                    }
                                    if($borderInfo->value->t->style == "13"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THICK;
                                    }
                                    $style_border_top = array(
                                        'borders' => array(
                                            'top' => array(
                                                'style' => $border_style,
                                                'color' => array('rgb' => substr($borderInfo->value->t->color, 1))
                                            )
                                        )
                                    );
                                    $newsheet->getStyle(convert_alphabet($borderInfo->value->col_index)[0] . ((int)$borderInfo->value->row_index + 1))->applyFromArray($style_border_top);
                                }
                                if(isset($borderInfo->value->b)){
                                    $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    if($borderInfo->value->b->color == "#000"){
                                        $borderInfo->value->b->color = "#000000";
                                    }
                                    if($borderInfo->value->b->style == "1"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    }
                                    if($borderInfo->value->b->style == "3"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DOTTED;
                                    }
                                    if($borderInfo->value->b->style == "4"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHED;
                                    }
                                    if($borderInfo->value->b->style == "5"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOT;
                                    }
                                    if($borderInfo->value->b->style == "6"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOTDOT;
                                    }
                                    if($borderInfo->value->b->style == "8"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUM;
                                    }
                                    if($borderInfo->value->b->style == "9"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHED;
                                    }
                                    if($borderInfo->value->b->style == "10"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                                    }
                                    if($borderInfo->value->b->style == "11"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                                    }
                                    if($borderInfo->value->b->style == "13"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THICK;
                                    }
                                    $style_border_bottom = array(
                                        'borders' => array(
                                            'bottom' => array(
                                                'style' => $border_style,
                                                'color' => array('rgb' => substr($borderInfo->value->b->color, 1))
                                            )
                                        )
                                    );
                                    $newsheet->getStyle(convert_alphabet($borderInfo->value->col_index)[0] . ((int)$borderInfo->value->row_index + 1))->applyFromArray($style_border_bottom);
                                }
                                if(isset($borderInfo->value->r)){
                                    $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    if($borderInfo->value->r->color == "#000"){
                                        $borderInfo->value->r->color = "#000000";
                                    }
                                    if($borderInfo->value->r->style == "1"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    }
                                    if($borderInfo->value->r->style == "3"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DOTTED;
                                    }
                                    if($borderInfo->value->r->style == "4"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHED;
                                    }
                                    if($borderInfo->value->r->style == "5"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOT;
                                    }
                                    if($borderInfo->value->r->style == "6"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOTDOT;
                                    }
                                    if($borderInfo->value->r->style == "8"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUM;
                                    }
                                    if($borderInfo->value->r->style == "9"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHED;
                                    }
                                    if($borderInfo->value->r->style == "10"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                                    }
                                    if($borderInfo->value->r->style == "11"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                                    }
                                    if($borderInfo->value->r->style == "13"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THICK;
                                    }
                                    $style_border_right = array(
                                        'borders' => array(
                                            'right' => array(
                                                'style' => $border_style,
                                                'color' => array('rgb' => substr($borderInfo->value->r->color, 1))
                                            )
                                        )
                                    );
                                    $newsheet->getStyle(convert_alphabet($borderInfo->value->col_index)[0] . ((int)$borderInfo->value->row_index + 1))->applyFromArray($style_border_right);
                                }
                                if(isset($borderInfo->value->l)){
                                    $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    if($borderInfo->value->l->color == "#000"){
                                        $borderInfo->value->l->color = "#000000";
                                    }
                                    if($borderInfo->value->l->style == "1"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THIN;
                                    }
                                    if($borderInfo->value->l->style == "3"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DOTTED;
                                    }
                                    if($borderInfo->value->l->style == "4"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHED;
                                    }
                                    if($borderInfo->value->l->style == "5"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOT;
                                    }
                                    if($borderInfo->value->l->style == "6"){
                                        $border_style = PHPExcel_Style_Border::BORDER_DASHDOTDOT;
                                    }
                                    if($borderInfo->value->l->style == "8"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUM;
                                    }
                                    if($borderInfo->value->l->style == "9"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHED;
                                    }
                                    if($borderInfo->value->l->style == "10"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT;
                                    }
                                    if($borderInfo->value->l->style == "11"){
                                        $border_style = PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT;
                                    }
                                    if($borderInfo->value->l->style == "13"){
                                        $border_style = PHPExcel_Style_Border::BORDER_THICK;
                                    }
                                    $style_border_left = array(
                                        'borders' => array(
                                            'left' => array(
                                                'style' => $border_style,
                                                'color' => array('rgb' => substr($borderInfo->value->l->color, 1))
                                            )
                                        )
                                    );
                                    $newsheet->getStyle(convert_alphabet($borderInfo->value->col_index)[0] . ((int)$borderInfo->value->row_index + 1))->applyFromArray($style_border_left);
                                }
                            }
                        }
                    }
                }
                if(isset($json_all[$i]->config->merge)){
                    $array_merge = (array) $json_all[$i]->config->merge;
                    $array_merge_keys = array_keys($array_merge);
                    for($j = 0; $j < sizeof($array_merge_keys); $j++){
                        $merge_info = $array_merge[$array_merge_keys[$j]];
                        $newsheet->mergeCells(convert_alphabet($merge_info->c)[0].($merge_info->r + 1).":".convert_alphabet(($merge_info->c + ($merge_info->cs - 1)))[0].(($merge_info->r + 1) + ($merge_info->rs - 1)));
                    }
                }
                if(isset($json_all[$i]->config->columnlen)){
                    $columnlen_info = (array) $json_all[$i]->config->columnlen;
                    $columnlen_info_keys = array_keys($columnlen_info);
                    for($j = 0; $j < sizeof($columnlen_info_keys); $j++){
                        $newsheet->getColumnDimension(convert_alphabet($columnlen_info_keys[$j])[0])->setWidth(ceil($columnlen_info[$columnlen_info_keys[$j]] / 8));
                    }
                }
                if(isset($json_all[$i]->config->rowlen)){
                    $rowlen_info = (array) $json_all[$i]->config->rowlen;
                    $rowlen_info_keys = array_keys($rowlen_info);
                    for($j = 0; $j < sizeof($rowlen_info_keys); $j++){
                        $newsheet->getRowDimension(($rowlen_info_keys[$j] + 1))->setRowHeight(ceil($rowlen_info[$rowlen_info_keys[$j]] / 1.5));
                    }
                }
            }
            if(isset($json_all[$i]->frozen)){
                $frozenInfo = $json_all[$i]->frozen;
                if($frozenInfo->type == "rangeColumn"){
                    $newsheet->freezePane(convert_alphabet(($frozenInfo->range->column_focus + 1))[0].'1');
                }
                if($frozenInfo->type == "rangeRow"){
                    $newsheet->freezePane('A'.($frozenInfo->range->row_focus + 2));
                }
                if($frozenInfo->type == "rangeBoth"){
                    $newsheet->freezePane(convert_alphabet(($frozenInfo->range->column_focus + 1))[0].($frozenInfo->range->row_focus + 2));
                }
                if($frozenInfo->type == "both"){
                    $newsheet->freezePane('B2');
                }
            }
            if(isset($json_all[$i]->showGridLines) && !$json_all[$i]->showGridLines){
                if($json_all[$i]->showGridLines == 0){
                    $newsheet->setShowGridlines(false);
                }
            }
            if(isset($json_all[$i]->images)){
                $images_keys = array_keys((array) $json_all[$i]->images);
                for($j = 0; $j < sizeof($images_keys); $j++){
                    $images_info = $json_all[$i]->images->{$images_keys[$j]};
                    $width_crop = $images_info->crop->width;
                    $height_crop = $images_info->crop->height;
                    $pos_x_default = $images_info->default->left;
                    $pos_y_default = $images_info->default->top;
                    $base64_info = $images_info->src;
                    $explode_type_1 = explode("data:image/", $base64_info);
                    $explode_type_2 = explode(";", $explode_type_1[1]);
                    $type_image = $explode_type_2[0];
                    $explode_encode_only = explode(",", $base64_info);
                    $encode_string = $explode_encode_only[1];
                    $picture_decode = base64_decode($encode_string);
                    $name_file = strtoupper(bin2hex(openssl_random_pseudo_bytes(8))) . date("YmdHis") . "." . $type_image;
                    file_put_contents(__DIR__."/temporary/temporary_images/" . $name_file, $picture_decode);

                    $plus_column_width = 0;
                    $actual_x = 0;
                    $temp_plus = 0;
                    $coordinate_column = "A";
                    for($k = 0; $k < 1000; $k++){
                        if(isset($json_all[$i]->config->colhidden) && ((is_object($json_all[$i]->config->colhidden) && isset($json_all[$i]->config->colhidden->{$k})) || (is_array($json_all[$i]->config->colhidden) && isset($json_all[$i]->config->colhidden[$k])))){
                            $plus_column_width = $plus_column_width + 0;
                            $temp_plus = 0;
                        } else {
                            if((is_object($json_all[$i]->config->columnlen) && isset($json_all[$i]->config->columnlen->{$k})) || (is_array($json_all[$i]->config->columnlen) && isset($json_all[$i]->config->columnlen[$k]))){
                                if(is_array($json_all[$i]->config->columnlen)){
                                    $plus_column_width = $plus_column_width + $json_all[$i]->config->columnlen[$k];
                                    $temp_plus = $json_all[$i]->config->columnlen[$k];
                                }
                                if(is_object($json_all[$i]->config->columnlen)){
                                    $plus_column_width = $plus_column_width + $json_all[$i]->config->columnlen->{$k};
                                    $temp_plus = $json_all[$i]->config->columnlen->{$k};
                                }
                            } else {
                                $plus_column_width = $plus_column_width + 74;
                                $temp_plus = 74;
                            }
                        }
                        if($pos_x_default < $plus_column_width){
                            $actual_x = $pos_x_default - ($plus_column_width - $temp_plus);
                            $coordinate_column = convert_alphabet($k)[0];
                            break;
                        }
                    }

                    $plus_column_height = 0;
                    $actual_y = 0;
                    $temp_plus_y = 0;
                    $coordinate_row = 1;
                    for($k = 0; $k < 1000; $k++){
                        if(isset($json_all[$i]->config->rowhidden) && ((is_object($json_all[$i]->config->rowhidden) && isset($json_all[$i]->config->rowhidden->{$k})) || (is_array($json_all[$i]->config->rowhidden) && isset($json_all[$i]->config->rowhidden[$k])))){
                            $plus_column_height = $plus_column_height + 0;
                            $temp_plus_y = 4;
                        } else {
                            if((is_object($json_all[$i]->config->rowlen) && isset($json_all[$i]->config->rowlen->{$k})) || (is_array($json_all[$i]->config->rowlen) && isset($json_all[$i]->config->rowlen[$k]))){
                                if(is_array($json_all[$i]->config->rowlen)){
                                    $plus_column_height = $plus_column_height + $json_all[$i]->config->rowlen[$k];
                                    $temp_plus_y = $json_all[$i]->config->rowlen[$k];
                                }
                                if(is_object($json_all[$i]->config->rowlen)){
                                    $plus_column_height = $plus_column_height + $json_all[$i]->config->rowlen->{$k};
                                    $temp_plus_y = $json_all[$i]->config->rowlen->{$k};
                                }
                            } else {
                                $plus_column_height = $plus_column_height + 20;
                                $temp_plus_y = 20;

                            }
                        }
                        if($pos_y_default < $plus_column_height){
                            $actual_y = $pos_y_default - ($plus_column_height - $temp_plus_y);
                            $coordinate_row = ($k + 1);
                            break;
                        }
                    }

                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setWorksheet($newsheet);
                    $objDrawing->setCoordinates($coordinate_column . $coordinate_row);
                    $objDrawing->setName('Picture');
                    $objDrawing->setDescription('Picture');
                    $logo = __DIR__."/temporary/temporary_images/" . $name_file;
                    $objDrawing->setPath($logo);
                    $objDrawing->setOffsetX($actual_x); 
                    $objDrawing->setOffsetY($actual_y);
                    $objDrawing->setHeight($height_crop);
                    $objDrawing->setWidth($width_crop);
                }
            }
            $excel->addNamedRange(
                new PHPExcel_NamedRange('PersonFN' . $i, $excel->getActiveSheet($i), 'B1') 
            );
        }
        $excel->setActiveSheetIndex(0);
        ob_start();
        $excel_name = "YKKBI-LUCKYSHEET".date("YmdHis").round(microtime(true) * 1000).".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$excel_name.'"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        $excel_content = ob_get_clean();
        file_put_contents(__DIR__."/phpexcel/phpexcel-output/" . $excel_name, $excel_content);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array("file_name" => "../../../application/libraries/phpexcel/phpexcel-output/".$excel_name));
    }
}