  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <script src="https://cdn.tiny.cloud/1/e7wswii1rnw6g6gl2lhnzurjg7kpukpo2o95y8zdnuq149gw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Gallery Items', 'Count'],
        ['Photos', <?php echo Photo::totalCount() ?>],
        ['Comments', <?php echo Comment::totalCount() ?>],
        ['Users', <?php echo User::totalCount() ?>],
      ]);

      var options = {
        title: 'Gallery Contents'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>

  <script src="js/scripts.js"></script>

  </body>

  </html>