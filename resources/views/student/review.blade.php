@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
          <div class="row">
              <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                  <h3 class="mb-0"><i class="fas fa-comments text-muted mr-2"></i> {{ __('Teacher Reviews') }}</h3>
              </div>
          </div>
          <div class="card card-fluid mt-4">
              <div class="card-body">
                <table id="dataTableIndex" data-ajaxurl="{{ route('student_review') }}" class="table dt-responsive w-100"></table>
              </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  window.dataTableSet = [
    {title: "{{ __('Name') }}", data: 'teacher_name', name: 'teacher_name'},
    {title: "{{ __('Booking Date') }}", data: 'booking_date', name: 'booking_date'},
    {title: "{{ __('Review') }}", data: 'review', name: 'review'},
    {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
  ];
});
</script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
