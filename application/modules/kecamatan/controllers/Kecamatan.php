<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

    var $role;
    var $validcfg;
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_kecamatan', 'kec');
        $this->load->model('m_kecamatan', 'des');
        $this->load->library('form_validation');
        $this->role = get_role($this->session->userdata('id_level_otorisasi'));
        $this->validcfg = array(
            array('field' => 'kecamatan', 'label' => 'Kecamatan', 'rules' => 'required'),
            array('field' => 'id_kota', 'label' => 'Kota', 'rules' => 'required'),
        );
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
        $this->load->model(array('M_kecamatan')); 
        
	}

    // Desa Controller
    public function index()
    {
        $data 	= ['title'  => 'Master Kecamatan',
                    'list_kota' => $this->kec->listkota(),
                    'list_negara' => $this->kec->listnegara(),
                    'role' => $this->role
                ];

        $this->template->load('template/index','/kecamatan/lihat', $data);
    } 

    public function ajaxdatakec($action)
    {
        /*
            rulenya
            0 = update
            1 = delete
            2 = detail atau approve atau custom
        */
        $permisi = explode('_',$action);
        $b1 = ''; $b2 = '';
    
        $no   = $this->input->post('start');
        $data = $this->kec->get_data_kecamatan();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['kota'];
            $tbody[] = $key['kecamatan'];
            
            if ($permisi[2] == 'true' || $action == '_') {
                $b3 = '<span style="cursor:pointer" class="mr-2 text-dark detail '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detail2('.$key['id_kecamatan'].')">
                <i class="fas fa-info-circle fa-lg"></i>
                </span>';
            }
            if ($permisi[0] == 'true' || $action == '_') {
                $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_kecamatan'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
                </span>';
            }
            if ($permisi[1] == 'true' || $action == '_') {
                $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_kecamatan'].')">
                <i class="far fa-trash-alt fa-lg"></i>
                </span>';
            }
            $tbody[] = $b3.$b1.$b2;
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->des->countalllistkecamatan(),
            "recordsFiltered" => $this->des->countfilterlistkecamatan(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    function cekduplikat($db, $data) {
            $CI =& get_instance();
        
            $CI->db->select('column_name');
            $CI->db->where('table_name',$db);
            $colm = $CI->db->get('information_schema.columns')->result();
            $xy = array();
            foreach ($colm as $key) {
            if (substr($db,0,2) == "m_") {
                if ($key->column_name != 'id_'.substr($db,2,strlen($db)) &&
                    $key->column_name != 'add_time' &&
                    $key->column_name != 'add_by') {
                if ($key->column_name != 'kode_'.substr($db,2,strlen($db))) {
                    if (is_numeric($data[$key->column_name]) ||
                        $data[$key->column_name] == '' ||
                        $key->column_name == 'jenis_kelamin' ||
                        $key->column_name == 'status' ||
                        $key->column_name == 'tgl_lahir' ||
                        $key->column_name == 'parent') {
                    $xy[$key->column_name] = $data[$key->column_name];
                    } else {
                    $xy['LOWER('.$key->column_name.')'] = strtolower($data[$key->column_name]);
                    }
                }
                }
            } else {
                if ($key->column_name != 'id_'.$db &&
                    $key->column_name != 'add_time' &&
                    $key->column_name != 'add_by') {
                if ($key->column_name != 'kode_'.substr($db,2,strlen($db))) {
                    if (is_numeric($data[$key->column_name]) ||
                        $data[$key->column_name] == '' ||
                        is_bool($data[$key->column_name])) {
                    $xy[$key->column_name] = $data[$key->column_name];
                    } else {
                    $xy['LOWER('.$key->column_name.')'] = strtolower($data[$key->column_name]);
                    }
                }
                }
            }
            }
            $CI->db->where($xy);
            $cek = $CI->db->get($db)->num_rows();
            return $cek;
    }


    public function addkec()
    {

        
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);

            } else {

                // $kecamatan = strtolower($this->input->post('kecamatan'));

                // $this->db->where([
                //     'LOWER(kecamatan)' => $kecamatan
                // ]);
                // $cek = $this->db->get('m_kecamatan')->num_rows();

                // $this->db->select('kecamatan');
                // $this->db->from('m_kecamatan');
                // $this->db->where('LOWER(kecamatan)', $kecamatan);
                // $hasil = $this->db->get()->num_rows();

                // if ($hasil == 0) {

                    $data['kecamatan']  = $this->input->post('kecamatan');
                    $data['id_kota']    = $this->input->post('id_kota');
                    $data['add_time']   = date('Y-m-d');
                    $data['add_by']     = $this->session->userdata('sesi_id');

                    // $cek = $this->cekduplikat('m_kecamatan', $data);  

                    $inputan = ['LOWER(kecamatan)'  => strtolower($this->input->post('kecamatan')),
                                'id_kota'           => $this->input->post('id_kota')
                                ];
                    
                    $cek = cek_duplicate_banyak('m_kecamatan', '', '', $inputan);


                    if ($cek == 0) {
                            $this->db->insert('m_kecamatan', $data);
                            echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Kecamatan telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
                        } else {
                            echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Kecamatan tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                        }
                
            
            }
    }

    public function showkec($id)
    {
        $this->db->select('*');
        $this->db->where('m_kecamatan.id_kecamatan',$id);
        $this->db->join('m_kota', 'm_kota.id_kota = m_kecamatan.id_kota');
        $this->db->join('m_provinsi', 'm_provinsi.id_provinsi = m_kota.id_provinsi', 'left');
        $this->db->join('m_negara', 'm_negara.id_negara = m_provinsi.id_negara', 'left');
        $data = $this->db->get('m_kecamatan')->result();
        echo json_encode($data);
    }

    //24-JUni-2021 RFA
    public function kotabyprovinsi($id)
    {
        $this->db->where('id_provinsi',$id);
        $this->db->order_by("kota", "asc");
        $data = $this->db->get('m_kota')->result();
        echo json_encode($data);
    }

    
    public function provinsibynegara($id)
    {
        $this->db->where('id_negara',$id);
        $this->db->order_by("provinsi", "asc");
        $data = $this->db->get('m_provinsi')->result();
        echo json_encode($data);
    }

    //24-JUni-2021 RFA
    public function kecamatanbykota($id)
    {
        $this->db->where('id_kota',$id);
        $this->db->order_by("kecamatan", "asc");
        $data = $this->db->get('m_kecamatan')->result();
        echo json_encode($data);
    }

    public function editkec($id)
    {
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
                // $this->db->where(['LOWER(kecamatan)' => strtolower($this->input->post('kecamatan'))]);

                // $cek = $this->db->get('m_kecamatan')->num_rows();

                // $this->db->select('*');
                // $this->db->from('m_kecamatan');
                // $this->db->where('LOWER(kecamatan)', strtolower($this->input->post('kecamatan')));
                // $hasil = $this->db->get()->num_rows();

                // if ($hasil == 0) {
                    $data['kecamatan']  = $this->input->post('kecamatan');
                    $data['id_kota']    = $this->input->post('id_kota');
                    $data['add_time']   = date('Y-m-d');
                    $data['add_by']     = $this->session->userdata('sesi_id');

                    $inputan = ['LOWER(kecamatan)'  => strtolower($this->input->post('kecamatan')),
                                'id_kota'           => $this->input->post('id_kota')
                                ];
                    
                    $cek = cek_duplicate_banyak('m_kecamatan', 'id_kecamatan', $id, $inputan);

                    if ($cek == 0) {
                        $this->db->where('id_kecamatan', $id);
                        $this->db->update('m_kecamatan', $data);
                        echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Kecamatan telah di Update', 'altr' =>'success', 'hasil' => '']);
                    } else {
                        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Kecamatan tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                    }
                // } else {
                //         echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Kecamatan tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                // }
            }
    }

    public function removekec($id)
    {
        $this->db->where('id_kecamatan',$id);
            $this->db->delete('m_kecamatan');
    
        echo json_encode(['status' => 'sukses']);
    }
    //End Desa Controller

}

/* End of file Master.php */
