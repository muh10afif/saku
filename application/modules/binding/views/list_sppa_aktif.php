<style>

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #006c45;
        background-color: #006c45;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #006c45;
        border-color: #006c45 #006c45 #006c45;
    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
        border-color: #006c45 #006c45 #006c45;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #006c45;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #006c45;
    }
    .nav-tabs {
        border-bottom: 3px solid #006c45;
    }
    .tab-pane.active {
        animation: slide-down 0.2s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

</style>
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
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('binding/lihat/dekl') ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>

            <div class="card-body">

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
                                    <th>Endorsment</th>
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

<script>
    $(document).ready(function () {

        // 19=07-2021
        var tabel_list_sppa = $('#tabel_list_sppa').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_list_sppa_aktif",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop = "<?= $id_mop ?>";
                },

            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }]
        })

        // 19-07-2021
        $('#tabel_list_sppa').on('click', '.lihat', function () {

            var id_sppa  = $(this).data('id');
            var url     = "<?= base_url() ?>binding/detail_sppa_aktif/"+id_sppa;

            location.href = url;

        })
        
    })
</script>