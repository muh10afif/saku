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
        <canvas id="bar-chart" height="100"></canvas><br>

       
      </div>
    </div>
  
  </div>

  <div class="col-md-12">

    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="col-md-12">
              <table class="table table-striped mb-0">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Asuransi</th>
                        <th>Skoring</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center">1.</td>
                        <td>PT. Asuransi Askrindo</td>
                        <td align="center">80</td>
                        <td align="center"><button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target=".bs-example-modal-center">Detail</button></td>
                    </tr>
                    <tr>
                        <td align="center">2.</td>
                        <td>PT. Asuransi Ekspor Indonesia (ASEI)</td>
                        <td align="center">80</td>
                        <td align="center"><button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target=".bs-example-modal-center">Detail</button></td>
                    </tr>
                    <tr>
                        <td align="center">3.</td>
                        <td>PT. Asuransi ASPAN</td>
                        <td align="center">70</td>
                        <td align="center"><button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target=".bs-example-modal-center">Detail</button></td>
                    </tr>
                    <tr>
                        <td align="center">4.</td>
                        <td>PT. Alianz Utama Indonesia</td>
                        <td align="center">40</td>
                        <td align="center"><button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target=".bs-example-modal-center">Detail</button></td>
                    </tr>
                    <tr>
                        <td align="center">5.</td>
                        <td>PT. Jasa Raharja Putra</td>
                        <td align="center">30</td>
                        <td align="center"><button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target=".bs-example-modal-center">Detail</button></td>
                    </tr>
                </tbody>
              </table>
            </div>
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

<script>
  $(document).ready(function () {

    //get the bar chart canvas
    var cData = JSON.parse('<?php echo $chart_data; ?>');
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: ['PT. Jasa Raharja Putra', 'PT. Asuransi ASPAN', 'PT. Asuransi Askrindo', 'PT. Asuransi Ekspor Indonesia (ASEI)', 'PT. Alianz Utama Indonesia'],
        datasets: [
          {
            label: 'Skoring',
            data: [30,70,80,80,40],
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
                ticks: {
                    beginAtZero: true,
                    min: Math.min.apply(this, [30,70,80,80,40]) - 10,
                    max: Math.max.apply(this, [30,70,80,80,40]) + 10,
                    stepSize: 10
                },
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