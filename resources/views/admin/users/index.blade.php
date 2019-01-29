@extends('admin.layouts.master')

@section('plugin-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.css">
@endsection

@section ('container')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="card-title">Users</h4>

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
          </nav>
        </div>

        <form action="{{ route('admin.users.index') }}" method="GET" 
              class="d-flex align-items-center justify-content-between mb-4">

          <!-- date -->
          <div class="form-group">
            <label for="date">Date</label>
            <div id="daterange" class="input-group date datepicker">
              <input type="text" class="form-control form-control-sm" name="date">
              <span class="input-group-addon input-group-append border-left">
                <span class="mdi mdi-calendar input-group-text"></span>
              </span>
            </div>
          </div>

          <!-- role -->
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role">
              <option value="">All</option>
              @foreach(config('form.roles') as $role)
                <option value="{{ $role['value'] }}">{{ $role['name'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="keyword">Keyword</label>
            <input type="text" class="form-control form-control-sm" name="keyword">
          </div>
          
          <input class="btn btn-success" type="submit" value="Search"> 
        </form>
        <!-- /.d-flex -->

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr class="bg-primary text-white">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $index => $user)
                  <tr>
                    <td>{{ $index + 1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                      <label class="badge badge-{{ $user->label() }}">{{ $user->roleName() }}</label>
                    </td>
                    <td class="text-right">
                      <button class="btn btn-light">
                        <i class="mdi mdi-eye text-primary"></i>View </button>
                      <button class="btn btn-light">
                        <i class="mdi mdi-close text-danger"></i>Remove </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection

@section('plugin-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.js"></script>
@endsection

@section('custom-js')
<script>
  $(function () {
    // Date range picker
    var start = moment().startOf('month');
    var end = moment().endOf('month');

    function cb(start, end) {
        $('#daterange input').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
    }

    $('#daterange').daterangepicker({
      locale: {
          format: 'YYYY/MM/DD'
      },

      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      },

      @if(request('date'))
        startDate: '{{ $date['from'] }}',
      @else
        startDate: moment().startOf('month'),
      @endif

      @if(request('date'))
        endDate: '{{ $date['to'] }}',
      @else
        endDate: moment().endOf('month'),
      @endif

    }, cb); 

    cb(start, end); 
    /** --- end daterangepicker --- */

  });
</script>
@endsection