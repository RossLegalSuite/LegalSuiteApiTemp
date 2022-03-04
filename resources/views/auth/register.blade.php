@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Welcome to the LegalSuite Api</h2></div>
                
                <div class="card-body">
                    <div class="mb-3"><p>Some Apps use the LegalSuite Api to enhance the functionality of the LegalSuite program. 
                        To do this, they need acccess to your LegalSuite database.</p>
                        <p>To ensure your database connection details are private and secure, you need to enter them yourself. 
                            Your SQL login details will be saved on the system and not be known to the 3rd Party Apps.
                            Please create an account on our system and then enter your database access details in the screen provided.</p>
                        </div>
                        
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                        @endforeach
                        @endif
                        
                        <fieldset>
                            <legend>&nbsp;&nbsp;Create your account&nbsp;&nbsp;</legend>
                            <form method="POST" action="{{ route('registerClient') }}">
                                @csrf                               
                                
                                <div class="form-group row">
                                    <label for="dbUser" class="col-md-3 col-form-label text-md-right">Name</label>
                                    
                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                </div>   
                                
                                <div class="form-group row">
                                    <label for="dbUser" class="col-md-3 col-form-label text-md-right">Email Address</label>
                                    
                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbUser" class="col-md-3 col-form-label text-md-right">Password</label>
                                    
                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbUser" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
                                    
                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbHost" class="col-md-3 col-form-label text-md-right">Server</label>
                                    <div class="col-md-8">
                                        <input id="dbHost" type="text" class="form-control {{ $errors->has('dbHost') ? ' is-invalid' : '' }}" name="dbHost" required value="">
                                        <span class="small">The uri or IP address of the server which hosts the LegalSuite database</span>                                                
                                        @if($errors->has('dbHost')) <span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('dbHost') }}</strong> </span> @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbPort" class="col-md-3 col-form-label text-md-right">Port</label>
                                    
                                    <div class="col-md-8">
                                        <input id="dbPort" type="text" class="form-control{{ $errors->has('dbPort') ? ' is-invalid' : '' }}" name="dbPort" required value="">
                                        <span class="small">The port the server is listening to for SQL requests.</span>
                                        <span class="small">Please ensure this port <strong>only accepts requests from this website</strong> <span class="badge badge-soft-danger" id="security-notes" onclick="ShowSecurityNotes()">Read More</span></span> 
                                        @if ($errors->has('dbPort'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbPort') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbDatabase" class="col-md-3 col-form-label text-md-right">Database</label>
                                    
                                    <div class="col-md-8">
                                        <input id="dbDatabase" type="text" class="form-control{{ $errors->has('dbDatabase') ? ' is-invalid' : '' }}" name="dbDatabase" required value="">
                                        <span class="small">The name of the database on the SQL Server to connect to</span>
                                        @if($errors->has('dbDatabase'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbDatabase') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbUser" class="col-md-3 col-form-label text-md-right">User</label>
                                    
                                    <div class="col-md-8">
                                        <input id="dbUser" type="text" class="form-control{{ $errors->has('dbUser') ? ' is-invalid' : '' }}" name="dbUser" required value="">
                                        <span class="small">The SQL user to use to login to this database</span>
                                        @if ($errors->has('dbUser'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbUser') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="dbPassword" class="col-md-3 col-form-label text-md-right">Password</label>
                                    <div class="col-md-8">
                                        <input id="dbPassword" type="password" class="form-control{{ $errors->has('dbPassword') ? ' is-invalid' : '' }}" name="dbPassword" required value="">
                                        <span class="small">The SQL password for this user</span>
                                        @if($errors->has('dbPassword'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbPassword') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                
                            </form>
                            
                        </fieldset>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="security-notes-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h2 class="modal-title"><i class="fa fa-lock mr-2"></i><span>Security</span></h2>
                        <i title="Close this window" class="top-right fa fa-times-circle fa-2x text-danger cp" data-dismiss="modal"></i>
                    </div>
                    
                    <div class="modal-body" p-3>
                        <h4>
                            <p>Security is an important consideration for web-based systems.</p>
                            <p>For LegalSuite Onine to display your data, however, it needs access to your SQL Server database.</p>
                            <p>To enable this, you must allow an external connection to your SQL Server by opening port 1433.</p>
                            <p>It is important, however, that when you open this port, you <em>restrict</em> it to only accept requests from <strong>legalsuiteonline.co.za</strong> by adding a rule to your firewall.</p>
                            <p>This will ensure that no one else will have access to your Server through port 1433 except the LegalSuite Onine web site.</p>
                            <p>Please consult with your IT support department for assistance in this regard.</p>
                        </h4>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle fa-lg"></i> Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="modal" id="checkConnectionModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h2 class="modal-title"><i class="fa fa-check-circle fa-lg mr-2"></i><span>Checking Connection</span></h2>
                    </div>
                    
                    <div class="modal-body" p-3>
                        <h3>Please wait..</h3>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script>
        function ShowSecurityNotes() {
            $('#security-notes-modal').modal('show');
        }
    </script>
    @endsection
    