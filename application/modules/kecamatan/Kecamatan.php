<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_kecamatan', 'kec');
        $this->load->model('m_kecamatan', 'des');
        $this->load->library('form_validation');
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

    // Kecamatan Controller
    public function index()
    {
        $data 	= ['title'  => 'Master Kecamatan',
                    'list_kota' => $this->kec->listkota(),
                    'list_negara' => $this->db->get('m_negara')->result(),
                ];

        $this->template->load('template/index','/kecamatan/lihat', $data);
    } 

    public function ajaxdatakac()
    {
        $no   = $this->input->post('start');
        $data = $this->kec->get_data_kecamatan();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['kota'];
            $tbody[] = $key['kecamatan'];
            $tbody[] = '
                        <span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_kecamatan'].')">
                        <i class="fas fa-pencil-alt fa-lg"></i>
                        </span>
                        <span style="cursor:pointer" class="text-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_kecamatan'].')">
                        <i class="far fa-trash-alt fa-lg"></i>
                        </span>
                        ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->kec->countalllistkecamatan(),
            "recordsFiltered" => $this->kec->countfilterlistkecamatan(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    public function add()
    { 

        $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Form Kecamatan kosong', 'altr' =>'warning']);
            }else{
                $data['kecamatan'] = $this->input->post('kecamatan');
                $data['id_kota'] = $this->input->post('id_kota');
                $data['add_time'] = date('Y-m-d');
                $data['add_by'] = $this->session->userdata('sesi_id');
                $this->db->insert('m_kecamatan', $data);

                echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Kecamatan', 'altr' => 'success']);
            }
    }

    public function showkec($id)
    {
        $data = $this->kec->showdatabykec($id);
        echo json_encode($data);
    }

    //24-JUni-2021 RFA
    public function kotabyprovinsi($id)
    {
        $this->db->where('id_provinsi',$id);
        $data = $this->db->get('m_kota')->result();
        echo json_encode($data);
    }

    //24-JUni-2021 RFA
    public function kecamatanbykota($id)
    {
        $this->db->where('id_kota',$id);
        $data = $this->db->get('m_kecamatan')->result();
        echo json_encode($data);
    }

    public function editkecamatan($id)
    {

        $this->form_validation->set_rules($this->validcfg);
        if ($this->form_validation->run() == FALSE) {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Form Kecamatan kosong', 'altr' =>'warning']);
        }else{
            $data['kecamatan'] = $this->input->post('kecamatan');
            $data['id_kota'] = $this->input->post('id_kota');
            $data['id_kecamatan'] = $this->input->post('idkec');
            $data['add_time'] = date('Y-m-d');
            $data['add_by'] = $this->session->userdata('sesi_id');
            $this->db->where('id_kecamatan', $id);
            $this->db->update('m_kecamatan', $data);

        echo json_encode(['status' => "Berhasil", 'pesan' => 'Kecamatan Telah di Update', 'altr' => 'success']);
        }
    }

    public function removekec($id)
    {
        $this->db->where('id_kecamatan',$id);
            $this->db->delete('m_kecamatan');
    
        echo json_encode(['status' => 'sukses']);
    }
    //End Kecamatan COntroller

}

/* End of file Master.php */
