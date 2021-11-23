<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Legowo</a></li>
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama Source Of Business</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>x</td>
              <td>x</td>
              <td>
                <button type="button" class="btn btn-info btn-labeled btn-xs">Ubah</button>
                <button type="button" class="btn btn-danger btn-labeled btn-xs">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" required placeholder="Nama"/>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="nama" id="nama" class="form-control" rows="7" cols="80"></textarea>
        </div>
        <div class="form-group text-right">
          <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
          <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#datatable').DataTable();
  });
</script>
