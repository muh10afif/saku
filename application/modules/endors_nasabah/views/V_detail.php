<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-5">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-7">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item"><a href="<?= base_url('endors_nasabah') ?>">Endorsment</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="card shadow ">
            <div class="card-header">
                <a href="<?= base_url('endors_nasabah') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_endors" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Nasabah</th>
                            <th width="20%">Tanggal Endors</th>
                            <th width="20%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Nasabah <?= $nama ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Endorsment</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_endorsment">: </span>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">NIK</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nik">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Nama Nasabah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nama_nasabah">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Tanggal Lahir</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_tgl_lahir">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Telp</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_telp">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Email</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_email">: </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Alamat Rumah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_alamat">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Jenis Kelamin</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_jenis_kelamin">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Tempat Lahir</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_tempat_lahir">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Pekerjaan</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_pekerjaan">: </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 alasan_tolak" style="display: none;">
                    
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Alasan Tolak</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_alasan_tolak">: </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        
        var tabel_list_endors = $('#tabel_list_endors').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>endors_nasabah/tampil_list_endors",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                    data.id_nasabah         = "<?= $id_nasabah ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }]
        })

        // 14-09-2021
        $('#tabel_list_endors').on('click', '.detail', function () {

            var id_tr_endorsment    = $(this).data('id'); 
            var id_endors_nasabah   = $(this).attr('id_endors_nasabah'); 
            var nama_endorsment     = $(this).attr('nama_endorsment');

            $.ajax({
                url     : "<?= base_url('endors_nasabah/get_endors_nasabah/') ?>",
                type    : "POST",
                data    : {id_endors_nasabah:id_endors_nasabah, id_tr_endorsment:id_tr_endorsment},
                dataType: "JSON",
                success : function (data) {

                    $('#t_endorsment').text(": "+nama_endorsment);
                    $('#t_nik').text(": "+data.list.nik);
                    $('#t_nama_nasabah').text(": "+data.list.nama_nasabah);
                    $('#t_tgl_lahir').text(": "+data.tgl_lahir);
                    $('#t_telp').text(": "+data.list.telp);
                    $('#t_email').text(": "+data.list.email);

                    if (data.endors.status == 2) {
                        $('.alasan_tolak').slideDown('fast');
                        $('#t_alasan_tolak').text(": "+data.endors.alasan_tolak);
                    } else {
                        $('.alasan_tolak').slideUp('fast');
                    }

                    var jk = "";
                    if (data.list.jenis_kelamin == 't') {
                        jk = 'Laki-laki';
                    } else {
                        jk = 'Perempuan';
                    }

                    $('#t_alamat').text(": "+data.list.alamat_rumah);
                    $('#t_jenis_kelamin').text(": "+jk);
                    $('#t_tempat_lahir').text(": "+data.list.tempat_lahir);
                    $('#t_pekerjaan').text(": "+data.pekerjaan);

                    $('#modal_detail').modal('show');
                    
                },
                error       : function(xhr, status, error) {

                    swal({
                        title               : 'Gagal',
                        text                : 'Gagal menampilkan data!',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000
                    }); 

                    return false;

                }
            })
            
        })
        
    })
</script>