@extends('layouts.admin')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
            <div class="row">
                <div class="col-12 d-flex flex-column flex-lg-row align-items-center">
                    <h3 class="mb-0"> {{ __('Add Teacher') }}</h3>
                </div>
            </div>
            <div class="card card-fluid mt-4">
                <div class="card-body">
                    <div class="col-md-6 row-fluid">
                        <form action="{{ route('teachers_add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="product_name">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="@error('first_name') is-invalid @enderror form-control"  />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="product_name">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror form-control"  />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <a href="{{ route('teachers_list') }}" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-success">Save</button>           
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
