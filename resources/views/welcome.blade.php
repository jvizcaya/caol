@extends('layouts.app')

@section('content')

@section('header')
    @parent
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Desenpenho</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Desenpenho</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@show


    <!-- buttons section -->
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="btn-group">
            <a href="#" class="btn btn-primary"><i class="fas fa-user"></i> Por consultor</a>
            <a href="#" class="btn btn-primary" ><i class="fas fa-user-circle"></i> Por cliente</a>
          </div>
        </div>
      </div>
    </div>

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
                        <select class="duallistbox" id="duallistbox" multiple="multiple" style="display: none;">
                          @foreach($users as $user)
                          <option value="{{ $user->co_usuario }}">{{ $user->no_usuario }}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="btn-group">
                  <a href="#" class="btn btn-secondary process_btn" data-operation="1"><i class="fas fa-list-alt"></i> Relatório</a>
                  <a href="#" class="btn btn-secondary process_btn" data-operation="2"><i class="fas fa-chart-bar"></i> Gráfico</a>
                  <a href="#" class="btn btn-secondary process_btn" data-operation="3"><i class="fas fa-chart-pie"></i> Pizza</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    @if(request()->filled(['q', 'values']))

    @if(request()->q == '1')
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

                      @foreach($users as $user)
                        @if(in_array($user->co_usuario, explode(',', request()->values)))
                        <table class="table table-bordered table-sm">
                          <thead>
                            <th colspan="5">{{ $user->no_usuario }}</th>
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
                            @foreach($user->invoices as $invoice)
                            <tr>
                              <td>{{ month_day($invoice->month).', '.$invoice->year }}</td>
                              <td>{{ fn($invoice->income) }}</td>
                              <td>{{ $user->salary ? fn($user->salary->brut_salario) : ''}}</td>
                              <td>{{ fn($invoice->commission) }}</td>
                              <td></td>
                            </tr>
                            @endforeach
                            <tr>
                              <th>SALDO</th>
                              <td>{{ fn($user->invoices->sum('income')) }}</td>
                              <td>{{ $user->salary ? fn($user->salary->brut_salario * $user->invoices->count()) : ''}}</td>
                              <td>{{ fn($user->invoices->sum('commission')) }}</td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                        @endif
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
    @endif

    @endif

@endsection

@push('scripts')
<script>
  $(function () {
    $('.duallistbox').bootstrapDualListbox({
        infoText: false,
        infoTextEmpty: ''
    });

    $('.process_btn').click(function(){

        var values = $('#duallistbox').val();

        if(values != ''){

            var url = document.head.querySelector('meta[name="url"]').content;

            var params = '?q='+$(this).attr('data-operation')+'&values='+values;

            $(location).attr('href', url+params);
        }
    });

  })
</script>
@endpush
