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
                  <canvas id="PieChart"></canvas>
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
var ctx = document.getElementById('PieChart');

new Chart(ctx, {
    type: 'pie',
    data: createPieData(data),
    options: {
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]+' %' || '';
          }
        }
      }
    }
});
</script>
@endpush
