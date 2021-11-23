<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_induk_kumpulan extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  public function get_data_induk_kumpulan()
  {
    $this->db->from('relasi_induk_kumpulan');
    $this->db->order_by('ft_tertanggung', 'asc');
    
    return $this->db->get();
    
  }

  // 08-11-2021
  public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    public function cari_data_order($tabel, $where, $field, $order)
    {
        $this->db->order_by($field, $order);

        return $this->db->get_where($tabel, $where);
    }

    public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
        return $this->db->get($tabel);
    }

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
    }

    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }
}

?>
