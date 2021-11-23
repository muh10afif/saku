<!-- Page-Title -->
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

<div class="row justify-content-center mt-0">
  <div class="col-lg-12">
    <div class="card shadow">
      <div class="card-header">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group row mb-0">
              <div class="col-md-4">
                <input type="text" id="datadari" class="form-control datepicker mr-4" name="" value="" placeholder="Dari Tanggal">
              </div>
              <div class="col-md-4">
                <input type="text" id="datasmpe" class="form-control datepicker" name="" value="" placeholder="Sampai dengan Tanggal">
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary float-left" id="find_report"><i class="fas fa-search mr-2"></i>Cari</button>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <button class="btn btn-primary float-right ml-1" id="ex_report_product"><i class="far fa-newspaper mr-2"></i>Import to Excel</button>
            <button class="btn btn-primary float-right mr-1" id="pd_report_product"><i class="far fa-file-alt  mr-2"></i>Import to PDF</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>SOB</th>
              <th>COB</th>
              <th>Type COB</th>
              <th>LOB</th>
              <th>Insured Name</th>
              <th>Total Sum Insured</th>
              <th>Total Premi Standar</th>
              <th>Total Premi Perluasan</th>
              <th>Diskon</th>
              <th>Total Akhir Premi</th>
              <th>Create Time</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    fetch_data('no');
    var table = '';

    function fetch_data(is_data_search, start_date='', end_date='') {
      table = $('#datatable').DataTable({
        "lengthMenu": [[10, 25, 50, 75, 80, -1], [10, 25, 50, 75, 80, "All"]],
        "select": true,
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
          "url" : "<?php echo base_url(); ?>report/productionReportController/ajaxdata",
          "type" : "POST",
          "data" : {
            "was_data_search" : is_data_search,
            "str_date" : start_date,
            "end_date" : end_date
          }
        },
        "columnDefs" : [{
          "targets" : [0],
          "orderable" : false
        },{
          'targets' : [0],
          'className' : 'text-center',
        }]
      });
    }

    $('#find_report').on('click', function () {
      var star_date = $('#datadari').val();
      var endd_date = $('#datasmpe').val();
      $('#datatable').DataTable().destroy();
      if (star_date != '' && endd_date != '') {
        fetch_data('yes',star_date, endd_date);
      } else {
        fetch_data('no');
      }
    });

    $('#ex_report_product').on('click', function () {
      var star_date = $('#datadari').val();
      var endd_date = $('#datasmpe').val();
      var sendd = star_date+'_'+endd_date;
      window.location = '<?php echo base_url(); ?>report/productionReportController/to_excel/'+sendd;
		  event.preventDefault();
    });

    $('#pd_report_product').on('click', function () {
      var star_date = $('#datadari').val();
      var endd_date = $('#datasmpe').val();
      var sendd = star_date+'_'+endd_date;
      window.location = '<?php echo base_url(); ?>report/productionReportController/to_pdf/'+sendd;
		  event.preventDefault();
    });
  });
</script>
