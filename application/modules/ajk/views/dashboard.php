<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-body">
        <div class="alert alert-primary text-center" role="alert">
        <h4 class="mb-0 mt-0">Top 5 Skoring Asuransi</h4>
        </div><br>
        
        <canvas id="bar-chart" height="100"></canvas><br><br>

        <?php 

        shuffle($list_asuransi);

        foreach ($list_asuransi as $l) {
            $nama[] = $l['nama_asuransi'];
            $score[] = $l['score'];
        }

        ?>
      </div>
    </div>
  
  </div>
  
  <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <!-- <button type="button" class="btn btn-primary grafik"><i class="mdi mdi-chart-bar mr-1"></i> Grafik</button> -->
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_asuransi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Asuransi</th>
                            <th width="20%">Telepon</th>
                            <th width="20%">PIC</th>
                            <th width="20%">Score</th>
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

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title mt-0">Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <table class="table table-striped mb-0">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Ikhtisar Keuangan</th>
                        <th>Nilai/Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($parameter as $p): ?>
                      <tr>
                          <td align="center"><?= $no++ ?>.</td>
                          <td><?= $p['nama_parameter'] ?></td>
                          <td align="center"></td>
                      </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- https://www.nicesnippets.com/blog/codeigniter-create-bar-chart-in-php-with-chart-js -->


<script src="<?= base_url() ?>assets/template/plugins/chartjs/chart.min.js"></script>
<script>

var tabel_list_penilaian;
  $(document).ready(function () {

        // menampilkan list penilaian
        var tabel_list_penilaian = $('#tabel_master_asuransi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>ajk/dashboard/tampil_data_penilaian",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }]
        })

    //get the bar chart canvas
    // var cData = JSON.parse('<?php echo $chart_data; ?>');
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: <?= json_encode($nama) ?>,
        datasets: [
          {
            label: 'Skoring',
            data: <?= json_encode($score) ?>,
            backgroundColor: [
              'rgba(0, 184, 117, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 99, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(0, 184, 117, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 99, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }
        ]
      };
 
      //options
      var options = {
        responsive: true,
        title: {
          display: false,
          position: "top",
          text: "Top 5 Skoring Asuransi",
          fontSize: 22,
          fontColor: "#111"
        },
        legend: {
          display: false,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        },
        scales: {
              xAxes: [{
                gridLines: {
                    display:false
                }
            }],
            yAxes: [{
                // ticks: {
                //     beginAtZero: true,
                //     min: Math.min.apply(this, <?= json_encode($score) ?>) - 50,
                //     max: Math.max.apply(this, <?= json_encode($score) ?>) + 50,
                //     stepSize: 20
                // },
                gridLines: {
                    display:true
                }
            }]
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
      });
    
  })
</script>