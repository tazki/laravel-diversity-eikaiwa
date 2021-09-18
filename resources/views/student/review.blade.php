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
                            {{-- {{ (isset($rows['availability']->id)) ? route('teachers_update_availability', ['id' => $rows['availability']->id]) : route('teachers_add_availability', ['id' => $row->id]) }} --}}
                              <form enctype="multipart/form-data" action="" method="POST">
                                  @csrf
                                  <!-- form row -->
                                  <div class="form-row">
                                      <!-- form column -->
                                      <label class="col-md-3">Teacher Name</label> <!-- /form column -->
                                      <!-- form column -->
                                      <div class="col-md-9 mb-3">
                                        <input type="text" value="" class="form-control" readonly="readonly">
                                      </div><!-- /form column -->
                                  </div>
                                  <!-- form row -->
                                  <div class="form-row">
                                      <!-- form column -->
                                      <label class="col-md-3">Booking Date</label> <!-- /form column -->
                                      <!-- form column -->
                                      <div class="col-md-9 mb-3">
                                        <input type="text" value="" class="form-control" readonly="readonly">
                                      </div><!-- /form column -->
                                  </div>
                                  <!-- form row -->
                                  <div class="form-row">
                                      <!-- form column -->
                                      <label for="review_title" class="col-md-3">Title</label> <!-- /form column -->
                                      <!-- form column -->
                                      <div class="col-md-9 mb-3">
                                        <input type="text" name="review_title" id="review_title" value="" class="form-control">
                                      </div><!-- /form column -->
                                  </div>
                                  <!-- form row -->
                                  <div class="form-row">
                                      <!-- form column -->
                                      <label for="review_content" class="col-md-3">Comment</label> <!-- /form column -->
                                      <!-- form column -->
                                      <div class="col-md-9 mb-3">
                                        <textarea name="review_content" id="review_content" value="" class="form-control"></textarea>
                                      </div><!-- /form column -->
                                  </div>
                                  <!-- form row -->
                                  <div class="form-row">
                                      <!-- form column -->
                                      <label for="day" class="col-md-3">Rating *</label> <!-- /form column -->
                                      <!-- form column -->
                                      <div class="col-md-9 mb-3">
                                          <select name="review_rating" class="@error('day') is-invalid @enderror form-control">
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                              <option value="1">1</option>
                                          </select>

                                          @error('day')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
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
