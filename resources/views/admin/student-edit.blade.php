@extends('layouts.admin')

@section('content')
<form action="{{ route('students_add') }}" method="POST">
    @csrf
    <div class="sidebar-section sidebar-section-fill">
        <h1 class="page-title"><i class="fas fa-users text-muted mr-2"></i> {{ __('Add Student') }} </h1>
        {{-- <p class="text-muted"> San Francisco, United States </p> --}}
        <div class="nav-scroller border-bottom">
            <!-- .nav-tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link show active" data-toggle="tab" href="#profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#class-schedule">Class Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#class-taken">Class Taken</a>
                </li>
            </ul><!-- /.nav-tabs -->
        </div><!-- /.nav-scroller -->
        <!-- .tab-content -->
        <div class="tab-content pt-4" id="clientDetailsTabs">
            <!-- .tab-pane -->
            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card card-fluid">
                    <div class="card-body">
                        <div class="row">
                            <!-- grid column -->
                            <div class="col-lg-4">
                                <!-- .media -->
                                <div class="media mb-3">
                                    <!-- avatar -->
                                    <div class="user-avatar user-avatar-xl fileinput-button">
                                    <div class="fileinput-button-label"> Change photo </div>
                                        {{-- <img src="https://uselooper.com/assets/images/avatars/profile.jpg" alt="">  --}}
                                        <span class="d-block fa fa-user-circle"></span>
                                        <input id="fileupload-avatar" type="file" name="avatar">
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
                                    <label for="first_name" class="col-md-3">First Name</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="@error('first_name') is-invalid @enderror form-control"  />
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
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
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
                                    <label for="last_name" class="col-md-3">Email</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
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
                                    <label for="last_name" class="col-md-3">Skype ID</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
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
                                    <label for="last_name" class="col-md-3">Phone Number</label> <!-- /form column -->
                                    <!-- form column -->
                                    <div class="col-md-9 mb-3">
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
                                        @error('last_name')
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
                            <label for="input02" class="col-md-3">Address (English)</label> <!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control" id="input02" value="">
                            </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                            <!-- form column -->
                            <label for="input02" class="col-md-3">Address (Japanese)</label> <!-- /form column -->
                            <!-- form column -->
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control" id="input02" value="">
                            </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">Hobbies (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">Hobbies (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">Interest (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">Interest (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">English Level (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input02" class="col-md-3">English Level (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="">
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input03" class="col-md-3">About You (English)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <textarea class="form-control" id="input03"></textarea> <small class="text-muted">Appears on your profile page, 300 chars max.</small>
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <!-- form row -->
                        <div class="form-row">
                        <!-- form column -->
                        <label for="input03" class="col-md-3">About You (Japanese)</label> <!-- /form column -->
                        <!-- form column -->
                        <div class="col-md-9 mb-3">
                            <textarea class="form-control" id="input03"></textarea> <small class="text-muted">Appears on your profile page, 300 chars max.</small>
                        </div><!-- /form column -->
                        </div><!-- /form row -->
                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">Update Details</button>
                        </div><!-- /.form-actions -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
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
                        <th style="min-width:260px"> Teacher Name </th>
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
                        <th style="min-width:260px"> Teacher Name </th>
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
        </div><!-- /.tab-content -->
  </div>
</form>
@endsection