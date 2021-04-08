@extends('layouts.admin')

@section('content')

<div class="sidebar-section sidebar-section-fill">
    <h1 class="page-title"><i class="fas fa-chalkboard-teacher text-muted mr-2"></i> {{ (isset($row->id)) ? __('Edit Teacher') : __('Add Teacher') }} </h1>
    {{-- <p class="text-muted"> San Francisco, United States </p> --}}
    <div class="nav-scroller border-bottom">
        <!-- .nav-tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {!! (!isset($show_tab)) ? 'show active' : '' !!}" data-toggle="tab" href="#profile">Profile</a>
            </li>

            @if(isset($row->id))
                <li class="nav-item">
                    <a class="nav-link {!! (isset($show_tab) && $show_tab == 'availability') ? 'show active' : '' !!}" data-toggle="tab" href="#class-availability">Availability</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#class-schedule">Class Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#class-taken">Class Taken</a>
                </li>
            @endif
        </ul><!-- /.nav-tabs -->
    </div><!-- /.nav-scroller -->
    <!-- .tab-content -->
    <div class="tab-content pt-4" id="clientDetailsTabs">
        <!-- .tab-pane -->
        <div class="tab-pane fade {!! (!isset($show_tab)) ? 'active show' : '' !!}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form enctype="multipart/form-data" action="{{ (isset($row->id)) ? route('teachers_update', ['id' => $row->id]) : route('teachers_add') }}" method="POST">
                @csrf
                <div class="card card-fluid">
                    <div class="card-body">
                        <div class="row">
                            <!-- grid column -->
                            <div class="col-lg-4">
                                <!-- .media -->
                                <div class="media mb-3">
                                    <!-- avatar -->
                                    <div class="js-photo-preview-holder user-avatar user-avatar-xl fileinput-button">
                                        <div class="fileinput-button-label"> Change photo </div>
                                        @if(isset($row->avatar) && !empty($row->avatar))
                                            <img src="{{ userFile($row->avatar, '', $row->id) }}" class="js-img-preview" alt="">
                                        @else
                                            <img class="js-img-preview" alt="">
                                            <span class="js-img-placeholder d-block fa fa-user-circle"></span>
                                        @endif
                                        <input id="fileupload-avatar" type="file" name="avatar" class="js-photo-preview">
                                    </div><!-- /avatar -->
                                    <!-- .media-body -->
                                    <div class="media-body pl-3">
                                        <h3 class="card-title"> Avatar </h3>
                                        <h6 class="card-subtitle text-muted"> Click the current avatar to change your photo. </h6>
                                        <p class="card-text">
                                            <small>JPG, GIF or PNG 400x400, &lt; 2 MB.</small>
                                        </p><!-- The avatar upload progress bar -->
                                        <div id="progress-avatar" class="progress progress-xs fade">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- /avatar upload progress bar -->
                                    </div><!-- /.media-body -->
                                </div><!-- /.media -->
                            </div><!-- /grid column -->
                            <!-- grid column -->
                            <div class="col-lg-8">
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="email" class="col-md-3">Email</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="email" id="email" value="{{ (isset($row->email)) ? $row->email : old('email') }}" class="@error('email') is-invalid @enderror form-control"  />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="password" class="col-md-3">Password</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="password" name="password" id="password" value="{{ old('password') }}" class="@error('password') is-invalid @enderror form-control"  />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="password_confirmation" class="col-md-3">Confirm Password</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="@error('password_confirmation') is-invalid @enderror form-control"  />
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="first_name" class="col-md-3">First Name</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="first_name" id="first_name" value="{{ (isset($row->first_name)) ? $row->first_name : old('first_name') }}" class="@error('first_name') is-invalid @enderror form-control"  />
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="last_name" class="col-md-3">Last Name</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="last_name" id="last_name" value="{{ (isset($row->last_name)) ? $row->last_name : old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="skype_id" class="col-md-3">Skype ID</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="skype_id" id="skype_id" value="{{ (isset($row->skype_id)) ? $row->skype_id : old('skype_id') }}" class="@error('skype_id') is-invalid @enderror form-control"  />
                                        @error('skype_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                                <!-- form row -->
                                <div class="form-row">
                                    <!-- form column -->
                                    <label for="phone_number" class="col-md-3">Phone Number</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="phone_number" id="phone_number" value="{{ (isset($row->phone_number)) ? $row->phone_number : old('phone_number') }}" class="@error('phone_number') is-invalid @enderror form-control"  />
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div><!-- /form column -->
                                </div><!-- /form row -->
                            </div><!-- /grid column -->
                        </div>
                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">Update Profile</button>
                        </div><!-- /.form-actions -->
                    </div><!-- /.card-body -->
                </div>
                <!-- .card -->
                <div class="card">
                    <!-- .card-body -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 id="client-billing-contact-tab" class="card-title"> More Details </h2>
                        </div>
                        <!-- form row -->
                        <div class="form-row">
                            <!-- form column -->
                            <label for="address_en" class="col-md-3">Address (English)</label> <!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-9 mb-3">
                                <input type="text" name="lang[1][address]" id="address_en" value="{{ (isset($lang[1]['address'])) ? $lang[1]['address'] : '' }}" class="form-control"  />
                            </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                            <!-- form column -->
                            <label for="address_jp" class="col-md-3">Address (Japanese)</label> <!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-9 mb-3">
                                <input type="text" name="lang[2][address]" id="address_jp" value="{{ (isset($lang[2]['address'])) ? $lang[2]['address'] : '' }}" class="form-control"  />
                            </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="hobbies_en" class="col-md-3">Hobbies (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[1][hobbies]" id="hobbies_en" value="{{ (isset($lang[1]['hobbies'])) ? $lang[1]['hobbies'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="hobbies_jp" class="col-md-3">Hobbies (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[2][hobbies]" id="hobbies_jp" value="{{ (isset($lang[2]['hobbies'])) ? $lang[2]['hobbies'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="interest_en" class="col-md-3">Interest (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[1][fields_of_interest]" id="interest_en" value="{{ (isset($lang[1]['fields_of_interest'])) ? $lang[1]['fields_of_interest'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="interest_jp" class="col-md-3">Interest (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[2][fields_of_interest]" id="interest_jp" value="{{ (isset($lang[2]['fields_of_interest'])) ? $lang[2]['fields_of_interest'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="english_level_en" class="col-md-3">English Level (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[1][english_level]" id="english_level_en" value="{{ (isset($lang[1]['english_level'])) ? $lang[1]['english_level'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="english_level_jp" class="col-md-3">English Level (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" name="lang[2][english_level]" id="english_level_jp" value="{{ (isset($lang[2]['english_level'])) ? $lang[2]['english_level'] : '' }}" class="form-control"  />
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="about_you_en" class="col-md-3">About You (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <textarea name="lang[1][about_you]" class="form-control" id="about_you_en">{{ (isset($lang[1]['about_you'])) ? $lang[1]['about_you'] : '' }}</textarea> <small class="text-muted">Appears on your profile page, 300 chars max.</small>
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="about_you_jp" class="col-md-3">About You (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <textarea name="lang[2][about_you]" class="form-control" id="about_you_jp">{{ (isset($lang[2]['about_you'])) ? $lang[2]['about_you'] : '' }}</textarea> <small class="text-muted">Appears on your profile page, 300 chars max.</small>
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">Update Details</button>
                        </div><!-- /.form-actions -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </form>
        </div><!-- /.tab-pane -->
        @if(isset($row->id))
            <!-- .tab-pane -->
            <div class="tab-pane fade {!! (isset($show_tab) && $show_tab == 'availability') ? 'active show' : '' !!}" id="class-availability" role="tabpanel" aria-labelledby="class-availability-tab">
                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-7">
                        <div class="card card-fluid">
                            <div class="card-body">
                                <!-- .table-responsive -->
                                <div class="table-responsive">
                                    <table id="dataTableIndex" data-ajaxurl="{{ route('teachers_list_availability', ['id' => $row->id]) }}" class="table dt-responsive w-100"></table>
                                    <script type="text/javascript">
                                        $(function () {
                                        window.dataTableSet = [
                                            {title: "{{ __('Day') }}", data: 'day', name: 'day'},
                                            {title: "{{ __('Start Time') }}", data: 'start_time', name: 'start_time'},
                                            {title: "{{ __('End Time') }}", data: 'end_time', name: 'end_time'},
                                            {title: "{{ __('Action') }}", data: 'action', name: 'action', orderable: false, searchable: false},
                                        ];
                                        });
                                        </script>
                                        {{-- window.dataSet need to be place above datatables includes --}}
                                        @include('includes.datatables')
                                </div><!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5">
                        <div class="card card-fluid">
                            <div class="card-body">
                                <form enctype="multipart/form-data" action="{{ (isset($row_availability->id)) ? route('teachers_update_availability', ['id' => $row_availability->id]) : route('teachers_add_availability', ['id' => $row->id]) }}" method="POST">
                                    @csrf
                                    <!-- form row -->
                                    <div class="form-row">
                                        <!-- form column -->
                                        <label for="day" class="col-md-3">Day</label> <!-- /form column -->
                                        <!-- form column -->
                                        <div class="col-md-9 mb-3">
                                            <select name="day" class="@error('day') is-invalid @enderror form-control">
                                                @foreach($day_list as $key => $item)
                                                    <option value="{{ $key }}" {!! ((isset($row_availability->day) && $row_availability->day!=$key) || (!isset($row_availability->day) && in_array($key, $day_selected))) ? 'disabled' : '' !!}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            {{--  &&  --}}
                                            @error('day')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- /form column -->
                                    </div><!-- /form row -->
                                    <!-- form row -->
                                    <div class="form-row">
                                        <!-- form column -->
                                        <label for="start_time" class="col-md-3">Start Time</label> <!-- /form column -->
                                        <!-- form column -->
                                        <div class="col-md-9 mb-3">
                                            <input type="text" name="start_time" id="start_time" value="{{ (isset($row_availability->start_time)) ? $row_availability->start_time : old('start_time') }}" class="@error('start_time') is-invalid @enderror form-control js-time-only"  />
                                            @error('start_time')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- /form column -->
                                    </div><!-- /form row -->
                                    <!-- form row -->
                                    <div class="form-row">
                                        <!-- form column -->
                                        <label for="end_time" class="col-md-3">End Time</label> <!-- /form column -->
                                        <!-- form column -->
                                        <div class="col-md-9 mb-3">
                                            <input type="text" name="end_time" id="end_time" value="{{ (isset($row_availability->end_time)) ? $row_availability->end_time : old('end_time') }}" class="@error('end_time') is-invalid @enderror form-control js-time-only"  />
                                            @error('end_time')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div><!-- /form column -->
                                    </div><!-- /form row -->

                                    <hr>
                                    <!-- .form-actions -->
                                    <div class="form-actions">
                                        <a href="{{ route('teachers_view_availability', ['id' => $row->id, 'show_tab' => 'availability']) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>    
                                        <button type="submit" class="btn btn-primary ml-auto">{{ __('Save') }}</button>
                                    </div><!-- /.form-actions -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.tab-pane -->
            <!-- .tab-pane -->
            <div class="tab-pane fade" id="class-schedule" role="tabpanel" aria-labelledby="class-schedule-tab">
                <!-- .card -->
                <div class="card">
                <!-- .card-header -->
                <div class="card-header d-flex">
                    <!-- .dropdown -->
                    <div class="dropdown">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter mr-1"></i> All (3) <i class="fa fa-caret-down"></i></button> <!-- .dropdown-menu -->
                    <div class="dropdown-menu stop-propagation">
                        <h6 id="class-schedule-tab" class="dropdown-header"> Class Schedule </h6><label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="0" checked=""> <span class="custom-control-label">All (3)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="1"> <span class="custom-control-label">On Going (1)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="2"> <span class="custom-control-label">Completed (2)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="3"> <span class="custom-control-label">Archived (0)</span></label>
                    </div><!-- /.dropdown-menu -->
                    </div><!-- /.dropdown -->
                </div><!-- /.card-header -->
                <!-- .table-responsive -->
                <div class="table-responsive">
                    <!-- .table -->
                    <table class="table">
                    <!-- thead -->
                    <thead>
                        <tr>
                        <th style="min-width:260px"> Student Name </th>
                        <th> Schedule </th>
                        <th> Status </th>
                        <th></th>
                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">John Doe</a>
                        </td>
                        <td class="align-middle"> 04/10/2021 </td>
                        <td class="align-middle">
                            <span class="badge badge-primary">Upcoming</span>
                        </td>
                        <td class="align-middle text-right">
                            <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span class="sr-only">Actions</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-arrow mr-n1"></div><button class="dropdown-item" type="button">Edit</button> <button class="dropdown-item" type="button">Delete</button>
                            </div>
                            </div>
                        </td>
                        </tr><!-- /tr -->
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">John Doe</a>
                        </td>
                        <td class="align-middle"> 02/26/2021 </td>
                        <td class="align-middle">
                            <span class="badge badge-warning">On Going</span>
                        </td>
                        <td class="align-middle text-right">
                            <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span class="sr-only">Actions</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-arrow mr-n1"></div><button class="dropdown-item" type="button">Edit</button> <button class="dropdown-item" type="button">Delete</button>
                            </div>
                            </div>
                        </td>
                        </tr><!-- /tr -->
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">Mike Smith</a>
                        </td>
                        <td class="align-middle"> 01/29/2021 </td>
                        <td class="align-middle">
                            <span class="badge badge-success">Completed</span>
                        </td>
                        <td class="align-middle text-right">
                            <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-ellipsis-h"></i> <span class="sr-only">Actions</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-arrow mr-n1"></div><button class="dropdown-item" type="button">Edit</button> <button class="dropdown-item" type="button">Delete</button>
                            </div>
                            </div>
                        </td>
                        </tr><!-- /tr -->
                    </tbody><!-- /tbody -->
                    </table><!-- /.table -->
                </div><!-- /.table-responsive -->
                </div><!-- /.card -->
            </div><!-- /.tab-pane -->
            <!-- .tab-pane -->
            <div class="tab-pane fade" id="class-taken" role="tabpanel" aria-labelledby="class-taken-tab">
                <!-- .card -->
                <div class="card">
                <!-- .card-header -->
                <div class="card-header d-flex">
                    <h2 class="card-title mr-auto">Total Hours: 17</h2>
                    <!-- .dropdown -->
                    <div class="dropdown">
                    <button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter mr-1"></i> All (3) <i class="fa fa-caret-down"></i></button> <!-- .dropdown-menu -->
                    <div class="dropdown-menu stop-propagation">
                        <h6 id="class-schedule-tab" class="dropdown-header"> Month </h6><label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="0" checked=""> <span class="custom-control-label">All (3)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="1"> <span class="custom-control-label">On Going (1)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="2"> <span class="custom-control-label">Completed (2)</span></label> <label class="custom-control custom-radio"><input type="radio" class="custom-control-input" name="clientProjectFilter" value="3"> <span class="custom-control-label">Archived (0)</span></label>
                    </div><!-- /.dropdown-menu -->
                    </div><!-- /.dropdown -->
                </div><!-- /.card-header -->
                <!-- .table-responsive -->
                <div class="table-responsive">
                    <!-- .table -->
                    <table class="table">
                    <!-- thead -->
                    <thead>
                        <tr>
                        <th style="min-width:260px"> Student Name </th>
                        <th> Total Hours </th>
                        <th> Date </th>
                        </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">John Doe</a>
                        </td>
                        <td class="align-middle"> 10 </td>
                        <td class="align-middle"> 01/2021 </td>
                        </tr><!-- /tr -->
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">John Doe</a>
                        </td>
                        <td class="align-middle"> 5 </td>
                        <td class="align-middle"> 01/2021 </td>
                        </tr><!-- /tr -->
                        <!-- tr -->
                        <tr>
                        <td class="align-middle text-truncate">
                            <a href="#">Mike Smith</a>
                        </td>
                        <td class="align-middle"> 2 </td>
                        <td class="align-middle"> 01/2021 </td>
                        </tr><!-- /tr -->
                    </tbody><!-- /tbody -->
                    </table><!-- /.table -->
                </div><!-- /.table-responsive -->
                </div><!-- /.card -->
            </div><!-- /.tab-pane -->
        @endif
    </div><!-- /.tab-content -->
</div>

<script src="{{ secure_asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ secure_asset('vendor/flatpickr/l10n/ja.js') }}"></script>
<script>
    $(".js-time-only").flatpickr({
        // locale: "ja",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: "60",

        // disableMobile: "true",
        // altInput: true,
        // altFormat: "F j, Y H:i",
        // dateFormat: "Y-m-d H:i:s",
        // minDate: "today",
        // enableTime: true,
        // time_24hr: true,
        // minTime: "8:00",
        // maxTime: "22:00",
        // minuteIncrement: "60",
        // // defaultDate: "13:45" // preloading time
        // // disable: ["2021-03-10", "2021-03-11", "2021-03-12", "2021-03-31"], // disable specific date
        // disable: [ //disables Saturdays and Sundays.
        //     function(date) {
        //         // return true to disable
        //         return (date.getDay() === 0 || date.getDay() === 6);

        //     }
        // ],
        // // enable: ["2021-04-04", "2021-04-05"]
    });
</script>
@endsection