@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
          <div class="row">
              <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                  <h3 class="mb-0"><i class="fas fa-comment text-muted mr-2"></i> {{ __('Contact Form') }}</h3>
              </div>
          </div>
          <div class="card card-fluid mt-4">
              <div class="card-body">
                <table id="dataTableIndex" data-ajaxurl="{{ route('contact_form') }}" class="table dt-responsive w-100"></table>
              </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  window.dataTableSet = [
    {title: "{{ __('Name') }}", data: 'name', name: 'name'},
    {title: "{{ __('Email') }}", data: 'email', name: 'email'},
    {title: "{{ __('Subject') }}", data: 'subject', name: 'subject'},
    {title: "{{ __('Message') }}", data: 'message', name: 'message'},
    {title: "{{ __('Send At') }}", data: 'updated_at', name: 'updated_at'},
    // {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
  ];
});
</script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
