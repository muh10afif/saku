<div class="col-md-12 p-3 table-responsive">
    <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_tertanggung_det" width="100%" cellspacing="0">
        <thead class="thead-light text-center">
            <tr>
                <th width="10%">No</th>
                <th>SPPA Number</th>
                <!-- <?php foreach ($list_field as $f): ?>
                    <th><?= $f['field_sppa'] ?></th>
                <?php endforeach; ?> -->
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>    
</div>

<input type="hidden" id="id_mop_endors" value="<?= $id_mop ?>">
<input type="hidden" id="id_relasi_endors" value="<?= $id_relasi_cob_lob ?>">
<input type="hidden" id="nama_endors" value="<?= $nama_endors ?>">

<script>
    $(document).ready(function () {
        
        var tabel_list_tertanggung = $('#tabel_list_tertanggung_det').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_tertanggung_detail",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop         = $('#id_mop_endors').val();
                    data.id_relasi      = $('#id_relasi_endors').val();
                    data.nama_endors    = $('#nama_endors').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0],
                'className' : 'text-center',
            }]
        })
        
    })
</script>