<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class add_anggaran extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_add_anggaran');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_add_anggaran() {
        $this->get_add_anggaran->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("add_anggaran/get_add_anggaran");
    }
    
    public function index() {
        
        $this->layout->loadView(
            'add_anggaran_form',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
    public function export_data(){

        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE.xlsx");
        
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->kode_project_scope_controller.'\')',
            'column_value' => array(
                'kode',
                'rekmakode',
                'rekmanama',
                'rekmagroup',
                'lvl'
            ),
            'where' => 'lvl::int <= 3'
        ));
        $all_data = $this->all;
        $currentrow = 9;
        for($i = 0; $i < sizeof($all_data); $i++){
            // echo $all_data[$i]->kode . "<br />\n";
            // $spreadsheet->getActiveSheet()->insertNewRowBefore($currentrow - 1, 1);
            $spreadsheet->getActiveSheet()
                    ->setCellValue("B" . $currentrow, $all_data[$i]->kode)
                    ->setCellValue("C" . $currentrow, $all_data[$i]->rekmakode)
                    ->setCellValue("D" . $currentrow, $all_data[$i]->rekmanama)
                    ->setCellValue("F" . $currentrow, $all_data[$i]->rekmagroup)
                    ->setCellValue("G" . $currentrow, $all_data[$i]->lvl);
            $currentrow++;
        }
        // exit();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Excel.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    public function inbox(){
        $this->layout->loadView('inbox_view');
    }
}