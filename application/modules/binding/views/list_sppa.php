<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item"><a href="<?= base_url('binding/lihat/dekl') ?>">Binding Slip</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('binding/detail_binding/').$id_mop ?>">Detail Binding</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url("binding/detail_binding/$id_mop") ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                </div>
                <div class="card-body card_awal">

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h5>No Polis Induk : <samp><mark> <?= $mop['no_polis_induk'] ?> </mark></samp></h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5>Nama MOP : <samp><mark> <?= $mop['nama_mop'] ?> </mark></samp></h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5>Nomor Dokumen : <samp><mark> <?= $mop['no_mop'] ?> </mark></samp></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 table-responsive mt-3">
                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_sppa" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>No SPPA</th>
                                        <th>Client [SOB - CDB]</th>
                                        <th>COB - LOB</th>
                                        <th>Status Aktif</th>
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
        </div>
        
    </div>
</div>

<script>

    $(document).ready(function () {

        var tabel_list_sppa = $('#tabel_list_sppa').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_data_binding_detail_dek",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = "<?= $id_mop ?>";
                    data.nm_endors  = "<?= $nm_endors ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }]
        })

        // 17-05-2021
        $('#tabel_list_sppa').on('click', '.detail', function () {

            var value       = $(this).data('id');
            var nm_endors   = "<?= $nm_endors ?>";

            location.href = "<?= base_url('binding/detail_sppa/') ?>"+value+"/"+nm_endors;

        })

        // 08-07-2021
        $('#tabel_list_sppa').on('click', '.list', function () {

            var value       = $(this).data('id');
            var nm_endors   = "<?= $nm_endors ?>";

            location.href   = "<?= base_url('binding/list_endors/') ?>"+value+"/"+nm_endors;

        })

        // 19-07-2021
        $('#tabel_list_sppa').on('click', '.endors', function () {

            var id_sppa     = $(this).data('id');
            var nm_endors   = "<?= $nm_endors ?>";

            location.href   = "<?= base_url('binding/endorsment/') ?>"+id_sppa+"/"+nm_endors;

        })
        
    })
    
</script>