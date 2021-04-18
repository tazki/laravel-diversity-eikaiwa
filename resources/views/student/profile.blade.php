@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="page">
        <div class="page-inner">
            <header class="page-title-bar">
                <h1 class="page-title"> {{ __('Edit Profile') }} </h1>
			</header>
			<div class="page-section">
				<div class="row">
					<div class="col-lg-4">
						<div class="card card-fluid">
							<h6 class="card-header">{{ __('Profile') }}</h6>
							<nav class="nav nav-tabs flex-column border-0" id="nav-tab" role="tablist">
								<a class="nav-link {!! (empty($rows['tab'])) ? 'active' : '' !!}" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
									aria-controls="profile" aria-selected="true">{{ __('Details') }}</a>
								<a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
									aria-controls="password" aria-selected="false">{{ __('Password') }}</a>
                                <a class="nav-link {!! ($rows['tab']=='subscription') ? 'active' : '' !!}" id="subscription-tab" data-toggle="tab" href="#subscription" role="tab"
                                    aria-controls="subscription" aria-selected="false">{{ __('Subscription') }}</a>
							</nav>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade {!! (empty($rows['tab'])) ? 'show active' : '' !!}" id="profile" role="tabpanel"
								aria-labelledby="profile-tab">
								<form enctype="multipart/form-data" method="POST" action="{{ route('student_profile_update') }}" class="auth-form is-fullwidth">
									@csrf
									<div class="media mb-3">
										<div class="js-photo-preview-holder user-avatar user-avatar-xl fileinput-button">
											<div class="fileinput-button-label"> {{ __('Change Photo') }} </div>
											@if(isset($rows['user']->avatar) && !empty($rows['user']->avatar))
												<img src="{{ userFile($rows['user']->avatar, '', $rows['user']->id) }}" class="js-img-preview" alt="">
											@else
												<img class="js-img-preview" alt="">
												<span class="js-img-placeholder d-block fa fa-user-circle"></span>
											@endif
											<input type="file" name="avatar" class="js-photo-preview">
										</div>
										<div class="media-body pl-3">
											<h3 class="card-title">{{ __('Public avatar') }}</h3>
											<h6 class="card-subtitle text-muted">{{ __('Click the current avatar to change your photo.') }}</h6>
											<p class="card-text">
												<small>{{ __('JPG, GIF or PNG 400x400, < 2 MB.') }}</small>
											</p>
											<div id="progress-avatar" class="progress progress-xs fade">
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>

									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="client-first-name">{{ __('First Name') }} <span class="text-danger">*</span></label>
												<input type="text" name="first_name" value="{{ ($rows['user']->first_name) ? $rows['user']->first_name :  old('first_name') }}"
													class="form-control @error('first_name') is-invalid @enderror"
													id="client-first-name" required="">
												@error('first_name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="client-last-name">{{ __('Last Name') }} <span class="text-danger">*</span></label>
												<input type="text" name="last_name" value="{{ ($rows['user']->last_name) ? $rows['user']->last_name :  old('last_name') }}"
													class="form-control @error('last_name') is-invalid @enderror"
													id="client-last-name" required="">
												@error('last_name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="client-email">{{ __('Email') }} <span class="text-danger">*</span></label>
										<input type="email" name="email" value="{{ ($rows['user']->email) ? $rows['user']->email :  old('email') }}"
											class="form-control @error('email') is-invalid @enderror" id="client-email"
											required="">
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="client-skype_id">Skype ID <span lass="text-danger">*</span></label>
										<input type="text" name="skype_id" value="{{ ($rows['user']->skype_id) ? $rows['user']->skype_id :  old('skype_id') }}"
											class="form-control @error('skype_id') is-invalid @enderror"
											id="client-skype_id" required="">
										@error('skype_id')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="client-mobilePhone">{{ __('Phone Number') }} <span lass="text-danger">*</span></label>
										<input type="text" name="phone_number" value="{{ ($rows['user']->phone_number) ? $rows['user']->phone_number :  old('phone_number') }}"
											class="form-control @error('phone_number') is-invalid @enderror"
											id="client-mobilePhone" required="">
										@error('phone_number')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="client-address">{{ __('Address') }} <span lass="text-danger">*</span></label>
										<input type="text" name="address" value="{{ ($rows['user']->address) ? $rows['user']->address :  old('address') }}"
											class="form-control @error('address') is-invalid @enderror"
											id="client-address" required="">
										@error('address')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="client-postal_code">{{ __('Postal Code') }} <span lass="text-danger">*</span></label>
										<input type="text" name="postal_code" value="{{ ($rows['user']->postal_code) ? $rows['user']->postal_code :  old('postal_code') }}"
											class="form-control @error('postal_code') is-invalid @enderror"
											id="client-postal_code" required="">
										@error('postal_code')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<input type="hidden" name="confirm_first" class="js-input-confirm" value="1" />
												{{-- <button type="button" class="js-btn-cancel btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button> --}}
												<button type="button" class="js-btn-confirm btn btn-primary" onClick="ajaxForm(this); return false;">{{ __('Next') }}</button>
												<button type="button" class="js-btn-back btn btn-secondary d-none">{{ __('Back') }}</button>
												<button type="button" class="js-btn-submit btn btn-primary d-none" onClick="ajaxForm(this); return false;">{{ __('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
								<form method="POST" action="{{ route('student_password') }}" class="auth-form is-fullwidth">
									@csrf
									<div class="col-md-12">
										<div class="form-group">
											<label for="client-current-password">{{ __('Current Password') }} <span class="text-danger">*</span></label>
											<input type="password" name="current_password"
												class="form-control @error('current_password') is-invalid @enderror"
												id="client-current-password" required="">
											@error('current_password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="client-password">{{ __('New Password') }} <span class="text-danger">*</span></label>
											<input type="password" name="password" class="form-control"
												id="client-password" required="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="client-confirm-password">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
											<input type="password" name="password_confirmation" class="form-control"
												id="client-confirm-password" required="">
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<input type="hidden" name="confirm_first" class="js-input-confirm" value="1" />
												{{-- <button type="button" class="js-btn-cancel btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button> --}}
												<button type="button" class="js-btn-confirm btn btn-primary" onClick="ajaxForm(this); return false;">{{ __('Next') }}</button>
												<button type="button" class="js-btn-back btn btn-secondary d-none">{{ __('Back') }}</button>
												<button type="button" class="js-btn-submit btn btn-primary d-none" onClick="ajaxForm(this); return false;">{{ __('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade {!! ($rows['tab']=='subscription') ? 'show active' : '' !!}" id="subscription" role="tabpanel"
                            aria-labelledby="profile-tab">
                                <div class="auth-form is-fullwidth">
                                    @if(isset($rows['payment']) && isset($rows['payment']['service']))
										<div class="form-group">
											<label class="col-md-4">{{ __('Usable Points to take Class') }}:</label>
											{{ $rows['activePoints'] }}
										</div>	
										<hr>
										<div class="form-group">
											<label class="col-md-4">{{ __('Current Service') }}:</label>
											{{ $rows['payment']['service'] }}
										</div>
										<div class="form-group">
											<label class="col-md-4">{{ __('Points') }}:</label>
											{{ $rows['payment']['points'] }}
										</div>
										<div class="form-group">
											<label class="col-md-4">{{ __('Price') }}:</label>
											{{ $rows['payment']['price_label'] }}
										</div>
										<div class="form-group">
											<label class="col-md-4">{{ __('Status') }}:</label>
											{{ $rows['payment']['status'] }}
										</div>

										@if(isset($rows['has_upgrade_request']) && !empty($rows['has_upgrade_request']))
											<div class="form-group">
												<label class="col-md-4">&nbsp;</label>
												<a href="{!! route('page_subscription', ['id' => urlencode(base64_encode(Auth::user()->id.'|'.$rows['has_upgrade_request']))]) !!}" target="_blank">
													<span class="menu-icon fas fa-credit-card"></span> {{ __('Complete Payment') }}
												</a>
											</div>
										@else
											@if(Auth::user()->subscribed('default') && !Auth::user()->subscription('default')->cancelled())
											<div class="form-group">
												<label class="col-md-4">&nbsp;</label>
												<span class="btn btn-danger" data-toggle="modal" data-target="#planCancelModal">
													<span class="menu-icon fas fa-trash"></span> {{ __('Cancel Subscription') }}
												</span>
											</div>
											@else
												<div class="form-group">
													<label class="col-md-4">&nbsp;</label>
													{{ __('Cancelled Subscription') }}
												</div>
											@endif
										@endif

										{{-- @if(isset($rows['payment']['session_url']))
										<div class="form-group">
											<label class="col-md-4">&nbsp;</label>
											<a href="{{ $rows['payment']['session_url'] }}" target="_blank">
												<span class="menu-icon fas fa-credit-card"></span> {{ __('Complete Payment') }}
											</a>
										</div>
										@endif --}}
									@endif
								</div>
                            </div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
