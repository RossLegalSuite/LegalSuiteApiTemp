@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('createDeveloper') }}">
                        @csrf
                        {{-- <input id="user_type"  name="user_type"  class="form-control" value="Developer" style="display:none"> --}}
                        
                        <div class="form-group row">
                            
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                
                                @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Access Type</label>
                            <div class="col-md-6">
                                <div class="col-xs-12">
                                    <table id="developerAccess" class="table table-bordered table-hover dt-responsive">
                                        
                                        <thead>
                                            <tr>
                                                
                                                <th> Read</th>
                                                <th> Insert </th>
                                                <th> Update </th>
                                                <th> Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                
                                                <td style="text-align: center; vertical-align: middle;"> <input name="getAccessFlag" class="" type="checkbox"  ></td>
                                                <td style="text-align: center; vertical-align: middle;"> <input name="postAccessFlag" class="" type="checkbox"  ></td>
                                                <td style="text-align: center; vertical-align: middle;"> <input name="putAccessFlag" class="" type="checkbox"  ></td>
                                                <td style="text-align: center; vertical-align: middle;"> <input name="deleteAccessFlag" class="" type="checkbox"></td>
                                                
                                            </tr>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
