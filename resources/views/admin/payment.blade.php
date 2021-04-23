@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
          <div class="row">
              <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                  <h3 class="mb-0"><i class="fas fa-credit-card text-muted mr-2"></i> {{ __('Payments') }}</h3>
              </div>
          </div>
          <div class="card card-fluid mt-4">
              <div class="card-body">
                <table id="dataTableIndex" data-ajaxurl="{{ route('payment_list') }}" class="table dt-responsive w-100"></table>
              </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  window.dataTableSet = [
    {title: "{{ __('Name') }}", data: 'first_name', name: 'first_name'},
    {title: "{{ __('Service') }}", data: 'service', name: 'service'},
    {title: "{{ __('Price') }}", data: 'price', name: 'price'},
    {title: "{{ __('Created At') }}", data: 'created_at', name: 'created_at'},
    // {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
  ];
});
</script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
