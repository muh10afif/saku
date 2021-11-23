<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Business_specifications extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_business_specifications', 'bsp');
    $this->load->model('cob_lob/M_cob', 'cob');
    $this->load->helper('inputtype_helper');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Set Business Specifications',
      'data_cob' => $this->cob->list_cob(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function showboth($id)
  {
    $data = $this->bsp->joincoblob($id);
    // $hasil = array();
    // foreach ($data as $key) {
    //   $isi = array();
    //   $cek = $this->bsp->ceksb($key->id_lob);
    //   $isi['id_lob'] = $key->id_lob;
    //   $isi['lob']    = $key->lob;
    //   $isi['stat'] = $cek > 0 ? 1 : 0;
    //   $hasil[] = $isi;
    // }
    echo json_encode($data);
  }

  public function setprop()
  {
    $cdata = $this->input->post('mnu');
    $optony = array();
    if ($cdata == 0) {
      $valisi = $this->input->post('foval');
      $nmeisi = $this->input->post('fonme');

      for ($i=0; $i < count($valisi); $i++) {
        $isin = array();
        if ($valisi[$i] != "" && $nmeisi[$i] != "") {
          $isin['valuen'] = $valisi[$i];
          $isin['nameny'] = $nmeisi[$i];
          $optony[] = $isin;
        }
      }
    } else {
      $optony['tbnme'] = $this->input->post('frdbs');
    }

    $mxlengt = $this->input->post('lng_max');
    $milengt = $this->input->post('lng_min');

    $lenth = array();
    if ($mxlengt != "" && $milengt != "") {
      $lenth['max'] = $mxlengt;
      $lenth['min'] = $milengt;
    } else {
      $lenth = "";
    }

    $sprt = '';
    if ($this->input->post('sprt') == 1) { $sprt = 'Y'; }
    else { $sprt = 'N'; }

    $data = array(
      'type' => $this->input->post('dtty'),
      'intp' => $this->input->post('inty'),
      'unqe' => $this->input->post('stat'),
      'sprt' => $sprt,
      'lngh' => $lenth == ""? '':json_encode($lenth, JSON_FORCE_OBJECT),
      'opfl' => count($optony) > 0?(int)$cdata:null,
      'opti' => count($optony) > 0?json_encode($optony, JSON_FORCE_OBJECT):null
    );
    echo json_encode($data);
  }

  public function add()
  {
    $ilob = $this->input->post('idlob');
    $field = $this->input->post('isfild');

    $this->db->where('id_relasi_cob_lob', $ilob);
    $cek = $this->db->get('m_sppa_field_spec');
    if ($cek->num_rows() > 0) {
      $cek_prop = $cek->result();
      foreach ($cek_prop as $key) {
        $this->db->where('id_sppa_field_spec', $key->id_sppa_field_spec);
        $this->db->delete('m_field_sppa_prop');
      }
      $this->db->where('id_relasi_cob_lob', $ilob);
      $this->db->delete('m_sppa_field_spec');
    }
    $list = array();
    for ($i=0; $i < count($field); $i++) {
      $isinya['id_relasi_cob_lob'] = $ilob;
      $isinya['type_field']        = $field[$i];
      $isinya['add_time']          = date('Y-m-d');
      $isinya['add_by']            = $this->session->userdata('sesi_id');
      $this->db->insert('m_sppa_field_spec', $isinya);
      $list[] = $this->db->insert_id();
    }

    $prfield  = $this->input->post('propasset');
    for ($i=0; $i < count($list); $i++) {
      $prdetail = json_decode($prfield[$i], true);
      $setparam = strtolower($prdetail['type']);

      $send['id_sppa_field_spec']   = $list[$i];
      $send['key_to_param']         = str_replace(' ','_',$setparam);
      $send['input_type']           = $prdetail['intp'];
      $send['field_unique']         = $prdetail['unqe'];
      $send['sparator_number']      = $prdetail['sprt'];
      $send['if_input_type_select'] = json_encode(json_decode($prdetail['opti'], true), JSON_FORCE_OBJECT);
      $send['add_time']             = date('Y-m-d');
      $send['add_by']               = $this->session->userdata('sesi_id');
      $send['option_flag']          = $prdetail['opfl'];
      $send['input_length']         = json_encode(json_decode($prdetail['lngh'], true), JSON_FORCE_OBJECT);
      $this->db->insert('m_field_sppa_prop', $send);
    }
    echo json_encode(['status' => 'sukses']);
  }

  public function previewn($value='')
  {
    $ilob = $this->input->post('idlob');
    $field = $this->input->post('isfild');

    $data = array();
    $prfield  = $this->input->post('propasset');
    for ($i=0; $i < count($field); $i++) {
      $this->db->where('id_field_sppa', $field[$i]);
      $hass = $this->db->get('m_field_sppa')->result();
      $prdetail = json_decode($prfield[$i], true);
      $iss = array();
      $list['id_lob']               = $ilob;
      $list['fieldnm']              = $hass[0]->field_sppa;
      $list['name_id']              = str_replace(" ","_", strtolower($hass[0]->field_sppa));
      $list['input_type']           = $prdetail['intp'];
      $list['sparator_num']         = $prdetail['sprt'];
      $list['key_to_param']         = $prdetail['type'];
      $list['option_flag']          = $prdetail['opfl'];
      $list['if_input_type_select'] = json_decode($prdetail['opti'], true);
      $list['input_length']         = $prdetail['lngh'];
      $iss[] = forinputtwo($list);
      $data[] = $iss;
    }
    echo json_encode(['hasil' => $data]);
  }

  public function getdatan($id)
  {
    $cek = $this->input->post('idc');
    $data = $this->bsp->showprop(['relasi_cob_lob.id_relasi_cob_lob' => $id]);
    echo json_encode($data);
  }

  public function listmastermenu()
  {
    $this->db->select('table_name');
    $this->db->like('table_name','m_','after');
    $data = $this->db->get('information_schema.tables')->result();
    echo json_encode($data);
  }

  public function listfieldname($nme)
  {
    $this->db->select('column_name');
    $this->db->where('table_name',$nme);
    $data = $this->db->get('information_schema.columns')->result();
    echo json_encode($data);
  }
}

?>
