<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Induk_kumpulan extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_induk_kumpulan', 'induk_kumpulan');
    $this->load->helper('inputtype_helper');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
            'title' => 'Induk Kumpulan',
            'role'  => get_role($this->session->userdata('id_level_otorisasi')),
            'sob'   => $this->induk_kumpulan->get_data_order('m_sob', 'sob', 'asc')->result_array()
    ];

    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->induk_kumpulan->get_data_induk_kumpulan()->result_array();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = substr(getdbtable($key['ft_tertanggung']),2,strlen(getdbtable($key['ft_tertanggung'])));
      $tbody[] = $this->penamaan($key['tertanggung'], $key['ft_tertanggung']);
      $tbody[] = substr(getdbtable($key['ft_induk_kumpulan']),2,strlen(getdbtable($key['ft_induk_kumpulan'])));
      $tbody[] = $this->penamaan($key['induk_kumpulan'], $key['ft_induk_kumpulan']);
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<i style="cursor:pointer" class="fas fa-pencil-alt fa-lg text-primary mr-1 ttip" onclick="ubahubah('.$key['id'].')" data-toggle="tooltip" data-placement="top" title="Ubah"></i>&nbsp;';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<i style="cursor:pointer" class="far fa-trash-alt fa-lg text-danger ttip" onclick="deletedel('.$key['id'].')" data-toggle="tooltip" data-placement="top" title="Hapus"></i>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function penamaan($idn, $flg)
  {
    $has = getdbtable($flg);
    $inid = 'id_'.substr($has,2,strlen($has));
    $this->db->where('table_name', $has);
    $data = $this->db->get('information_schema.columns')->result();
    $fnme = array();
    foreach ($data as $key => $value) {
      if ($value->column_name == 'nama_'.substr($has,2,strlen($has)) || $value->column_name == 'nama') {
        $dat['nmny'] = $value->column_name;
        $fnme[] = $dat;
      }
    }
    $this->db->select($fnme[0]['nmny'].' as nama');
    $this->db->where($inid, $idn);
    $dat = $this->db->get($has)->result_array();
    $hsl = $dat[0]['nama'];

    return $hsl;
  }

  // 1-11-2021
  public function simpan_data()
  {
    $aksi               = $this->input->post('aksi');
    $id_relasi          = $this->input->post('id_relasi');
    $jenis_client_ttg   = $this->input->post('jenis_client_ttg');    
    $pil_tertanggung    = $this->input->post('pil_tertanggung');    
    $jenis_client_ik    = $this->input->post('jenis_client_ik');    
    $pil_induk_kumpulan = $this->input->post('pil_induk_kumpulan');    

    $inputan = ['ft_tertanggung'    => $jenis_client_ttg,
                'tertanggung'       => $pil_tertanggung,
                'ft_induk_kumpulan' => $jenis_client_ik,
                'induk_kumpulan'    => $pil_induk_kumpulan
                ];

    if ($aksi == 'tambah') {
      $cek = cek_duplicate_banyak('relasi_induk_kumpulan', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('relasi_induk_kumpulan', $inputan);
        $sts = 'sukses';
      } else {
        $sts = 'gagal';
      }
    } elseif ($aksi == 'ubah') {
      $cek = cek_duplicate_banyak('relasi_induk_kumpulan', '', '', $inputan);

      if ($cek == 0) {
        $this->db->update('relasi_induk_kumpulan', $inputan, ['id' => $id_relasi]);
        $sts = 'sukses';
      } else {
        $sts = 'gagal';
      }
    } elseif ($aksi == 'hapus') {
      $this->db->delete('relasi_induk_kumpulan', ['id' => $id_relasi]);
      
      $sts = 'sukses';
    }
    
    echo json_encode(['status' => $sts]);
  }

  // 1-11-2021
  public function get_induk_kumpulan($id)
  {
    $list = $this->db->get_where('relasi_induk_kumpulan', ['id' => $id])->row_array();
    
    echo json_encode($list);
  }

}

?>
