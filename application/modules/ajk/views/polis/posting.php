<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md-12 f_detail" style="display: none;">
    <?php $this->load->view('ajk/polis/detail'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_tutup">
        
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('ajk/polis/tambah_posting') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-plus mr-2"></i>Tambah Data</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-view-headline mr-1"></i>List</h5>
            </div>
            <div class="card-body">
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_posting" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Polis</th>
                            <th>Nama Nasabah</th>
                            <th>Cabang</th>
                            <th>Produk</th>
                            <th>Premi</th>
                            <th>Alokasi Asuransi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td>1.</td>
                            <td>PLS1292</td>
                            <td>Ahmad</td>
                            <td>Cabang</td>
                            <td>Produk</td>
                            <td>500.000</td>
                            <td>Askrida</td>
                            <td align="center"><a href="<?= base_url('ajk/polis/detail/1') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
//16-Juni-2021 RFA
var tabel_posting;

$(document).ready(function(){
tabel_posting = $('#tabel_posting').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "<?php echo base_url(); ?>ajk/polis/ajaxdataposting",
            "type" : "POST",
            "data" : function(data){
                data.id_cabang_bank = $('#nama_cabang_bank').val();
			    data.nama_nasabah = $('#nama_nasabah').val();
			    data.no_polis = $('#no_polis').val();
			    data.tgl_mulai = $('#tgl_mulai').val();
            }
        },
        "columnDefs" : [{
            "targets" : [0,3],
            "orderable" : false
        },{
            'targets' : [0,3],
            'className' : 'text-center',
        }],
        "scrollX" : true
        });

        $('#verif').click(function(){
            if ($(this).is(':checked')){
                $('.check').attr('checked',true);
            } else {
                $('.check').attr('checked',false);
            }
        });

        
        $('#verifikasi').click(function(){
            var data_verifikasi = [];
            $('.check').each(function(k,obj){
                if (obj.checked){
                    data_verifikasi.push(obj.value);
                }
            });

            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>ajk/polis/verifikasi",
                dataType:"json",
                data:{
                    ver:data_verifikasi
                },
                success  : function (data) {
                swal({
                title             : "Berhasil",
                text              : "Data Telah Di Verifikasi",
                type              : 'success',
                showConfirmButton : false,
                timer             : 1000
                });
                table_jenis.ajax.reload();
                return true;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal({
                title             : "Peringatan",
                text              : "Koneksi Tidak Terhubung",
                type              : 'warning',
                showConfirmButton : false,
                timer             : 1000
                });
                return false;
            },
            });
        });

});


function detailposting(id) {
            // window.scrollTo(0, 0);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/polis/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_detail').slideDown();
                    $('.f_ubah').slideUp();
                    $(".f_tutup").slideUp();
                    // $('#judul').text('Form Ubah Data');
                    var hss = JSON.parse(data);
    
                    $('.id_polis').val(hss[0]['id_polis']);
                    $('.idpls').html(hss[0]['id_polis']);
                    $('.idcabngbank').html(hss[0]['id_cabang_bank']).trigger('change');
                    $('.idnasabah').html(hss[0]['id_nasabah']).trigger('change');
                    $('.lamabulan').html(hss[0]['lama_bulan']).trigger('change');
                    $('.label').html(hss[0]['label']).trigger('change');
                    $('.ratepremi').html(hss[0]['rate_premi']);
                    $('.alokasi').html(hss[0]['nama_asuransi']);
                    $('.nilaibiaya').html(hss[0]['nilai_pembiayaan']);
                    $('.alamatrumah').html(hss[0]['alamat_rumah']);
                    $('.nilaipembiayaan').html(hss[0]['nilai_pembiayaan']);
                    $('.tglmulai').html(hss[0]['tgl_mulai']);
                    $('.premis').html(hss[0]['premi']);
                    $('.premifax').html(hss[0]['premi_fax']);
                    $('.premirekkoran').html(hss[0]['premi_rek_koran']);
                    $('.namanasabah').html(hss[0]['nama_nasabah']);
                    $('.tgllahir').html(hss[0]['tgl_lahir']);
                    $('.tempatdinas').html(hss[0]['tempat_dinas']);
                    $('.namacabangbank').html(hss[0]['nama_cabang_bank']);
    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({
                        title: "Peringatan",
                        text: "Koneksi Tidak Terhubung",
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    
                    return false;
                }
            });
        }
</script>
