<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">SAKU</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<input type="hidden" id="status_toggle" class="status_toggle">
<div class="row">
  
  <div class="col-md-12">
    <div class="card shadow">
        <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0): ?>
            <div class="card-header">
                    <a href="<?= base_url() ?>entry_sppa/tambah_entry"><button class="btn btn-primary float-right" id="tambah_entry1"><i class="fas fa-plus mr-1"></i> Tambah Data</button></a>
                <!-- <h5 id="judul" class="mb-0 mt-1">SPPA Quatitations</h5> -->
            </div>
        <?php endif;  ?>
      <div class="card-body">
        <table class="table table-bordered table-hover dt-responsive nowrap tabel_entry" style="border-collapse: collapse; border-spacing: 0; width: 100%; " id="tabel_entry" width="100%" cellspacing="0">
          <thead class="thead-light text-center">
            <tr>
              <th width="5%">No</th>
              <th>No Polis</th>
              <th>Insurer</th>
              <th>LOB</th>
              <th>Insured</th>
              <th>Pengguna Tertanggung</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {

        // 22-09-2021
        var tabel_entry = $('.tabel_entry').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_entry",
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
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,6],
                'className' : 'text-center',
            }]
        })
        
        // 24-09-2012
        $('#tabel_entry').on('click', '.detail', function () {

            var id_sppa = $(this).data('id');

            window.location.href = "<?= base_url() ?>entry_sppa/detail_sppa/"+id_sppa;
            
        })
    })
</script>