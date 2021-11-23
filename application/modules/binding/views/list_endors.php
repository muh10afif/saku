<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                
                <?php if ($this->uri->segment(4) == 1): ?>
                    <li class="breadcrumb-item"><a href="<?= base_url('binding') ?>">Binding Slip</a></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?= base_url('binding/lihat/dekl') ?>">Binding Slip</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('detail_binding/'.$id_mop) ?>">Detail Binding</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('binding/detail_list_sppa/'.$id_mop.'/'.$this->uri->segment(4)) ?>"><?= "Detail ".$this->uri->segment(4) ?></a></li>
                <?php endif; ?>

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

                        <?php if ($this->uri->segment(4) == 1): ?>
                            <a href="<?= base_url('binding') ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                        <?php else: ?>
                            <a href="<?= base_url('binding/detail_list_sppa/'.$id_mop.'/'.$this->uri->segment(4)) ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                        <?php endif; ?>
                </div>
                <div class="card-body card_awal">

                    <div class="row mb-2">
                        <div class="col-md-12 text-center">
                            <h5>SPPA Number : <samp><mark id="sppa_number"> <?= $sppa_number ?> </mark></samp></h5>
                        </div>
                    </div>
                        
                    <div class="row">

                        <div class="col-md-12">

                            <input type="hidden" class="id_sppa" id="id_sppa_list">
                            <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_endors" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Endorsment</th>
                                        <th>Tanggal Endorsment</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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

        var tabel_list_endors = $('#tabel_list_endors').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_list_endors",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = "<?= $id_sppa_awal ?>";
                },

            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }]
        })

        // 08-07-2021
        $('#tabel_list_endors').on('click', '.detail', function () {

            var id_sppa = $(this).data('id');
            var uri     = "<?= $this->uri->segment(4) ?>";

            location.href = "<?= base_url('binding/detail_sppa_list_endors/') ?>"+id_sppa+"/"+uri;

        })
        
    })

</script>