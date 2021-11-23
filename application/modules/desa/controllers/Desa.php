<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

    var $role;
    var $validcfg;
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_desa', 'kec');
        $this->load->model('m_desa', 'des');
        $this->load->library('form_validation');
        $this->role = get_role($this->session->userdata('id_level_otorisasi'));
        $this->validcfg = array(
            array('field' => 'desa', 'label' => 'Desa', 'rules' => 'required'),
            array('field' => 'id_kecamatan', 'label' => 'Kecamatan', 'rules' => 'required'),
        );
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
        $this->load->model(array('M_desa')); 
        
	}

    // Desa Controller
    public function index()
    {
        $data 	= ['title'  => 'Master Desa/Kelurahan',
                    'list_desa' => $this->des->list_desa(),
                    'list_negara' => $this->kec->listnegara(),
                ];

        $this->template->load('template/index','/desa/lihat', $data);
    } 

    public function ajaxdatades($action)
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
        $data = $this->des->get_data_desa();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['kecamatan'];
            $tbody[] = $key['desa'];
            
            if ($permisi[2] == 'true' || $action == '_') {
                $b3 = '<span style="cursor:pointer" class="mr-2 text-dark detail '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detail2('.$key['id_desa'].')">
                <i class="fas fa-info-circle fa-lg"></i>
                </span>';
            }
            if ($permisi[0] == 'true' || $action == '_') {
                $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_desa'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
                </span>';
            }
            if ($permisi[1] == 'true' || $action == '_') {
                $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_desa'].')">
                <i class="far fa-trash-alt fa-lg"></i>
                </span>';
            }
            $tbody[] = $b3.$b1.$b2;
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->des->countalllistdesa(),
            "recordsFiltered" => $this->des->countfilterlistdesa(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    public function adddes()
    {

        // $this->form_validation->set_rules($this->validcfg);
        // if ($this->form_validation->run() == FALSE) {
        // echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Form Desa kosong / Sudah Ada', 'altr' =>'warning']);
        // }else{
        //     $data['desa']           = $this->input->post('desa');
        //     $data['id_kecamatan']   = $this->input->post('id_kecamatan');
        //     $data['add_time']       = date('Y-m-d');
        //     $data['add_by']         = $this->session->userdata('sesi_id');
        //     $this->db->insert('m_desa', $data);

        // echo json_encode(['status' => "Berhasil", 'pesan' => 'Data Desa Telah di Simpan', 'altr' => 'success']);
        // }
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
                // $this->db->where([
                //     'LOWER(desa)' => strtolower($this->input->post('desa'))
                // ]);
                // $cek = $this->db->get('m_desa')->num_rows();
                // if ($cek == 0) {

                $data['desa']           = $this->input->post('desa');
                $data['id_kecamatan']   = $this->input->post('id_kecamatan');
                $data['add_time']       = date('Y-m-d');
                $data['add_by']         = $this->session->userdata('sesi_id');
                // $this->db->insert('m_desa', $data);

                $inputan = ['LOWER(desa)'   => strtolower($this->input->post('desa')),
                            'id_kecamatan'  => $this->input->post('id_kecamatan')
                            ];
                
                $cek = cek_duplicate_banyak('m_desa', '', '', $inputan);

                if ($cek == 0) {
                    $this->db->insert('m_desa', $data);
                    echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Desa telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
                } else {
                    echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Desa tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                }
                // } else {
                // echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Desa tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                // }
        
            }
    }

    public function showdes($id)
    {
        // $data = $this->des->showdatabydes($id);

        $this->db->select('*');
        $this->db->where('id_desa',$id);
        $this->db->join('m_kecamatan', 'm_kecamatan.id_kecamatan = m_desa.id_kecamatan');
        $this->db->join('m_kota', 'm_kota.id_kota = m_kecamatan.id_kota', 'left');
        $this->db->join('m_provinsi', 'm_provinsi.id_provinsi = m_kota.id_provinsi', 'left');
        $this->db->join('m_negara', 'm_negara.id_negara = m_provinsi.id_negara', 'left');
        $data = $this->db->get('m_desa')->result();
        echo json_encode($data);
    }

    public function editdesa($id)
    {
        // $this->form_validation->set_rules($this->validcfg);
        // if ($this->form_validation->run() == FALSE) {
        // echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Form Desa kosong', 'altr' =>'warning']);
        // }else{
        //     $data['desa'] = $this->input->post('desa');
        //     $data['id_kecamatan'] = $this->input->post('id_kecamatan');
        //     $data['id_desa'] = $this->input->post('id_desa');
        //     $data['add_time'] = date('Y-m-d');
        //     $data['add_by'] = $this->session->userdata('sesi_id');
        //     $this->db->where('id_desa', $id);
        //     $this->db->update('m_desa', $data);

        // echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Desa Telah di Update', 'altr' => 'success']);
        // }
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
                // $this->db->where([
                //     'LOWER(desa)' => strtolower($this->input->post('desa'))
                // ]);
                // $cek = $this->db->get('m_desa')->num_rows();
                // if ($cek == 0) {
                $data['desa'] = $this->input->post('desa');
                $data['id_kecamatan'] = $this->input->post('id_kecamatan');
                $data['add_time'] = date('Y-m-d');
                $data['add_by'] = $this->session->userdata('sesi_id');

                $inputan = ['LOWER(desa)'   => strtolower($this->input->post('desa')),
                            'id_kecamatan'  => $this->input->post('id_kecamatan')
                            ];
                
                $cek = cek_duplicate_banyak('m_desa', 'id_desa', $id, $inputan);

                if ($cek == 0) {
                    $this->db->where('id_desa', $id);
                    $this->db->update('m_desa', $data);
                    echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Desa telah di Update', 'altr' =>'success', 'hasil' => '']);
                } else {
                    echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Desa tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                }
            //     } else {
            //     echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Desa tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
            //     }
            }
    }

    public function removedes($id)
    {
        $this->db->where('id_desa',$id);
            $this->db->delete('m_desa');
    
        echo json_encode(['status' => 'sukses']);
    }
    //End Desa Controller

}

/* End of file Master.php */
