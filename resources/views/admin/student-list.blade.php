@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
            <div class="row">
                <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                    <h3 class="mb-0"><i class="fas fa-users text-muted mr-2"></i> {{ __('Student List') }}</h3>
                    {{-- <ol class="breadcrumb ml-lg-3 mb-0">
                      <li class="breadcrumb-item active">{{ __('Student List') }}</li>
                    </ol> --}}
                </div>
            </div>
            <div class="card card-fluid mt-4">
                <div class="card-body">
                  <table id="dataTableIndex" data-ajaxurl="{{ route('students_list') }}" class="table dt-responsive w-100"></table>
                </div>
            </div>
            <a href="{{ route('students_add') }}" class="js-btn-add btn btn-primary btn-floated"
              title="{{ __('Create Student') }}">
              <span class="fa fa-plus"></span>
          </a>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function () {
    window.dataTableSet = [
      // {title: "{{ __('ID') }}", data: 'id', name: 'id'},
      {title: "{{ __('Name') }}", data: 'name', name: 'name'},
      {title: "{{ __('Phone Number') }}", data: 'phone_number', name: 'phone_number'},
      {title: "{{ __('Email') }}", data: 'email', name: 'email'},
      // {title: "{{ __('Total Class Hours') }}", data: 'service', name: 'service'},
      {title: "{{ __('Last Update') }}", data: 'updated_at', name: 'updated_at'},
      {title: "{{ __('Status') }}", data: 'status', name: 'status'},
      {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
    ];
  });
  </script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
