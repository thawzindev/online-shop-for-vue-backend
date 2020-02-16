@extends('admin.layouts.master')

@section('plugin-css')
<style>
  .modal-content{
    background: #fff !important;
  }
</style>
@endsection

@section ('container')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-baseline">
          <h4 class="card-title mr-auto">Users</h4>
          
          <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-fw mr-2">
            Add User
          </a>

          <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
          </nav>

        </div>

        <form action="{{ route('admin.users.index') }}" method="GET" 
              class="d-flex align-items-center justify-content-between my-4">

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
                <option value="{{ $role['value'] }}" {{ request('role') == $role['value'] ? 'selected' : '' }}>
                  {{ $role['name'] }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="keyword">Keyword</label>
            <input type="text" class="form-control form-control-sm" name="keyword" value="{{ request('keyword') }}">
          </div>

          <input class="btn btn-success mt-2" type="submit" value="Search"> 
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
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                      <label class="badge badge-{{ $user->label() }}">{{ $user->roleName() }}</label>
                    </td>
                    <td class="text-right">
                      <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-icons btn-light">
                        <span class="fa fa-edit fa-lg text-primary"></span></a>

                      <button type="button" class="btn btn-icons btn-light confirm-button" data-toggle="modal" data-target="#myModal" data-id="{{ $user->id }}">
                        <span class="fa fa-trash fa-lg text-danger"></span>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.col -->

          <!-- pagination -->
          <nav class="col-12 d-flex justify-content-end mt-4">
            {{ $users->appends($_GET)->links() }}
          </nav>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      
      <!-- confirm modal box -->
      @include('components.confirm-modal', ['modal' => 'myModal', 'header' => 'Delete user', 'body' => 'Are you sure delete this user?', 'button_color' => 'danger', 'button_text' => 'Delete', 'confirm' => 'user', 'method' => 'DELETE'])
      <!-- end confirm modal box  -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection

@section('plugin-js')

@endsection

@section('custom-js')
@php 
  if (request('date')) {
    $date = split_daterange(request('date')); 
  }
@endphp

<script>
  $(function () {
    // Date range picker
    @if(request('date'))
      var start = moment('{{ $date['from'] }}');
      var end = moment('{{ $date['to'] }}');
    @else
      var start = moment().startOf('month');
      var end = moment().endOf('month');
    @endif

    function cb(start, end) {
      $('#daterange input').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
    }

    $('#daterange').daterangepicker({
      locale: {
          format: 'YYYY/MM/DD'
      },

      startDate: start,
      endDate: end,
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

    }, cb); 

    cb(start, end); 
    /** --- end daterangepicker --- */

   //modal box
   $('.confirm-button').click(function(){
       let user = $(this).data('id')
       let url = "{{ route('admin.users.destroy', ':user') }}"
       url  = url.replace(':user', user)

       $('#user').attr('action', url)

    })

  });
</script>
@endsection