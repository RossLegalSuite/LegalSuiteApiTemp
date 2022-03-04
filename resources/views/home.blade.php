@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            
            @if (session('user_type') == 'client'|| is_null(session('user_type')))
            @include('registerDatabase')
            {{-- <user-app></user-app> --}}
            @endif
            
            @if (session('user_type') == 'developer')
            @include('developerHome')
            {{-- <developer-app></developer-app> --}}
            @endif
            
            @if (session('user_type') == 'admin')
            <h3>Admin Logged in</h3>
            <admin-app></admin-app>
            @endif
            {{-- @else --}}
            {{-- <h3>Something went wrong.</h3> --}}
            {{-- <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    You are logged in!
                </div>
            </div> --}}
            
        </div>
    </div>
</div>
@endsection
@yield('scripts')

<script>
    var user_type = '{{session('user_type')}}';
    
    // console.log('user_type:',user_type);
</script>

