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
                <div class="form-group">

                  @foreach($invoices as $user_data)
                    <table class="table table-bordered table-sm">
                      <thead class="table-secondary">
                        <th colspan="5">{{ $user_data->no_usuario }}</th>
                      </thead>
                      <thead>
                        <tr>
                          <th>Período</th>
                          <th>Receita Líquida</th>
                          <th>Custo Fixo</th>
                          <th>Comissão</th>
                          <th>Lucro</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user_data->invoices as $invoice)
                        <tr>
                          <td>{{ month_day($invoice->month).', '.$invoice->year }}</td>
                          <td>{{ fn($invoice->income) }}</td>
                          <td>{{ fn($user_data->salary->brut_salario) }}</td>
                          <td>{{ fn($invoice->commission) }}</td>
                          <td>{{ calculate_profit($invoice->income, $user_data->salary->brut_salario, $invoice->commission) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-secondary">
                          <th>SALDO</th>
                          <th>{{ fn($user_data->invoices->sum('income')) }}</th>
                          <th>{{ fn($user_data->salary->brut_salario * $user_data->invoices->count()) }}</th>
                          <th>{{ fn($user_data->invoices->sum('commission')) }}</th>
                          <th>{{ calculate_profit($user_data->invoices->sum('income'), $user_data->salary->brut_salario * $user_data->invoices->count(), $user_data->invoices->sum('commission')) }}</th>
                        </tr>
                      </tbody>
                    </table>
                  @endforeach
                </div>
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
