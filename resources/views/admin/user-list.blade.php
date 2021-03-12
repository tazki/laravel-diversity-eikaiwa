@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
            <div class="row">
                <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                    <h3 class="mb-0"> {{ __('Student List') }}</h3>
                    {{-- <ol class="breadcrumb ml-lg-3 mb-0">
                      <li class="breadcrumb-item active">{{ __('Student List') }}</li>
                    </ol> --}}
                </div>
            </div>
            <div class="card card-fluid mt-4">
                <div class="card-body">
                  <table id="dataTableIndex" data-ajaxurl="{{ route('user_list') }}" class="table dt-responsive w-100"></table>
                </div>
            </div>
            {{-- <button type="button" class="js-btn-add btn btn-primary btn-floated"
              title="{{ __('Create User') }}"
              data-create="{{ route('user_store') }}"
              data-toggle="modal"
              data-target="#UserFormModal">
                <span class="fa fa-plus"></span>
            </button> --}}
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  window.dataTableSet = [
    // {title: "{{ __('ID') }}", data: 'id', name: 'id'},
    {title: "{{ __('Name') }}", data: 'name', name: 'name'},
    {title: "{{ __('Mobile Number') }}", data: 'mobile_number', name: 'mobile_number'},
    {title: "{{ __('Email') }}", data: 'email', name: 'email'},
    {title: "{{ __('Service') }}", data: 'service', name: 'service'},
    {title: "{{ __('Last Update') }}", data: 'updated_at', name: 'updated_at'},
    {title: "{{ __('Status') }}", data: 'status', name: 'status'},
    // {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
  ];
});
</script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
