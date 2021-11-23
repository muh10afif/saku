<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6">
      <h4><?= $title ?></h4>
    </div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow">
      <div class="card-header">
        <h5 id="judul" class="mb-0 mt-1">Time : <?=$time?></h5>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_currency_rate" width="100%" cellspacing="0">
          <thead class="thead-light text-center">
            <tr>
              <th width="5%">No</th>
              <th width="25%">Name</th>
              <th width="20%">Kode Mata Uang</th>
              <th width="25%">Value (IDR)</th>
              <th width="25%">Kurs</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($listc as $key): ?>
              <tr>
                <td align="center"><?=$no.'.'?></td>
                <td><?=$key['name']?></td>
                <td><?=$key['kode']?></td>
                <td align="right"><?=$key['value']?></td>
                <td align="right"><?=$key['buy']?></td>
              </tr>
            <?php $no++; endforeach; ?>
          </tbody>
        </table>
        <b>Data From <a href="https://app.exchangerate-api.com/">https://app.exchangerate-api.com</a></b>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('.table').DataTable();
  });
</script>
