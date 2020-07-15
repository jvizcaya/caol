@extends('layouts.app')

@section('content')

@php
  list($start_year, $start_month) = explode('-', request()->input('start_at', '2017-1'));
  list($end_year, $end_month) = explode('-', request()->input('end_at', '2017-12'));
@endphp

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
              <li class="breadcrumb-item active">Desenpenho comercial</li>
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
            <a href="{{ url('/') }}" class="btn btn-primary"><i class="fas fa-user"></i> Por consultor</a>
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
                  <form>
                    <div class="form-row align-items-center">
                      <div class="col-sm-3 my-1">
                        <select class="form-control" id="start_month" autocomplete="off">
                          @for($i = 1; $i <= 12; $i ++)
                          <option value="{{ $i }}" {{ selected($i, $start_month) }}>
                            {{ month_day($i) }}
                          </option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-3 my-1">
                        <select class="form-control" id="start_year" autocomplete="off">
                          <option value="2007" {{ selected(2007, $start_year) }}>2007</option>
                          <option value="2006" {{ selected(2006, $start_year) }}>2006</option>
                          <option value="2005" {{ selected(2005, $start_year) }}>2005</option>
                          <option value="2004" {{ selected(2004, $start_year) }}>2004</option>
                          <option value="2003" {{ selected(2003, $start_year) }}>2003</option>
                        </select>
                      </div>
                      <div class="col-sm-3 my-1">
                        <select class="form-control" id="end_month" autocomplete="off">
                          @for($i = 1; $i <= 12; $i ++)
                          <option value="{{ $i }}" {{ selected($i, $end_month) }}>
                            {{ month_day($i) }}
                          </option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-3 my-1">
                        <select class="form-control" id="end_year" autocomplete="off">
                          <option value="2007" {{ selected(2007, $end_year) }}>2007</option>
                          <option value="2006" {{ selected(2006, $end_year) }}>2006</option>
                          <option value="2005" {{ selected(2005, $end_year) }}>2005</option>
                          <option value="2004" {{ selected(2004, $end_year) }}>2004</option>
                          <option value="2003" {{ selected(2003, $end_year) }}>2003</option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <select class="duallistbox" id="duallistbox" multiple="multiple" style="display: none;">
                          @foreach($users as $user)
                          <option value="{{ $user->co_usuario }}" {{ in_array($user->co_usuario, explode(',', request()->values)) ? 'selected' : '' }}>
                            {{ $user->no_usuario }}
                          </option>
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

    @if(request()->filled(['q', 'values']) && $invoices->count())
        @includeWhen(request()->q == 1, 'subviews.list_report')
        @includeWhen(request()->q == 2, 'subviews.grafic_bar')
        @includeWhen(request()->q == 3, 'subviews.grafic_pie')
    @endif

@endsection
