<style>
    .sel2 .parsley-errors-list.filled {
    margin-top: 42px;
    margin-bottom: -60px;
    }

    .sel2 .parsley-errors-list:not(.filled) {
    display: none;
    }

    .sel2 .parsley-errors-list.filled + span.select2 {
    margin-bottom: 30px;
    }

    .sel2 .parsley-errors-list.filled + span.select2 span.select2-selection--single {
        background: #FAEDEC !important;
        border: 1px solid #E85445;
    }
    .table-responsive {
        display: table;
    }
</style>
<style>
    .select2-container .select2-results__option.optInvisible {
        display: none;
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <?php echo bredcumx(); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_pengguna_ptg"><i class="fas fa-plus mr-2"></i>Tambah Data</button>
        </div>
        <div class="card-body">
          <table id="tabel_pengguna_ptg" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-light text-center">
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Induk Kumpulan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_pengguna_ptg" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_pengguna_ptg" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_pengguna_tertanggung" id="id_pengguna_tertanggung">
            <input type="hidden" name="aksi" id="aksi" value="tambah">
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">NIK<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control numeric" id="nik" name="nik" required data-parsley-required-message="NIK harus terisi." placeholder="Masukkan NIK">
                                        <span id="nik_error" class="text-danger"></span>
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Nama<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control" id="nama" name="nama" required data-parsley-required-message="Nama harus terisi." placeholder="Masukkan Nama">
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Tempat Lahir<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required data-parsley-required-message="Tempat lahir harus terisi." placeholder="Masukkan Tempat Lahir">
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Tanggal Lahir<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" required data-parsley-required-message="Tanggal lahir harus terisi." placeholder="Masukkan Tanggal Lahir">
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Jenis Kelamin<b style="color:red;">*</b></label>
                                    <div class="">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_1" value="1" checked>
                                            <label class="custom-control-label" for="jenis_kelamin_1">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_2" value="0">
                                            <label class="custom-control-label" for="jenis_kelamin_2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Telepon<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control numeric" id="telp" name="telp" required data-parsley-required-message="Telepon harus terisi." placeholder="Masukkan Telepon">
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Alamat<b style="color:red;">*</b></label>
                                    <div class="">
                                        <textarea name="alamat" id="alamat" rows="5" class="form-control" required data-parsley-required-message="Alamat harus terisi." placeholder="Masukkan alamat"></textarea>
                                    </div>
                                </div>  
                                <div class="form-group  sel2">
                                    <label for="tgl_awal" class=" col-form-label">Pekerjaan<b style="color:red;">*</b></label>
                                    <div class="">
                                        <select name="pekerjaan" id="pekerjaan" class="select2" required data-parsley-required-message="Pekerjaan harus terisi.">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pekerjaan as $pk): ?>
                                                <option value="<?= $pk['id_pekerjaan'] ?>"><?= $pk['pekerjaan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label for="tgl_awal" class=" col-form-label">Email<b style="color:red;">*</b></label>
                                    <div class="">
                                        <input type="text" class="form-control" id="email" name="email" required data-parsley-required-message="Email harus terisi." placeholder="Masukkan Email">
                                        <span id="email_error" class="text-danger"></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6>Induk Kumpulan</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group sel2">
                                    <label>Pilih Jenis Client Tertanggung<b style="color:red;">*</b></label>
                                    <select class="form-control select2" name="jenis_client_ttg" id="jenis_client_ttg" onchange="setupclient_ttg(this.value)" required data-parsley-required-message="Jenis Client Tertanggung Harus Terisi.">
                                        <!-- <option value="">Pilih</option>
                                        <option value="3">Agent</option>
                                        <option value="5">Business Partner</option>
                                        <option value="4">Direct</option>
                                        <option value="1">Insurer</option>
                                        <option value="2">Insured</option>
                                        <option value="6">Loss Adjuster</option> -->
                                        <?= $option_cdb_ttg ?>
                                    </select>
                                </div>
                                <div class="form-group sel2">
                                    <label>Pilih Tertanggung<b style="color:red;">*</b></label>
                                    <select name="pil_tertanggung" id="pil_tertanggung" class="form-control select2" onchange="setupclient_jenis_client_ik($('#jenis_client_ttg').val(), this.value)" required data-parsley-required-message="Tertanggung Harus Terisi.">
                                    <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group sel2">
                                    <label>Pilih Jenis Client Induk Kumpulan<b style="color:red;">*</b></label>
                                    <select class="form-control select2" name="jenis_client_ik" id="jenis_client_ik" onchange="setupclient_ik($('#jenis_client_ttg').val(), $('#pil_tertanggung').val(), this.value)" required data-parsley-required-message="Jenis Induk Kumpulan Harus Terisi.">
                                        <option value="">Pilih</option>
                                        <!-- <option value="3">Agent</option>
                                        <option value="5">Business Partner</option>
                                        <option value="4">Direct</option>
                                        <option value="1">Insurer</option>
                                        <option value="2">Insured</option>
                                        <option value="6">Loss Adjuster</option> -->
                                    </select>
                                </div>
                                <div class="form-group sel2">
                                    <label>Pilih Induk Kumpulan<b style="color:red;">*</b></label>
                                    <select name="pil_induk_kumpulan" id="pil_induk_kumpulan" class="form-control select2" required data-parsley-required-message="Jenis Client Induk Kumpulan Harus Terisi.">
                                    <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
            </div>

            <input type="hidden" id="status_nik">
            <input type="hidden" id="status_email">

            <input type="hidden" id="ft_tertanggung_edit">
            <input type="hidden" id="tertanggung_edit">
            <input type="hidden" id="ft_induk_kumpulan_edit">
            <input type="hidden" id="induk_kumpulan_edit">

            <input type="hidden" name="id_induk_kumpulan" id="id_induk_kumpulan">

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="simpan_form">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
            
        </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="" autocomplete="off" class="form-control-line">
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">NIK</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_nik">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Nama</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_nama">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Tempat Lahir</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_tempat_lahir">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Tanggal Lahir</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_tgl_lahir">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_jenis_kelamin">: </span>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Telepon</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_telp">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Alamat</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_alamat">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Pekerjaan</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_pekerjaan">: </span>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label for="tgl_awal" class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_email">: </span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6>Induk Kumpulan</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Jenis Client Tertanggung</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_ft_tertanggung">: </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Tertanggung</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_tertanggung">: </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Jenis Client Induk Kumpulan</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_ft_induk_kumpulan">: </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Induk Kumpulan</label>
                                    <div class="col-md-8 mt-2">
                                        <span id="t_induk_kumpulan">: </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>

            
        </form>
    </div>
  </div>
</div>

<!-- 03-11-2021 -->
<script>
    $(document).ready(function () {

        var tabel_pengguna_ptg = $('#tabel_pengguna_ptg').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>pengguna_tertanggung/tampil_data",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,5,6],
                "orderable" : false
            }, {
                'targets'   : [0,6],
                'className' : 'text-center',
            }]
        })

        $('#nik').keyup( function(e){
            var max_chars = 16;
            var status  = "";

            if ($(this).val() == '') {
                $('#nik_error').text("");
                $('#simpan_form').attr('disabled', false);
                status = "";
                return false;
            }

            if ($(this).val().length >= max_chars) { 
                $(this).val($(this).val().substr(0, max_chars));
                $('#nik_error').text("");
                $('#simpan_form').attr('disabled', false);
                status = 0;
            } else {
                $('#nik_error').text("Jumlah NIK harus 16 angka");
                $('#simpan_form').attr('disabled', true);
                status = 1;
            }

            $('#status_nik').val(status);

            var email = $('#status_email').val();

            if ((email == 0 && status == 0) || status == "") {
                $('#simpan_form').attr('disabled', false);
            } else {
                $('#simpan_form').attr('disabled', true);
            }

        });

        function validateEmail(email) {
            
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            if (email == '') {
                return false;
            } else {
                return (!emailReg.test( email ) ? false : true);
            }

        }

        $('#email').on('keyup', function () {

            var email   = $(this).val();
            var status  = "";

            if (email == '') {
                $('#email_error').text("");
                $('#simpan_form').attr('disabled', false);
                status = "";
            } else {
                if (validateEmail(email)) {
                    $('#simpan_form').attr('disabled', false);
                    status = 0;
                } else {
                    $('#simpan_form').attr('disabled', true);
                    status = 1;
                }
                $('#email_error').text(validateEmail(email) ? "" : "Isi email dengan format yang benar!" );
            }

            $('#status_email').val(status);

            var nik = $('#status_nik').val();

            if ((nik == 0 && status == 0) || status == "") {
                $('#simpan_form').attr('disabled', false);
            } else {
                $('#simpan_form').attr('disabled', true);
            }

        })

        $('#tambah_pengguna_ptg').on('click', function () {

            reset_form();
            $('#modal_pengguna_ptg').modal('show');
            
        })

        $('#form_pengguna_ptg').parsley();

        $("#pekerjaan").change(function() {
            $(this).trigger('input')
        });
        $("#tgl_lahir").change(function() {
            $(this).trigger('input')
        });

        $("#jenis_client_ttg").change(function() {
            $(this).trigger('input')
        });
        $("#pil_tertanggung").change(function() {
            $(this).trigger('input')
        });
        $("#jenis_client_ik").change(function() {
            $(this).trigger('input')
        });
        $("#pil_induk_kumpulan").change(function() {
            $(this).trigger('input')
        });

        function reset_form() {
            $('#form_pengguna_ptg').trigger("reset");
            $('#aksi').val('tambah');
            $('#id_pengguna_ptg').val('');
            $("#form_pengguna_ptg").parsley().reset();
            $("#pekerjaan").val('').trigger('change');
            $("#jenis_kelamin_1").prop("checked", true);

            $('#jenis_client_ttg').val('').trigger('change');
            $('#pil_tertanggung').val('').trigger('change');
            $('#jenis_client_ik').val('').trigger('change');
            $('#pil_induk_kumpulan').val('').trigger('change');

            $('#nik_error').text('');
            $('#email_error').text('');

            $('#simpan_form').attr('disabled', false);
            
            $('#judul_modal').text('Tambah Data');
        }
        
        $('#form_pengguna_ptg').on('submit', function () {

            var form = $('#form_pengguna_ptg').serialize();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    
                    $.ajax({
                        url         : "<?= base_url() ?>pengguna_tertanggung/simpan_data",
                        type      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data        : form,
                        dataType    : "JSON",
                        success     : function (data) {

                            if (data.status == 'gagal') {

                            swal({
                                title               : "Peringatan",
                                text                : 'NIK yang diinput sudah ada, harap ganti!',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'warning',
                                showConfirmButton   : true,
                                allowOutsideClick   : false
                            });

                            return false;
                            
                            }

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            $('#modal_pengguna_ptg').modal('hide');

                            reset_form();
                            tabel_pengguna_ptg.ajax.reload(null,false);   
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Simpan data tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })

                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;


        })

        // 04-11-2021
        $('#tabel_pengguna_ptg').on('click', '.edit', function () {
            
            var id_pengguna_ptg = $(this).data('id');
            
            $.ajax({
                url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_data_pengguna_ptg/",
                type        :"POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        },
                        allowOutsideClick   : false
                    })
                },
                data        : {id_pengguna_ptg:id_pengguna_ptg},
                dataType    : "JSON",
                success     : function (data) {
                    swal.close();
                    var jk = "";
                    var jenis_k = "";

                    if (data.list.jenis_kelamin == 't') {
                        jk      = 1;
                        jenis_k = "Laki-laki";
                    } else {
                        jk      = 0;
                        jenis_k = "Perempuan";
                    }

                    $('#aksi').val('ubah');
                    $('#id_pengguna_tertanggung').val(data.list.id_pengguna_ptg);
                    $('#judul_modal').text('Ubah Data');
                    $('#nik').val(data.list.nik);
                    $('#nama').val(data.list.nama);
                    $('#tempat_lahir').val(data.list.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#jenis_kelamin').val(data.list.jenis_kelamin);
                    $("input[name=jenis_kelamin][value='"+jk+"']").prop("checked",true);
                    $('#telp').val(data.list.telp);
                    $('#alamat').val(data.list.alamat);
                    $('#pekerjaan').val(data.list.id_pekerjaan).trigger('change');
                    $('#email').val(data.list.email);
                    $('#jenis_client_ttg_edit').val(data.list.ft_tertanggung);
                    // $('#tertanggung_edit').val(data.list.tertanggung);
                    $('#ft_tertanggung_edit').val(data.list.ft_tertanggung);
                    $('#tertanggung_edit').val(data.list.tertanggung);
                    $('#ft_induk_kumpulan_edit').val(data.list.ft_induk_kumpulan);
                    $('#induk_kumpulan_edit').val(data.list.induk_kumpulan);

                    $('#id_induk_kumpulan').val(data.list.id);

                    $('#jenis_client_ttg').val(data.list.ft_tertanggung).trigger('change');

                    // $('#pil_tertanggung').val(data.list.tertanggung).trigger('change');
                    // $('#jenis_client_ik').val(data.list.ft_induk_kumpulan).trigger('change');
                    // $('#pil_induk_kumpulan').val(data.list.induk_kumpulan).trigger('change');

                    
                    // setupclient_ttg(data.list.ft_tertanggung, data.list.tertanggung);
                    // setupclient_jenis_client_ik(data.list.tertanggung, data.list.ft_induk_kumpulan);
                    // setupclient_ik(data.list.ft_induk_kumpulan, data.list.induk_kumpulan);

                    $('#modal_pengguna_ptg').modal('show');
                    
                }
            });
            
        })

        // 05-11-2021
        $('#tabel_pengguna_ptg').on('click', '.detail', function () {

            var id_pengguna_ptg = $(this).data('id');
            
            $.ajax({
                url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_data_pengguna_ptg/",
                type        :"POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        },
                        allowOutsideClick   : false
                    })
                },
                data        : {id_pengguna_ptg:id_pengguna_ptg},
                dataType    : "JSON",
                success     : function (data) {
                    swal.close();
                    var jenis_k = "";

                    if (data.list.jenis_kelamin == 't') {
                        jenis_k = "Laki-laki";
                    } else {
                        jenis_k = "Perempuan";
                    }

                    $('#t_nik').text(": "+data.list.nik);
                    $('#t_nama').text(": "+data.list.nama);
                    $('#t_tempat_lahir').text(": "+data.list.tempat_lahir);
                    $('#t_tgl_lahir').text(": "+data.tgl_lahir);
                    $('#t_jenis_kelamin').text(": "+jenis_k);
                    $('#t_telp').text(": "+data.list.telp);
                    $('#t_alamat').text(": "+data.list.alamat);
                    $('#t_pekerjaan').text(": "+data.list.pekerjaan);
                    $('#t_email').text(": "+data.list.email);
                    $('#t_ft_tertanggung').text(": "+data.ft_tertanggung);
                    $('#t_tertanggung').text(": "+data.tertanggung);
                    $('#t_ft_induk_kumpulan').text(": "+data.ft_induk_kumpulan);
                    $('#t_induk_kumpulan').text(": "+data.induk_kumpulan);

                    $('#modal_detail').modal('show');
                    
                }
            });

        });

        // 05-11-2021
        $('#pil_induk_kumpulan').on('change', function () {

            var id_induk_kumpulan = $('option:selected', this).attr('induk_kumpulan');

            $('#id_induk_kumpulan').val(id_induk_kumpulan);
            
        })

        // 04-11-2021
        $('#tabel_pengguna_ptg').on('click', '.hapus', function () {

            var id_pengguna_tertanggung  = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>pengguna_tertanggung/simpan_data",
                        type      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data        : {aksi:'hapus', id_pengguna_tertanggung:id_pengguna_tertanggung},
                        dataType    : "JSON",
                        success     : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            tabel_pengguna_ptg.ajax.reload(null,false);   
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Hapus data tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();
                }
            })

            return false;

        })
    })

    //jika Tertanggung
    function setupclient_ttg(ft_tertanggung) {
        $('#pil_tertanggung').empty();

        // $('#jenis_client_ttg_edit').val(ft_tertanggung);
        // var idk = $('#tertanggung_edit').val();

        var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
        var tertanggung_edit        = $('#tertanggung_edit').val();
        var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
        var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
        
        if (ft_tertanggung != '') {
            $.ajax({
                type        :"POST",
                url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_tertanggung/",
                data        : {ft_tertanggung:ft_tertanggung},
                dataType    : "JSON",
                success     : function (data) {
                $('#pil_tertanggung').empty();
                $('#jenis_client_ik').empty();
                $('#pil_induk_kumpulan').empty();
                $('#jenis_client_ik').html("<option value=''>Pilih</option>");
                $('#pil_induk_kumpulan').html("<option value=''>Pilih</option>");
                
                //   var hss = JSON.parse(data); 
                //   var newOption = '<option value="">Pilih</option>';
                //   for (var i = 0; i < hss.length; i++) {
                //     if (hss[i].id == idk) {
                //       newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
                //     } else {
                //       newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
                //     }
                //   }
                // console.log(data.option_ttg);
                $('#pil_tertanggung').html(data.option_ttg);

                $('#pil_tertanggung').val(tertanggung_edit).trigger('change');

                // $("#pil_tertanggung").select2("val", data.idk);
                }
            });
        } else {
            $('#pil_tertanggung').append("<option value=''>Pilih</option>").trigger('change');
        }
    }

    // pilih flag table induk kumpulan
    function setupclient_jenis_client_ik(ft_tertanggung, tertanggung) {
        $('#jenis_client_ik').empty();

        // var jenis_client_ttg = $('#jenis_client_ttg_edit').val();

        var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
        var tertanggung_edit        = $('#tertanggung_edit').val();
        var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
        var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
        
        if (tertanggung != '') {
            $.ajax({
                type        :"POST",
                url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_client_ik/",
                data        : {ft_tertanggung:ft_tertanggung, tertanggung:tertanggung},
                dataType    : "JSON",
                success     : function (data) {
                    // console.log(data.option_cdb_ik);
                    $('#jenis_client_ik').empty();
                    $('#pil_induk_kumpulan').html("<option value=''>Pilih</option>");
                    $('#jenis_client_ik').html(data.option_cdb_ik);
                    $('#jenis_client_ik').val(ft_induk_kumpulan_edit).trigger('change');
                }
            });
        } else {
            $('#jenis_client_ik').append("<option value=''>Pilih</option>").trigger('change');
        }
    }

    //jika Induk Kumpulan
    function setupclient_ik(ft_tertanggung, tertanggung, ft_induk_kumpulan) {
        $('#pil_induk_kumpulan').empty();

        var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
        var tertanggung_edit        = $('#tertanggung_edit').val();
        var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
        var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
        
        if (ft_induk_kumpulan != '') {
        $.ajax({
            type        :"POST",
            url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_tertanggung_ik/",
            data        : {ft_tertanggung:ft_tertanggung, tertanggung:tertanggung, ft_induk_kumpulan:ft_induk_kumpulan},
            dataType    : "JSON",
            success  : function (data) {
            //   $('#pilkarya').empty();
            //   var hss = JSON.parse(data); var newOption = '<option value="">Pilih</option>';
            //   for (var i = 0; i < hss.length; i++) {
            //     if (hss[i].id == idk) {
            //       newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
            //     } else {
            //       newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
            //     }
            //   }
            $('#pil_induk_kumpulan').html(data.option_ttg_ik);
            $('#pil_induk_kumpulan').val(induk_kumpulan_edit).trigger('change');
            }
        });
        } else {
        $('#pil_induk_kumpulan').append("<option value=''>Pilih</option>").trigger('change');
        }
    }
    
</script>