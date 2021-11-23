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
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="text-right">
          <a href="<?php base_url(); ?>client_database/create" type="button" class="btn btn-success btn-labeled btn-xs">Create</a>
        </div>
      </div>
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Kota</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>X</td>
              <td>X</td>
              <td>X</td>
              <td>X</td>
              <td>
                <div class="text-center">
                  <i class="fas fa-pencil-alt" style="color:blue; width:15px; height:15px;"></i>
                  &nbsp;
                  <i class="fas fa-file-alt" style="color:green; width:15px; height:15px;"></i>
                  &nbsp;
                  <i class="far fa-trash-alt" style="color:red; width:15px; height:15px;"></i>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#datatable').DataTable();
  });
</script>
