<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Consultores</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                  <canvas id="BarChart"></canvas>
              </div>
            </div>
          </div>

          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>

var data = @json($invoices);
var ctx = document.getElementById('BarChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        xLabels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: createDatasets(data),
    },
    options: {
        scales: {
          yAxes: [{
            ticks: {
                callback: function(value, index, values) {
                  return 'R$ ' + value;
                }
            }
          }]
        }
    }
});
</script>
@endpush
