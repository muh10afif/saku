<?php 

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Xendit extends REST_Controller {

    public function index_get()
    {
        $this->response(['status' => "ok"], REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $tes = $this->post();

        $b = json_decode($tes);
        $c = $b->payment_method;

        $insert = $this->db->insert('tr_pembayaran_polis', ['tes_payment_method' => $c]);
        
        if ($insert) {
            $this->response(['tes_payment_method' => $c], REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
        
    }

    // public function index_get()
    // {
    //    $id = $this->get('id');
    //     if ($id == '') {
    //         $pekerjaan = $this->db->get('m_pekerjaan')->result();
    //     } else {
    //         $this->db->where('id_pekerjaan', $id);
    //         $pekerjaan = $this->db->get('m_pekerjaan')->result();
    //     }
    //     $this->response($pekerjaan, REST_Controller::HTTP_OK);
    // }

    // function index_post()
    // {
    //     $data = array(
    //         'pekerjaan'   => $this->post('pkj')
    //     );
    //     $insert = $this->db->insert('m_pekerjaan', $data);
    //     if ($insert) {
    //         $this->response($data, REST_Controller::HTTP_OK);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // function index_put() {
    //     $id = $this->put('id');
    //     $data = array(
    //         'pekerjaan'   => $this->put('pkj')
    //     );
    //     $this->db->where('id_pekerjaan', $id);
    //     $update = $this->db->update('m_pekerjaan', $data);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // function index_delete()
    // {
    //     $id = $this->delete('id');
    //     $this->db->where('id_pekerjaan', $id);
    //     $delete = $this->db->delete('m_pekerjaan');
    //     if ($delete) {
    //         $this->response(array('status' => 'success'), 201);
    //     } else {
    //         $this->response(array('status' => 'failed'), 502);
    //     }
    // }


}

/* End of file Xendit.php */
