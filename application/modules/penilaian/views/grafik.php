<div class="alert alert-primary text-center" role="alert">
<h4 class="mb-0 mt-0">Top 5 Skoring Asuransi</h4>
</div><br>
<canvas id="bar-chart" height="100"></canvas><br>

<?php 

    shuffle($list_asuransi);

    foreach ($list_asuransi as $l) {
        $nama[] = $l['nama_asuransi'];
        $score[] = $l['score'];
    }

?>

<!-- chartjs js -->
<script src="<?= base_url() ?>assets/template/plugins/chartjs/chart.min.js"></script>
<script>
  $(document).ready(function () {

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