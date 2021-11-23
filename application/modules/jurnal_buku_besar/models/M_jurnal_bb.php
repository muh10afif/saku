<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jurnal_bb extends CI_Model {

    // 10-08-2021
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

    // 10-08-2021
    // Menampilkan list jurnal_bb
    public function get_data_jurnal_bb()
    {
        $this->_get_datatables_query_jurnal_bb();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_jurnal_bb = [null, 'LOWER(kode_transaksi)', 'LOWER(nama_transaksi)', 'CAST(tgl_buat as VARCHAR)', 'total_debit', 'total_kredit', 'status'];
    var $kolom_cari_jurnal_bb  = ['LOWER(kode_transaksi)', 'LOWER(nama_transaksi)', 'CAST(tgl_buat as VARCHAR)', 'total_debit', 'total_kredit', 'status'];
    var $order_jurnal_bb       = ['id_jurnal' => 'desc'];

    public function _get_datatables_query_jurnal_bb()
    {
        $bulan = date("Y-m", strtotime($this->input->post('bulan')));

        $this->db->select('*');
        $this->db->from('jurnal');

        if ($this->input->post('bulan') != '') {
            $this->db->where("to_char(tgl_buat, 'YYYY-MM') = '$bulan'");
        }

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_jurnal_bb;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_jurnal_bb;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_jurnal_bb)) {
            
            $order = $this->order_jurnal_bb;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_jurnal_bb()
    {
        $bulan = date("Y-m", strtotime($this->input->post('bulan')));

        $this->db->select('*');
        $this->db->from('jurnal');

        if ($this->input->post('bulan') != '') {
            $this->db->where("to_char(tgl_buat, 'YYYY-MM') = '$bulan'");
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_jurnal_bb()
    {
        $this->_get_datatables_query_jurnal_bb();

        return $this->db->get()->num_rows();
        
    }

	
    public function get_head_coa()
    {
        return $this->db->get('head_coa')->result();
    }

    public function hapus($id)
    {
        $this->db->where('id_des_coa', $id);
        $this->db->delete('des_coa');
    }

    public function get_main_coa()
    {
        return $this->db->get('main_coa')->result();
    }

    public function get_group()
    {
        return $this->db->get('group')->result();
    }

    public function get_description_coa()
    {
        return $this->db->get('des_coa')->result();
    }

    public function get_pelaksana()
    {
        // $this->db->select('a.id_karyawan as id_anggota,a.nama_karyawan as nama_lengkap');
        // $this->db->from('m_karyawan as a');

        return $this->db->get('m_karyawan')->result();
    }

    public function get_jurnal()
    {
        // $date = date('m');
        $date = date('Y-m');
        $this->db->where('status != 4');
        // $this->db->where('EXTRACT(MONTH FROM tgl_buat)='.$date);
        // $this->db->where("to_char(tgl_buat, 'YYYY-MM') = '$date'");
        $this->db->order_by('status', 'asc');
        $this->db->order_by('id_jurnal', 'asc');
        return $this->db->get('jurnal')->result();
    }

    public function get_jurnal_fil($fil)
    {
        // EXTRACT(MONTH FROM tgl_buat) 

        $date = date("Y-m", strtotime($fil));
        $this->db->where('status != 4');
        
        if ($fil != '') {
            $this->db->where("to_char(tgl_buat, 'YYYY-MM') = '$date'");
        }
        
        $this->db->order_by('status', 'asc');
        $this->db->order_by('id_jurnal', 'asc');
        return $this->db->get('jurnal')->result();
    }

    public function save_jurnal($arr)
    {
        $this->db->insert('jurnal', $arr);
    }

    public function get_id_jurnal()
    {
        return $this->db->query('SELECT id_jurnal FROM jurnal order by id_jurnal desc limit 1')->result();
    }

    public function hapus_list_det($id)
    {
        $this->db->where('id_detail_jurnal', $id);
        return $this->db->delete('detail_jurnal');
    }

    public function edit_list_det($id)
    {
        $this->db->select('dj.*,dc.*,m.no_coa_main,h.no_coa_head');
        $this->db->from('detail_jurnal as dj');
        $this->db->join('des_coa as dc', 'dc.no_coa_des = dj.coa');
        $this->db->join('main_coa as m', 'm.no_coa_main = dc.no_coa_main');
        $this->db->join('head_coa as h', 'h.no_coa_head = m.no_coa_head');
        $this->db->where('id_detail_jurnal', $id);
        return $this->db->get()->result();
    }


    public function get_list_form_jurnal($id)
    {
        $this->db->select('detail_jurnal.*,des_coa.deskripsi_coa as deskripsi');
        $this->db->from('detail_jurnal');
        $this->db->join('des_coa', 'des_coa.no_coa_des = detail_jurnal.coa', 'left');
        $this->db->where('id_jurnal', $id);
        return $this->db->get()->result();
    }

    public function save_jd($arr)
    {
        $this->db->query("set DateStyle='DMY' ");
        return $this->db->insert('detail_jurnal', $arr);
    }

    public function post_jurnal($id)
    {
        $data = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot from detail_jurnal where status = '1' AND id_jurnal = ".$id)->result();

        foreach ($data as $var) {
            $arr = array(
                'total_debit'   => $var->debtot,
                'total_kredit'  => $var->kretot,
                'status'        => '1' ,
            );
        }
        $this->db->where('id_jurnal', $id);
        return $this->db->update('jurnal', $arr);
    }

    public function cek_balance($id)
    {
        $j = $this->db->query("select * from detail_jurnal where status = '1' AND id_jurnal=".$id)->num_rows();
        $data = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot from detail_jurnal where id_jurnal = '".$id."' AND status = '1' ")->result();
        foreach ($data as $var) {
                $total_debit= $var->debtot;
                $total_kredit= $var->kretot;

            $balance = $total_kredit - $total_debit;
        }
        if ($balance != 0) {
            return false;
        } elseif ($balance == 0 and $j>0) {
            return true;
        } else {
            return 'blank';
        }
    }

    public function cek_balance_det($id)
    {

        $data = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot from detail_jurnal where id_jurnal = '".$id."'")->result();
        foreach ($data as $var) {
                $total_debit= $var->debtot;
                $total_kredit= $var->kretot;
                $arr = array('total_debit' => $total_debit,
                             'total_kredit' => $total_kredit);
                $balance = $total_kredit - $total_debit;
        }

        if ($balance == 0 and $total_debit > 0 and $total_kredit > 0) {
            $this->db->query("Update jurnal set status ='0' where id_jurnal =".$id);

            $this->db->where('id_jurnal', $id);
            $this->db->update('jurnal', $arr);
            return true;
        } else {
            return false;
        }
    }

    public function detail_jurnal($id)
    {
        $this->db->select('dj.*,dc.*,jurnal.id_jurnal,jurnal.status as status_jurnal');
        $this->db->from('detail_jurnal as dj');
        $this->db->join('jurnal', 'jurnal.id_jurnal = dj.id_jurnal');
        $this->db->join('des_coa as dc ', 'dj.coa = dc.no_coa_des');
        $this->db->where('dj.id_jurnal', $id);
        $this->db->order_by('id_detail_jurnal', 'ASC');
        return $this->db->get()->result();
    }

    public function get_detail_jurnal($id)
    {
        $this->db->select('dj.*,dc.*,jurnal.id_jurnal,jurnal.status as status_jurnal');
        $this->db->from('detail_jurnal as dj');
        $this->db->join('jurnal', 'jurnal.id_jurnal = dj.id_jurnal', 'inner');
        $this->db->join('des_coa as dc ', 'dj.coa = dc.no_coa_des', 'inner');
        $this->db->where('dj.id_jurnal', $id);
        $this->db->order_by('id_detail_jurnal', 'ASC');

        return $this->db->get();
    }

    public function add_buku_besar($id, $query)
    {
        foreach ($query as $var) {

            $periode        = $var->tgl_transaksi;
            $total_debit    = $var->debtot;
            $total_kredit   = $var->kretot;
            $saldo_awal     = $var->saldo_awal;
            $saldo_akhir    = $saldo_awal + ($total_debit - $total_kredit);

            $arr = array(
                    'total_debit'   => $total_debit,
                    'total_kredit'  => $total_kredit,
                    'saldo_akhir'   => $saldo_akhir,
                    'periode'       => $periode,
                    'no_coa_des'    => $var->coa,
                    'id_jurnal'     => $id,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                );

            $this->db->insert('buku_besar', $arr);
        }
    }

    // public function buku_besar($periode = '')
    // {    $per = $periode;
    //  if ($per> 0) {
    //      return $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot,coa,EXTRACT(MONTH FROM dj.add_time),dc.saldo_awal,deskripsi_coa from jurnal as j join detail_jurnal as dj on j.id_jurnal = dj.id_jurnal join des_coa as dc ON dj.coa = dc.no_coa_des  where dj.status='1' AND j.status ='1' AND EXTRACT(MONTH FROM dj.add_time) = '".$per."'  GROUP BY dj.coa,dc.saldo_awal,EXTRACT(MONTH FROM dj.add_time),deskripsi_coa")->result();
    //  }
    //  else{
    //      return $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot,dj.coa,EXTRACT(MONTH FROM dj.add_time),dc.saldo_awal,deskripsi_coa from jurnal as j join detail_jurnal as dj on j.id_jurnal = dj.id_jurnal join des_coa as dc ON dj.coa = dc.no_coa_des  where dj.status='1' AND j.status ='1' AND EXTRACT(MONTH FROM dj.add_time) = EXTRACT(MONTH FROM NOW())  GROUP BY dj.coa,dc.saldo_awal,EXTRACT(MONTH FROM dj.add_time),deskripsi_coa")->result();
    //  }

    // }
    public function buku_besar($periode = '')
    {
        $per = $periode;
        if ($per> 0) {
            return $this->db->query("select sum(bb.total_debit) as debtot,sum(bb.total_kredit) as kretot,bb.no_coa_des,EXTRACT(MONTH FROM periode),dc.saldo_awal,saldo_akhir_lm,deskripsi_coa,jurnal.status from buku_besar as bb join jurnal ON jurnal.id_jurnal = bb.id_jurnal join des_coa as dc ON bb.no_coa_des = dc.no_coa_des LEFT JOIN (SELECT SUM(total_debit) - SUM(total_kredit) as saldo_akhir_lm,no_coa_des as no_des FROM buku_besar as bb WHERE EXTRACT(MONTH FROM periode) < '".$per."' AND EXTRACT(YEAR FROM periode) <= EXTRACT(YEAR FROM NOW()) GROUP BY bb.no_coa_des)result ON no_des = bb.no_coa_des  where jurnal.status = '1' AND EXTRACT(MONTH FROM periode) = '".$per."' AND EXTRACT(YEAR FROM periode) <= EXTRACT(YEAR FROM NOW())   GROUP BY bb.no_coa_des,dc.saldo_awal,EXTRACT(MONTH FROM periode),deskripsi_coa,jurnal.status,saldo_akhir_lm")->result();
        } else {
            return $this->db->query("select sum(bb.total_debit) as debtot,sum(bb.total_kredit) as kretot,saldo_akhir_lm,bb.no_coa_des,EXTRACT(MONTH FROM periode),dc.saldo_awal,deskripsi_coa from buku_besar as bb join jurnal ON jurnal.id_jurnal = bb.id_jurnal join des_coa as dc ON bb.no_coa_des = dc.no_coa_des LEFT JOIN (SELECT SUM(total_debit) - SUM(total_kredit) as saldo_akhir_lm,no_coa_des as no_des FROM buku_besar as bb WHERE EXTRACT(MONTH FROM periode) < EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM periode) <= EXTRACT(YEAR FROM NOW()) GROUP BY bb.no_coa_des)result ON no_des = bb.no_coa_des  where EXTRACT(MONTH FROM periode) = EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM periode) = EXTRACT(YEAR FROM NOW()) GROUP BY bb.no_coa_des,dc.saldo_awal,EXTRACT(MONTH FROM periode),deskripsi_coa,saldo_akhir_lm")->result();
        }
    }

    public function get_saw_bb()
    {
    }

    public function update_j($id, $arr)
    {
        $this->db->where('id_detail_jurnal', $id);
        return $this->db->update('detail_jurnal', $arr);
    }

    public function get_history_jurnal($id)
    {
        $this->db->select('id_detail_jurnal,id_jurnal,keterangan,tgl_transaksi,debit,pelaksana,id_group,deskripsi_coa,coa');
        $this->db->from('detail_jurnal');
        $this->db->join('des_coa', 'des_coa.no_coa_des = detail_jurnal.coa');
        $this->db->where('id_jurnal', $id);
        $this->db->where('debit !=', null);

        return $this->db->get()->result();
    }

    public function get_history_jurnalk($id)
    {
        $this->db->select('id_detail_jurnal,id_jurnal,keterangan,tgl_transaksi,kredit,pelaksana,id_group,deskripsi_coa,coa');
        $this->db->from('detail_jurnal');
        $this->db->join('des_coa', 'des_coa.no_coa_des = detail_jurnal.coa');
        $this->db->where('id_jurnal', $id);
        $this->db->where('kredit !=', null);

        return $this->db->get()->result();
    }

    public function get_aktiva_lancar()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'AKTIVA LANCAR');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();
    }

    public function aktiva_lancar_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'AKTIVA LANCAR');
        $this->db->where('jurnal.status', "1");

        return $this->db->get()->result();
    }

    public function get_aktiva_tetap()
    {
        $this->db->select('dj.coa,SUM(debit) as deb,SUM(kredit) as kre,deskripsi_coa,des_coa.saldo_awal + SUM(debit) - SUM(kredit) as saldo_akhir');
        $this->db->from('detail_jurnal as dj');
        $this->db->join('des_coa', 'dj.coa = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'AKTIVA TETAP');
        $this->db->group_by('dj.coa,des_coa.deskripsi_coa,des_coa.saldo_awal');

        return $this->db->get()->result();
    }

    public function aktiva_tetap_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'AKTIVA TETAP');
        $this->db->where('jurnal.status', "1");


        return $this->db->get()->result();
    }

    public function get_pendapatan()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'PENDAPATAN');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();

        return $this->db->get()->result();
    }

    public function pendapatan_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'PENDAPATAN');
        $this->db->where('jurnal.status', "1");


        return $this->db->get()->result();
    }

    public function get_pendapatan_lain()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'PENDAPATAN LAIN-LAIN');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();

        return $this->db->get()->result();
    }

    public function pendapatan_lain_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'PENDAPATAN LAIN-LAIN');
        $this->db->where('jurnal.status', "1");


        return $this->db->get()->result();
    }


    public function get_biaya()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'BIAYA');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();

        return $this->db->get()->result();
    }

    public function biaya_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'BIAYA');
        $this->db->where('jurnal.status', "1");


        return $this->db->get()->result();
    }

    public function get_hutang()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'HUTANG');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();
    }

    public function hutang_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'HUTANG');
        $this->db->where('jurnal.status', "1");

        return $this->db->get()->result();
    }

    public function get_modal()
    {
        $this->db->select('bb.no_coa_des as coa,deskripsi_coa,SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'MODAL');
        $this->db->where('jurnal.status', "1");
        $this->db->group_by('bb.no_coa_des,des_coa.deskripsi_coa');

        return $this->db->get()->result();
    }

    public function modal_total()
    {
        $this->db->select('SUM(saldo_akhir) as saldo_akhir');
        $this->db->from('buku_besar as bb');
        $this->db->join('jurnal', 'jurnal.id_jurnal = bb.id_jurnal');
        $this->db->join('des_coa', 'bb.no_coa_des = des_coa.no_coa_des');
        $this->db->join('main_coa', 'des_coa.no_coa_main = main_coa.no_coa_main');
        $this->db->join('head_coa', 'main_coa.no_coa_head = head_coa.no_coa_head');
        $this->db->where('head_coa', 'MODAL');
        $this->db->where('jurnal.status', "1");

        return $this->db->get()->result();
    }

    public function hapus_jurnal($id)
    {
        $this->db->query('DELETE FROM jurnal WHERE id_jurnal ='.$id);
        $this->db->query('DELETE FROM detail_jurnal WHERE id_jurnal ='.$id);
    }

    public function uc_status($id = '')
    {
        $this->db->where('id_detail_jurnal', $id);
        $this->db->update('detail_jurnal', array('status'=>"0"));

        return $this->db->get('detail_jurnal')->result();
    }

    public function c_status($id = '')
    {
        $this->db->where('id_detail_jurnal', $id);
        $this->db->update('detail_jurnal', array('status'=>"1"));

        return $this->db->get('detail_jurnal')->result();
    }

    public function u_j_perbaikan($id, $arr)
    {
        $this->db->where('id_jurnal', $id);
        return $this->db->update('jurnal', $arr);
    }

    public function s_jurnal_err($id, $arr)
    {
        $this->db->where('id_jurnal', $id);
        return $this->db->update('jurnal', $arr);
    }

    public function get_detail_bb($coa)
    {
        $this->db->join('des_coa', 'detail_jurnal.coa = des_coa.no_coa_des');
        $this->db->join('group', 'group.id_group = detail_jurnal.id_group', 'left');
        $this->db->where('status', '1');
        $this->db->where('coa', $coa);
        $this->db->where('EXTRACT(MONTH FROM tgl_transaksi) = EXTRACT(MONTH FROM NOW())');
        return $this->db->get('detail_jurnal')->result();
    }
    public function get_detail_bb_ex($coa, $group)
    {
        $this->db->join('des_coa', 'detail_jurnal.coa = des_coa.no_coa_des');
        $this->db->join('group', 'group.id_group = detail_jurnal.id_group', 'left');
        $this->db->where('status', '1');
        $this->db->where('coa', $coa);
        $this->db->where('group', $group);
        $this->db->where('EXTRACT(MONTH FROM tgl_transaksi) = EXTRACT(MONTH FROM NOW())');
        return $this->db->get('detail_jurnal')->result();
    }

    public function get_saldo_awal($coa)
    {
        $data = $this->db->query("SELECT SUM(saldo_akhir) as saldo_akhir FROM buku_besar where no_coa_des ='".$coa."' AND EXTRACT(MONTH FROM periode) < EXTRACT(MONTH FROM NOW()) AND EXTRACT(YEAR FROM periode) <= EXTRACT(YEAR FROM NOW()) ")->row();
        $sa = $data->saldo_akhir;
        $query = $this->db->get_where('des_coa', array('no_coa_des' => $coa))->row();
        $sac = $query->saldo_awal;
        $saldo_awal = $sa + $sac;

        return $saldo_awal;
    }

    public function get_saldo_akhir($coa)
    {
        $n = $this->db->query("SELECT SUM(total_debit) - SUM(total_kredit) as saldo_akhir FROM buku_besar where no_coa_des ='".$coa."' AND EXTRACT(MONTH FROM periode) = EXTRACT(MONTH FROM NOW()) ")->row();
        $saldo_akhir = $n->saldo_akhir;
        return $saldo_akhir;
    }

    public function get_des_coa($coa)
    {
        $this->db->join('detail_jurnal as dj', 'dj.coa = des_coa.no_coa_des', 'left');
        $this->db->join('group as g', 'g.id_group = dj.id_group', 'left');
        $this->db->where('no_coa_des', $coa);
        return $this->db->get('des_coa', 1)->row();
    }

    public function delete_blank_jurnal()
    {
        $this->db->where('status', "4");
        $this->db->delete('jurnal');
    }
    
    // public function u_total($id)
    // {
    //  $data = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot from detail_jurnal where status  IS NULL AND id_jurnal = ".$id)->result();
    //  foreach ($data as $var) {
    //      $arr = array(
    //          'total_debit'=> $var->debtot,
    //          'total_kredit'=> $var->kretot,
    //      );

    //  }
    //  $this->db->where('id_jurnal', $id);
    //  return $this->db->update('jurnal', $arr);

    // }

}

/* End of file  */
/* Location: ./application/models/ */