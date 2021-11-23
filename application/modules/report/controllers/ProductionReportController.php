<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class ProductionReportController extends CI_Controller
{

  public function __construct() {
    parent::__construct();
    $this->load->library('excel');
    $this->load->library('pdf');
    $this->load->model('ProductionReportModel', 'prm');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function ajaxdata($value='')
  {
    $star = explode('-',$this->input->post('str_date'));
    $endd = explode('-',$this->input->post('end_date'));
    $betwen = array(
      'mulai' => $this->input->post('str_date') == '' ? '' : $star[2].'-'.$star[1].'-'.$star[0].' 00:00:00',
      'smpai' => $this->input->post('end_date') == '' ? '' : $endd[2].'-'.$endd[1].'-'.$endd[0].' 00:00:00'
    );
    $data = '';
    $no   = $this->input->post('start');

    if ($this->input->post('was_data_search') == "no") {
      $data = $this->prm->get_report_production();
    } else {
      $data = $this->prm->get_report_production($betwen);
    }

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();
      $no++;
      $dte = explode('-',explode(' ',$key['add_time'])[0]);
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['sob'];
      $tbody[] = $key['cob'];
      $tbody[] = $key['type_cob'];
      $tbody[] = $key['lob'];
      $tbody[] = $key['nama_nasabah'];
      $tbody[] = number_format($key['total_sum_insured']);
      $tbody[] = number_format($key['total_premi_standar']);
      $tbody[] = number_format($key['total_premi_perluasan']);
      $tbody[] = $key['diskon'].'%';
      $tbody[] = number_format($key['total_akhir_premi']);
      $tbody[] = $dte[2].'-'.$dte[1].'-'.$dte[0];
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->prm->countallprodukreport($betwen),
      "recordsFiltered" => $this->prm->countfilterprodukreport($betwen),
      "data"            => $datax
    ];

    echo json_encode($output);
  }

  public function to_excel($value='')
  {
    $expl = explode('_', $value);
    $star = explode('-',$expl[0]);
    $endd = explode('-',$expl[1]);

    $betwen = array(
      'mulai' => $expl[0] == '' ? '' : $star[2].'-'.$star[1].'-'.$star[0].' 00:00:00',
      'smpai' => $expl[1] == '' ? '' : $endd[2].'-'.$endd[1].'-'.$endd[0].' 00:00:00'
    );
    $output_data = $this->prm->get_report_production($betwen);

    $object = new PHPExcel();
    $object->setActiveSheetIndex(0);
    $object->getActiveSheet()->getSheetView()->setZoomScale(50);
    $table_columns = array("No", "SOB", "COB", "Type COB", "LOB", "Insured Name", "Total Sum Insured",
                           "Total Premi Standar", "Total Premi Perluasan", "Diskon",
                           "Total Akhir Premi", "Create Time");
    $textCenter = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
    $stabborder = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
    $bgColor = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '81d41a')));

    $object->getActiveSheet()->mergeCells('A1:L1');
		$object->getActiveSheet()->getStyle('A1:L1')->applyFromArray($textCenter);
    $object->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(30);
		$object->getActiveSheet()->SetCellValue('A1', 'PRODUCTION REPORT');
    $object->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
    $object->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
    $object->getActiveSheet()->mergeCells('A2:L2');

    $object->getActiveSheet()->SetCellValue('A3', $table_columns[0 ])->getColumnDimension('A')->setWidth(5);
    $object->getActiveSheet()->getStyle('A3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('B3', $table_columns[1 ])->getColumnDimension('B')->setWidth(25);
    $object->getActiveSheet()->getStyle('B3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('C3', $table_columns[2 ])->getColumnDimension('C')->setWidth(25);
    $object->getActiveSheet()->getStyle('C3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('D3', $table_columns[3 ])->getColumnDimension('D')->setWidth(25);
    $object->getActiveSheet()->getStyle('D3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('E3', $table_columns[4 ])->getColumnDimension('E')->setWidth(25);
    $object->getActiveSheet()->getStyle('E3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('F3', $table_columns[5 ])->getColumnDimension('F')->setWidth(30);
    $object->getActiveSheet()->getStyle('F3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('G3', $table_columns[6 ])->getColumnDimension('G')->setWidth(30);
    $object->getActiveSheet()->getStyle('G3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('H3', $table_columns[7 ])->getColumnDimension('H')->setWidth(30);
    $object->getActiveSheet()->getStyle('H3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('I3', $table_columns[8 ])->getColumnDimension('I')->setWidth(30);
    $object->getActiveSheet()->getStyle('I3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('J3', $table_columns[9 ])->getColumnDimension('J')->setWidth(10);
    $object->getActiveSheet()->getStyle('J3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('K3', $table_columns[10])->getColumnDimension('K')->setWidth(20);
    $object->getActiveSheet()->getStyle('K3')->applyFromArray($textCenter);
    $object->getActiveSheet()->SetCellValue('L3', $table_columns[11])->getColumnDimension('L')->setWidth(20);
    $object->getActiveSheet()->getStyle('L3')->applyFromArray($textCenter);

    $object->getActiveSheet()->getStyle("A3:L3")->getFont()->setSize(15);
    $object->getActiveSheet()->setAutoFilter('A3:L3');
    $object->getActiveSheet()->getStyle("A3:L3")->applyFromArray($bgColor);

    $no = 4;
    if (isset($output_data) && $output_data != NULL) {
      foreach ($output_data as $key) {
        $dte = explode('-',explode(' ',$key['add_time'])[0]);
        $object->getActiveSheet()->getRowDimension($no)->setRowHeight(20);
        $object->getActiveSheet()->SetCellValue('A'.$no, (($no-4)+1));
        $object->getActiveSheet()->SetCellValue('B'.$no, $key['sob']);
        $object->getActiveSheet()->SetCellValue('C'.$no, $key['cob']);
        $object->getActiveSheet()->SetCellValue('D'.$no, $key['type_cob']);
        $object->getActiveSheet()->SetCellValue('E'.$no, $key['lob']);
        $object->getActiveSheet()->SetCellValue('F'.$no, $key['nama_nasabah']);
        $object->getActiveSheet()->SetCellValue('G'.$no, number_format($key['total_sum_insured']));
        $object->getActiveSheet()->SetCellValue('H'.$no, number_format($key['total_premi_standar']));
        $object->getActiveSheet()->SetCellValue('I'.$no, number_format($key['total_premi_perluasan']));
        $object->getActiveSheet()->SetCellValue('J'.$no, $key['diskon'].'%');
        $object->getActiveSheet()->SetCellValue('K'.$no, number_format($key['total_akhir_premi']));
        $object->getActiveSheet()->SetCellValue('L'.$no, $dte[2].'-'.$dte[1].'-'.$dte[0]);
        $no++;
      }
      $object->getActiveSheet()->getStyle('A1:L'.($no-1))->applyFromArray($stabborder);
    } else {
      $object->getActiveSheet()->mergeCells('A4:L4');
      $object->getActiveSheet()->getStyle('A4:L4')->applyFromArray($textCenter);
  		$object->getActiveSheet()->SetCellValue('L4', 'Tidak Ada data Untuk di Tampilkan');
    }

    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Production_Report ('.date('d-m-Y').').xls"');
    $object_writer->save('php://output');
  }

  public function to_pdf($value='')
  {
    $expl = explode('_', $value);
    $star = explode('-',$expl[0]);
    $endd = explode('-',$expl[1]);

    $betwen = array(
      'mulai' => $expl[0] == '' ? '' : $star[2].'-'.$star[1].'-'.$star[0].' 00:00:00',
      'smpai' => $expl[1] == '' ? '' : $endd[2].'-'.$endd[1].'-'.$endd[0].' 00:00:00'
    );
    $output_data = $this->prm->get_report_production($betwen);
		$isi = "<center style='font-family: arial; font-size: 18pt; text-align: center;'><b>PRODUCTION REPORT</b></center><br>";
    $isi = $isi."<table style='font-family: arial; font-style: italic; font-size: 10pt; font-size: 14vw; border-collapse: collapse;' border='1' width='1200'>".
				"<thead> ".
					"<tr style='font-family: arial; background-color: #81d41a;'> ".
						"<th>No</th>".
						"<th>SOB</th>".
						"<th>COB</th>".
						"<th>Type COB</th>".
						"<th>LOB</th>".
            "<th>Insured Name</th>".
						"<th>Total Sum Insured</th>".
						"<th>Total Premi Standar</th>".
						"<th>Total Premi Perluasan</th>".
						"<th>Diskon</th>".
            "<th>Total Akhir Premi</th>".
            "<th>Create Time</th>".
					"</tr> ".
				"</thead> ".
				"<tbody>";
    if (isset($output_data) && $output_data != NULL) {
      $no = 1;
      foreach ($output_data as $key) {
        $dte = explode('-',explode(' ',$key['add_time'])[0]);
        $isi = $isi."<tr>".
                      "<td>".$no."</td>".
                      "<td>".$key['sob']."</td>".
                      "<td>".$key['cob']."</td>".
                      "<td>".$key['type_cob']."</td>".
                      "<td>".$key['lob']."</td>".
                      "<td>".$key['nama_nasabah']."</td>".
                      "<td>".number_format($key['total_sum_insured'])."</td>".
                      "<td>".number_format($key['total_premi_standar'])."</td>".
                      "<td>".number_format($key['total_premi_perluasan'])."</td>".
                      "<td>".$key['diskon'].'%'."</td>".
                      "<td>".number_format($key['total_akhir_premi'])."</td>".
                      "<td>".$dte[2].'-'.$dte[1].'-'.$dte[0]."</td>".
                    "</tr>";
        $no++;
      }
    } else {
      $isi = $isi."<tr>".
      							"<td colspan='12'>Tidak Ada data Untuk di Tampilkan</td>".
      					  "</tr>";
    }
    $isi = $isi."</tbody> </table>";
    $name_file = "production_report (".date('d-m-Y').").pdf";
    $pdf = $this->pdf->load();
		$pdf->AddPage('L');
		$pdf->WriteHTML($isi);
    $pdf->Output($name_file, 'D');
  }
}

?>
