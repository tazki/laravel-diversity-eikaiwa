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
                <div class="row">
                  <div class="col-12 col-lg-12 col-xl-7">
                    <div class="card card-fluid">
                      <div class="card-body">
                        <!-- .table-responsive -->
                        <div class="table-responsive">
                          <table id="dataTableIndex" data-ajaxurl="{{ route('student_review') }}" class="table dt-responsive w-100"></table>
                        </div><!-- /.table-responsive -->
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-5">
                    <div class="card card-fluid">
                      <div class="card-body">                            
                        <form action="{{ (isset($row->review_id)) ? route('student_review_update', ['id' => $row->review_id]) : route('student_review_store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="booking_id" value="{!! (isset($row->id)) ? $row->id : '' !!}">
                          <input type="hidden" name="student_id" value="{!! (isset($row->student_id)) ? $row->student_id : '' !!}">
                          <input type="hidden" name="teacher_id" value="{!! (isset($row->teacher_id)) ? $row->teacher_id : '' !!}">

                          <!-- form row -->
                          <div class="form-row">
                              <!-- form column -->
                              <label class="col-md-3">{{ __('Teacher Name') }}</label> <!-- /form column -->
                              <!-- form column -->
                              <div class="col-md-9 mb-3">
                                <input type="text" value="{!! (isset($row->teacher_name)) ? $row->teacher_name : '' !!}" class="form-control" readonly="readonly">
                              </div><!-- /form column -->
                          </div>
                          <!-- form row -->
                          <div class="form-row">
                              <!-- form column -->
                              <label class="col-md-3">{{ __('Booking Date') }}</label> <!-- /form column -->
                              <!-- form column -->
                              <div class="col-md-9 mb-3">
                                <input type="text" value="{!! (isset($row->label_booking_date)) ? $row->label_booking_date : '' !!}" class="form-control" readonly="readonly">
                              </div><!-- /form column -->
                          </div>
                          <!-- form row -->
                          <div class="form-row">
                              <!-- form column -->
                              <label for="review_title" class="col-md-3">{{ __('Title') }}</label> <!-- /form column -->
                              <!-- form column -->
                              <div class="col-md-9 mb-3">
                                <input type="text" name="review_title" id="review_title" value="{!! (isset($row->review_title)) ? $row->review_title : '' !!}" class="form-control">
                              </div><!-- /form column -->
                          </div>
                          <!-- form row -->
                          <div class="form-row">
                              <!-- form column -->
                              <label for="review_content" class="col-md-3">>{{ __('Comment') }} *</label> <!-- /form column -->
                              <!-- form column -->
                              <div class="col-md-9 mb-3">
                                <textarea name="review_content" id="review_content" value="" class="@error('review_content') is-invalid @enderror form-control">{!! (isset($row->review_content)) ? $row->review_content : '' !!}</textarea>
                              </div><!-- /form column -->
                          </div>
                          <!-- form row -->
                          <div class="form-row">
                            <!-- form column -->
                            <label for="day" class="col-md-3">{{ __('Rating') }} *</label> <!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-9 mb-3">
                              <select name="review_rating" class="form-control">
                                @for($i=5; $i>=1; $i--)
                                <option value="{{ $i }}" {!! (isset($row->review_rating) && $row->review_rating == $i) ? 'selected="selected"' : '' !!}>{!! $i !!}</option>
                                @endfor
                              </select>
                            </div><!-- /form column -->
                          </div><!-- /form row -->

                          <hr>
                          <!-- .form-actions -->
                          <div class="form-actions">
                            <a href="{{ route('student_review') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>    
                            <button type="submit" class="btn btn-primary ml-auto">{{ __('Save') }}</button>
                          </div><!-- /.form-actions -->
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
  window.dataTableSet = [
    {title: "{{ __('Teacher Name') }}", data: 'teacher_name', name: 'teacher_name'},
    {title: "{{ __('Booking Date') }}", data: 'booking_date', name: 'booking_date'},
    {title: "{{ __('Reviews') }}", data: 'review', name: 'review'},
    {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
  ];
});
</script>
{{-- window.dataSet need to be place above datatables includes --}}
@include('includes.datatables')
@endsection
