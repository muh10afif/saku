
<div class="d-flex justify-content-center">
    <div class="col-md-12">
    <form id="form_tes">
    <div class="table-responsive">
    <div class="form-group d-flex justify-content-end">
        <button type="button" class="btn btn-primary mb-2" id="tambah_dokumen"><i class="mdi mdi-arrow-down-thick"></i> Tambah Dokumen</button>
    </div>
    <table class="mt-3 table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok_entry" width="100%" cellspacing="0">
        <thead class="text-center">
            <tr>
                <th width="5%">No</th>
                <th width="25%">Upload Dokumen</th>
                <th width="25%">Description</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody id="show_dokumen">
            <tr id="list_add1">
                <td class="label_dok text-center" id="label_dok_1" data-id="1">1.</td>
                <td>
                    <input type="file" id="dokumen_1" name="dokumen_1" class="form-control dokumen_entry" data-id="1">
                    <input type="hidden" class="file_edit" id="file_edit_1" name="file_edit_1" data-id="1" value="baru">
                </td>
                <td><textarea id="desc_1" name="desc_1" class="form-control desc_entry" data-id="1" placeholder="Deskripsi"></textarea></td>
                <td align="center"><span style="cursor:pointer;" class="remove text-danger" data-id="1"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span></td>
            </tr>
        </tbody>
    </table>
    </div>
    <button type="button" class="btn btn-primary" id="simpan_tes">Simpan</button>
    </form>
    </div>
</div>

<?php $this->load->view('js'); ?>