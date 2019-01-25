@extends('admin.layouts.master')

@section ('container')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Users</h4>
        
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-js')
{{-- <script src="{{ asset('assets/js/shared/data-table.js') }}"></script> --}}
@endsection