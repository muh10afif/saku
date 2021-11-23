<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coa extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_coa');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }
    }

    // 07-06-2021
    public function index()
    {
        $data 	= [ 'title'             => 'Chart Of Account',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'data_head_coa'     => $this->M_coa->get_head_coa(),
		            'data_main_coa'     => $this->M_coa->get_main_coa()
                ];

        $this->template->load('template/index','V_coa', $data);
    }

	public function coa_lr()
	{
        $data 	= [ 'title'             => 'Chart Of Account',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'data_head_coa'     => $this->M_coa->get_head_coalr(),
		            'data_main_coa'     => $this->M_coa->get_main_coalr()
                ];

        $this->template->load('template/index','V_coa_lr', $data);
	}

	

    public function hapus($jenis, $id)
    {   
         $this->M_coa->hapus($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Berhasil Dihapus</strong>
            </div>');
            redirect('coa/'.$jenis,'refresh');
        }
        else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Gagal Dihapus</strong>
            </div>');
            redirect('coa/'.$jenis,'refresh');
        }
    }

    public function simpan_hcn()
    {
    	$arr = array(
    		'no_coa_head' => $this->input->post('no_coa_head'),
    		'head_coa' => $this->input->post('head_coa'),
    		'neraca_lr' => "1");
    	$data = $this->M_coa->simpan_hc($arr);

    	if ($this->db->affected_rows() > 0) {
    		$this->session->set_flashdata('pesan', '<div class="alert alert-primary">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Berhasil Disimpan</strong>
    		</div>');
    		redirect('coa','refresh');
    	}
    	else{
    		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Gagal Disimpan</strong>
    		</div>');
    		redirect('coa','refresh');
    	}
    }


     public function simpan_hcl()
    {
    	$arr = array(
    		'no_coa_head' => $this->input->post('no_coa_head'),
    		'head_coa' => $this->input->post('head_coa'),
    		'neraca_lr' => "0");
    	$data = $this->M_coa->simpan_hc($arr);

    	if ($this->db->affected_rows() > 0) {
    		$this->session->set_flashdata('pesan', '<div class="alert alert-primary">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Berhasil Disimpan</strong>
    		</div>');
    		redirect('coa/coa_lr','refresh');
    	}
    	else{
    		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Gagal Disimpan</strong>
    		</div>');
    		redirect('coa/coa_lr','refresh');
    	}
    }

     public function simpan_mcn()
    {
    	$arr = array(
    		'no_coa_main' => $this->input->post('no_coa_main'),
    		'no_coa_head' => $this->input->post('head_coa'),
    		'main_coa' => $this->input->post('main_coa'),);
    	$data = $this->M_coa->simpan_mcn($arr);

    	if ($this->db->affected_rows() > 0) {
    		$this->session->set_flashdata('pesan', '<div class="alert alert-primary">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Berhasil Disimpan</strong>
    		</div>');
    		redirect('coa','refresh');
    	}
    	else{
    		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Gagal Disimpan</strong>
    		</div>');
    		redirect('coa','refresh');
    	}
    }

    public function simpan_mcl()
    {
    	$arr = array(
    		'no_coa_main' => $this->input->post('no_coa_main'),
    		'no_coa_head' => $this->input->post('head_coa'),
    		'main_coa' => $this->input->post('main_coa'),);
    	$data = $this->M_coa->simpan_mcn($arr);

    	if ($this->db->affected_rows() > 0) {
    		$this->session->set_flashdata('pesan', '<div class="alert alert-primary">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Berhasil Disimpan</strong>
    		</div>');
    		redirect('coa/coa_lr','refresh');
    	}
    	else{
    		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Gagal Disimpan</strong>
    		</div>');
    		redirect('coa/coa_lr','refresh');
    	}
    }

    public function simpan_dcn()
    {
        $jenis = $this->input->post('jenis');
        
    	$arr = array(
    		'no_coa_des' => $this->input->post('no_coa_des'),
    		'no_coa_main' => $this->input->post('main_coa'),
    		'deskripsi_coa' => $this->input->post('deskripsi_coa'),
    		'saldo_awal'	=> str_replace(',','', $this->input->post('saldo_awal'))
    	);
    	$data = $this->M_coa->simpan_dcn($arr);

    	if ($this->db->affected_rows() > 0) {
    		$this->session->set_flashdata('pesan', '<div class="alert alert-primary">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Berhasil Disimpan</strong>
    		</div>');
    		redirect('coa/'.$jenis,'refresh');
    	}
    	else{
    		$this->session->set_flashdata('pesan', '<div class="alert alert-danger">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    			<strong>Data Gagal Disimpan</strong>
    		</div>');
    		redirect('coa/'.$jenis,'refresh');
    	}
    }

      public function simpan_dcl()
    {
        $arr = array(
            'no_coa_des' => $this->input->post('no_coa_des'),
            'no_coa_main' => $this->input->post('main_coa'),
            'deskripsi_coa' => $this->input->post('deskripsi_coa'),
            'saldo_awal'    => str_replace(',','', $this->input->post('saldo_awal'))
        );
        $data = $this->M_coa->simpan_dcn($arr);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Berhasil Disimpan</strong>
            </div>');
            redirect('coa/coa_lr','refresh');
        }
        else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Gagal Disimpan</strong>
            </div>');
            redirect('coa/coa_lr','refresh');
        }
    }


	public function edit()
	{
		$id = $this->input->GET('id_head_coa');
		$data = $this->M_coa->edit($id);

		echo json_encode($data);
	}

	
	
    public function update_coa()
    {   
        $id_head = $this->input->post('id_head_coa');
        $head = array(
        
        'head_coa'=>$this->input->post('head_coa')
        );
        $this->M_coa->update_head($id_head,$head);

        $id_main = $this->input->post('id_main_coa');
        $main = array(
        'main_coa'=>$this->input->post('main_coa')
        );
        $this->M_coa->update_main($id_main,$main);

        $id_des = $this->input->post('id_des_coa');
        $arr = array(
            'no_coa_des' => $this->input->post('no_coa_des'),
            'deskripsi_coa' => $this->input->post('des_coa'),
            'saldo_awal' => str_replace(',', '', $this->input->post('saldo_awal')),
        );
        $this->M_coa->update_des($id_des,$arr);

        if ($this->db->affected_rows()> 0 ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Berhasil Diupdate</strong>
            </div>');
            redirect('coa','refresh');
        }
        else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Gagal Diupdate</strong>
            </div>');
            redirect('coa','refresh');
        }
    }

    public function update_coalr()
    {   
        $id_head = $this->input->post('id_head_coa');
        $head = array(
        
        'head_coa'=>$this->input->post('head_coa')
        );
        $this->M_coa->update_head($id_head,$head);

        $id_main = $this->input->post('id_main_coa');
        $main = array(
        'main_coa'=>$this->input->post('main_coa')
        );
        $this->M_coa->update_main($id_main,$main);

         $id_des = $this->input->post('id_des_coa');
        $arr = array(
            'no_coa_des' => $this->input->post('no_coa_des'),
            'deskripsi_coa' => $this->input->post('des_coa'),
            'saldo_awal' => str_replace(',', '', $this->input->post('saldo_awal')),
        );
        $this->M_coa->update_des($id_des,$arr);

        if ($this->db->affected_rows()> 0 ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Berhasil Diupdate</strong>
            </div>');
            redirect('coa/coa_lr','refresh');
        }
        else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Data Gagal Diupdate</strong>
            </div>');
            redirect('coa/coa_lr','refresh');
        }
    }


    public function import(){
                $config['upload_path']          = realpath(FCPATH.'uploads/');
                $config['allowed_types']        = 'xlsx|xls';
                $config['remove_spaces']        = TRUE;
                $config['overwrite']            = true;

                 $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file_excel'))
                {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                }
                else
                {   
                    $error = $this->upload->display_errors();

                    $filename = $this->upload->data('file_name');
                    $excelreader = new PHPExcel_Reader_Excel2007();
                    $loadexcel = $excelreader->load(FCPATH.'uploads/'.$filename); // Load file yang tadi diupload ke folder excel
                    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                    $numrow = 1;
                    foreach($sheet as $row){
                        if ($numrow > 1 && !empty($row['A'])) {
                            $c = array(
                                'no_coa_des' => $row['A'],
                                'deskripsi_coa' => $row['B'],
                                'no_coa_main'=> $row['C'],
                                'saldo_awal' => $row['D'],
                        );
                            $this->db->insert('des_coa',$c);
                        }
                        
                      
                      $numrow++; // Tambah 1 setiap kali looping
                    }
                    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                    
                    if ($this->db->affected_rows() != 1) {
                         $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                    }else
                    {
                        // $this->M_coa->update_mains();
                        $this->session->set_flashdata("pesan", "
                        <div class='alert alert-primary alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'></h4>Import Berhasil
                        </div>");
               redirect('coa');
                    }
    }

    }

    public function import_main(){
                $config['upload_path']          = realpath(FCPATH.'uploads/');
                $config['allowed_types']        = 'xlsx|xls';
                $config['remove_spaces']        = TRUE;
                $config['overwrite'] = true;

                 $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file_excel'))
                {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                }
                else
                {   
                    $error = $this->upload->display_errors();

                    $this->db->query('TRUNCATE TABLE main_coa');
                    $filename = $this->upload->data('file_name');
                    $excelreader = new PHPExcel_Reader_Excel2007();
                    $loadexcel = $excelreader->load(FCPATH.'uploads/'.$filename); // Load file yang tadi diupload ke folder excel
                    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                    $numrow = 1;
                    foreach($sheet as $row){
                        if ($numrow > 1 && !empty($row['A'])) {
                            $c = array(
                                'no_coa_main' => $row['A'],
                                'main_coa' => $row['B'],
                                'no_coa_head'=> $row['C']
                        );
                            $this->db->insert('main_coa',$c);
                        }
                        
                      
                      $numrow++; // Tambah 1 setiap kali looping
                    }
                    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                    
                    if ($this->db->affected_rows() != 1) {
                         $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                    }else
                    {
                        // $this->M_coa->update_mains();
                        $this->session->set_flashdata("pesan", "
                        <div class='alert alert-primary alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'></h4>Import Berhasil
                        </div>");
               redirect('coa');
                    }
    }

    }


    public function import_truncate(){
                $this->db->query('TRUNCATE TABLE des_coa');
                $config['upload_path']          = realpath(FCPATH.'uploads/');
                $config['allowed_types']        = 'xlsx|xls';
                $config['remove_spaces']        = TRUE;
                $config['overwrite'] = true;

                 $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('file_excel'))
                {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                }
                else
                {   
                    $error = $this->upload->display_errors();

                    $filename = $this->upload->data('file_name');
                    $excelreader = new PHPExcel_Reader_Excel2007();
                    $loadexcel = $excelreader->load(FCPATH.'uploads/'.$filename); // Load file yang tadi diupload ke folder excel
                    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
                    $numrow = 1;
                    foreach($sheet as $row){
                        if ($numrow > 1 && !empty($row['A'])) {
                            $c = array(
                                'no_coa_des' => $row['A'],
                                'deskripsi_coa' => $row['B'],
                                'no_coa_main'=> $row['C'],
                                'saldo_awal' => $row['D'],
                        );
                            $this->db->insert('des_coa',$c);
                        }
                        
                      
                      $numrow++; // Tambah 1 setiap kali looping
                    }
                    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
                    
                    if ($this->db->affected_rows() != 1) {
                         $this->session->set_flashdata("sukses", "
                        <div class='alert alert-danger alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'>Upload Failed</h4>  $error
                        </div>");
                        redirect('coa',$error);
                    }else
                    {
                        // $this->M_coa->update_mains();
                        $this->session->set_flashdata("pesan", "
                        <div class='alert alert-primary alert-block'> <a class='close' data-dismiss='alert' href='#'>×</a> <h4 class='alert-heading'></h4>Import Berhasil
                        </div>");
               redirect('coa');
                    }
    }

    }

}

?>
