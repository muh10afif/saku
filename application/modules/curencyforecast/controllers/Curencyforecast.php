<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Curencyforecast extends CI_controller
{

  public function __construct() {
    parent::__construct();
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function pengecekan($value='')
  {
    $response_json = "";
    $sifil = json_decode(file_get_contents(base_url().'/jsonf/result.json'), true);
    $timestamp = $sifil['time_last_update_unix'];
    if ($timestamp != "" && date('Y-m-d') == gmdate("Y-m-d",$timestamp)) {
      $response_json = file_get_contents(base_url().'/jsonf/result.json');
    } else {
      file_put_contents("./jsonf/result.json", "");
      $req_url = 'https://v6.exchangerate-api.com/v6/6d6fae372064999a5f04bfe0/latest/IDR';
      $response_json = file_get_contents($req_url);
      $fp = fopen('./jsonf/result.json', 'w');
      fwrite($fp, $response_json);
      fclose($fp);
    }
    return json_decode($response_json);
  }

  public function cekpjg($value='')
  {
    $jadi = "";
    $sifil = json_decode(file_get_contents(base_url().'/jsonf/c_code.json'), true);
    $sfl = $sifil['supported_codes'];
    for ($i=0; $i < $sfl; $i++) {
      if ($sfl[$i][0] == $value) {
        $jadi = $sfl[$i][1];
        break;
      }
    }
    return $jadi;
  }

  public function index($value='')
  {
    $kumpul = array(); $input_db = array();
    $isnya = $this->pengecekan();
    foreach ($isnya->conversion_rates as $key => $value) {
      $dta['name']  = $this->cekpjg($key);
      $dta['kode']  = $key;
      $dta['value'] = 500;
      $dta['buy']   = $value*500;
      $kumpul[]     = $dta;

      $inp['tahun']          = gmdate('Y',$isnya->time_last_update_unix);
      $inp['bulan']          = gmdate('F',$isnya->time_last_update_unix);
      $inp['kode_mata_uang'] = $key;
      $inp['rate']           = $value;
      $inp['add_time']       = date('Y-m-d H:i:s');
      $inp['add_by']         = $this->session->userdata('sesi_id');
      $input_db[]            = $inp;
    }

    $wkt = date('Y-m-d');
    $cekk = $this->db->query("SELECT * FROM m_currency_forecast where substring(cast(add_time as varchar),0,11) = '".$wkt."'")->num_rows();
    // var_dump($cekk); die();
    if ($cekk == 0) {
      $this->db->truncate('m_currency_forecast');
      $this->db->insert_batch('m_currency_forecast', $input_db);
    }

    $data = [
      'title' => 'Master Curreny Forecast',
      'time'  => gmdate('D, j F Y',$isnya->time_last_update_unix),
      'listc' => $kumpul
    ];
    $this->template->load('template/index', 'index', $data);
  }
}

?>
