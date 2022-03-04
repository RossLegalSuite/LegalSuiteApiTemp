@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form id="register-form" method="POST" action="{{ route('updateClient') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        
                        <a href="{{ URL::previous() }}" style="margin-right: 0.5rem;"><i class="fa fa-2x fa-arrow-left"></i></a>
                        <h2 class="d-inline-block">Database Access Details </h2>
                    </div>
                    
                    <div class="card-body py-3">
                        
                        <div class="row justify-content-center">
                            
                            <div class="col-md-12">
                                
                                <div class="mb-3">Some Apps use the LegalSuite Api to enhance the functionality of the LegalSuite program. 
                                    To do this, they need to have acccess to your LegalSuite database.
                                    To ensure your database connection details are private and secure, however, you need to enter them here. 
                                    The 3rd party app developers <strong><em>do not</em></strong> have access to these details.
                                    Please also specify which Apps are allowed to View, Insert, Update and/or Delete data on your system.
                                    To prevent access to your system, simply untick all levels of access for a particular App.
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <legend>&nbsp;&nbsp;Database Details&nbsp;&nbsp;</legend>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="dbHost" class="col-md-3 col-form-label text-md-right">Server</label>
                                                <div class="col-md-8">
                                                    <input id="dbHost" type="text" class="form-control {{ $errors->has('dbHost') ? ' is-invalid' : '' }}" name="dbHost" required value="{{ Auth::user()->dbHost }}">
                                                    <span class="small">The URL or IP address of the server which hosts the LegalSuite database</span>                                                
                                                    @if($errors->has('dbHost')) <span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('dbHost') }}</strong> </span> @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="dbPort" class="col-md-3 col-form-label text-md-right">Port</label>
                                                
                                                <div class="col-md-8">
                                                    <input id="dbPort" type="text" class="form-control{{ $errors->has('dbPort') ? ' is-invalid' : '' }}" name="dbPort" required value="{{ Auth::user()->dbPort }}">
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
                                                    <input id="dbDatabase" type="text" class="form-control{{ $errors->has('dbDatabase') ? ' is-invalid' : '' }}" name="dbDatabase" required value="{{ Auth::user()->dbDatabase }}">
                                                    <span class="small">The name of the database on the SQL Server to connect to</span>
                                                    @if($errors->has('dbDatabase'))
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbDatabase') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="dbUser" class="col-md-3 col-form-label text-md-right">User</label>
                                                
                                                <div class="col-md-8">
                                                    <input id="dbUser" type="text" class="form-control{{ $errors->has('dbUser') ? ' is-invalid' : '' }}" name="dbUser" required value="{{ Auth::user()->dbUser }}">
                                                    <span class="small">The SQL user to use to login to this database</span>
                                                    @if ($errors->has('dbUser'))
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbUser') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="dbPassword" class="col-md-3 col-form-label text-md-right">Password</label>
                                                <div class="col-md-8">
                                                    <input id="dbPassword" type="password" class="form-control{{ $errors->has('dbPassword') ? ' is-invalid' : '' }}" name="dbPassword" required value="{{ Auth::user()->dbPassword }}">
                                                    <span class="small">The SQL password for this user</span>
                                                    @if($errors->has('dbPassword'))
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('dbPassword') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="button" onclick="testLogin()" class="btn btn-lg btn-primary"><i class="fa fa-database"></i> Test Login</button>
                                                </div>
                                                <div>
                                                    <button type="button" onclick="submitForm()" class="btn btn-lg btn-success"><i class="fa fa-check-circle"></i> Save</button>                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </fieldset>
                                        
                                        
                                      
                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            
                                            
                                                <fieldset>
                                                    <legend>&nbsp;&nbsp;Account Details&nbsp;&nbsp;</legend>
                                                    
                                                    <div class="form-group row ">
                                                        <div class="container">
                                                        
                                                                <div class="col-xs-12">
                                                                    <div class="form-group row">
                                                                        <label for="company_name" class="col-md-3 col-form-label text-md-right">Company Name</label>
                                                                        <div class="col-md-8">
                                                                            <input readonly id="company_name" type="text" class="form-control" name="company_name" value="{{ Auth::user()->company_name }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row ">
                                                        <div class="container">
                                                            
                                                                <div class="col-xs-12">
                                                                    <div class="form-group row">
                                                                        <label for="name" class="col-md-3 col-form-label text-md-right">Firm Code</label>
                                                                        <div class="col-md-8">
                                                                            <input readonly id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->firmcode }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                </fieldset>
                                                
                                                
                                                
                                           
                                            <fieldset class="mt-3">
                                                <legend>&nbsp;&nbsp;3rd Party Apps&nbsp;&nbsp;</legend>
                                                {{-- <div class="form-group row">
                                                    @if((session('developer')->isNotEmpty()))
                                                    <label class="row m-3">Developers</label>
                                                    <div class="col-md-6 m-1">
                                                        
                                                        <select class="form-control" 
                                                        id="developer_list" 
                                                        name="developer_list">
                                                        @foreach(session('developer') as $developer)
                                                        
                                                        <option value={{$developer->id}}>{{$developer->company_name}}</option>   
                                                        
                                                        @endforeach
                                                        
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div>
                                                    <button type="button" onclick="addDeveloper()" class="m-1 btn btn-md btn-success"><i class="fa fa-check-circle"></i> Add</button>                    </div>
                                                </div>
                                                @endif --}}
                                                <div class="form-group row">
                                                    
                                                    
                                                    <div class="container">
                                                        <div class="row m-3">
                                                            <div class="col-xs-12">
                                                                <table id="developerAccess" class="table table-bordered table-hover dt-responsive">
                                                                    
                                                                    <thead>
                                                                        <tr>
                                                                            <th> App </th>
                                                                            <th> Access Type</th>
                                                                            <th> Grant Access</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                        @foreach(session('apiAccessTable') as $apiAccessTable)
                                                                        <tr>
                                                                            <td value= {{$apiAccessTable->devId}} > {{$apiAccessTable->company_name}} </td>
                                                                            <td> Read Only* </td>
                                                                            <td style="text-align: center; vertical-align: middle;"> <input name="grantAccess" onclick="checkBoxClicked(this)" class="" type="checkbox"  {{ $apiAccessTable->grantAccess ? 'checked' : '' }}></td>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                        </tr>
                                                                        @endforeach
                                                                        
                                                                    </tbody>
                                                                    
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <table id="developerAccess" class="table bordered" style="width:100%"></table> --}}
                                                </div>
                                                
                                                
                                                
                                            </fieldset>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                            
                        </div>
                        
                        <div class="card-footer ">   
                            
                            <div class="col-lg-4">
                                {{-- class="col-lg-6 mt-3 mt-lg-0" --}}
                                {{-- <div class="d-flex justify-content-between"> --}}
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="administrator-notes-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h2 class="modal-title"><i class="fa fa-user-secret mr-2"></i><span>Administrator</span></h2>
                        <i title="Close this window" class="top-right fa fa-times-circle fa-2x text-danger cp" data-dismiss="modal"></i>
                    </div>
                    
                    <div class="modal-body" p-3>
                        <h4>
                            <p>The Supervisor is responsible for maintaining the database connection to the Company's LegalSuite database.</p>
                            <p>The Supervisor can add and remove users and also restrict their access to certain dashboards and widgets if necessary.</p>
                            <p>The Supervisor must have Supervisory rights in LegalSuite to register a Company and maintain it.</p>
                        </h4>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle fa-lg"></i> Close</button>
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
        
        @endsection
        
        
        @section('scripts')
        
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
        
        <script>
            $(document).ready(function() {
                $('#developerAccess').DataTable();
            });
        </script> --}}
        
        <script>
            console.log('load reg');
            // Data for testing....
            
            
            
            function ShowAdministratorNotes() {
                $('#administrator-notes-modal').modal('show');
            }
            
            function ShowSecurityNotes() {
                $('#security-notes-modal').modal('show');
            }
            
            function submitForm() {
                
                if ( checkData() === true ) {
                    
                    let promise = checkConnection(true);
                    
                    promise
                    
                    .then(function(result) { 
                        
                        $('#register-form').submit();
                        
                    })
                    
                    .catch(function(error) {
                        
                        $('#messageModalTitle').removeClass('text-success').addClass('text-danger');
                        $('#messageModalTitleText').text('Unable To Connect');
                        $('#messageModalTitleIcon').removeClass('fa-check-circle').addClass('fa-times-circle');
                        $('#messageModalBody').html('An error was encountered trying to connect to the server. Check your settings and try again.<br><br><strong>Error:</strong> ' + error);
                        $('#messageModal').modal('show');
                        
                    });    
                    
                }
                
            }; 
            
            function checkData() {
                
                
                
                if ( ! $("#dbHost")[0].checkValidity() ) {
                    validationError('Please enter the url of server where the SQL database is hosted'); 
                    return false;
                }
                if ( ! $("#dbPort")[0].checkValidity() ) {
                    validationError('Please enter the port the server is listening on for SQL connections'); 
                    return false;
                }
                if ( ! $("#dbDatabase")[0].checkValidity() ) {
                    validationError('Please enter the name of the database to connect to'); 
                    return false;
                }
                if ( ! $("#dbUser")[0].checkValidity() ) {
                    validationError('Please enter the database user'); 
                    return false;
                }
                if ( ! $("#dbPassword")[0].checkValidity() ) {
                    validationError('Please enter the database password'); 
                    return false;
                }
                
                return true;
            }    
            
            function checkBoxClicked(el) {
                
                let clientId = "{{ Auth::user()->id }}";
                let developerId = el.parentNode.parentNode.cells[0].getAttribute('value');
                let flagType = el.getAttribute('name');
                let flagCheck = el.checked;
                console.log('clientId',clientId);
                console.log('developerId',developerId);
                console.log('flagType',flagType);
                console.log('flagCheck',flagCheck);
                axios.post('/setApiAccess', { 
                    
                    clientId : clientId,
                    developerId : developerId,
                    flagType : flagType,
                    flagCheck : flagCheck,
                    
                    
                })        
                
                .then(response => {
                    window.location.reload();
                    $('#messageModal').modal('hide');
                    
                    let data = response.data;
                    
                    if (data.error) {
                        
                        reject(data.error);
                        
                    }
                    
                })
                
                .catch(function (error) {
                    // window.location.reload();
                    $('#messageModal').modal('hide');
                    
                    
                    
                });     
                
                
                
            }
            // function addDeveloper() {
                
                //     let clientId = "{{ Auth::user()->id }}";
                //     let developerId = $("#developer_list").val();
                //     let deleteAccessFlag = 1;
                //     let putAccessFlag = 1;
                //     let postAccessFlag = 1;
                //     let getAccessFlag = 1;
                
                //     $('#messageModalTitleText').text('Adding Developer');
                //     $('#messageModalTitle').removeClass('text-danger').addClass('text-primary');
                //     $('#messageModalTitleIcon').removeClass('fa-times-circle').addClass('fa-check-circle');
                //     $('#messageModalBody').text('Loading');
                //     $('#messageModal').modal('show');
                
                
                //     axios.post('/setApiAccess', { 
                    
                    //         clientId : clientId,
                    //         developerId : developerId,
                    //         deleteAccessFlag : deleteAccessFlag,
                    //         putAccessFlag : putAccessFlag,
                    //         postAccessFlag : postAccessFlag,
                    //         getAccessFlag : getAccessFlag
                    //     })        
                    
                    //     .then(response => {
                        //         window.location.reload();
                        //         $('#messageModal').modal('hide');
                        
                        //         let data = response.data;
                        
                        //         if (data.error) {
                            
                            //             reject(data.error);
                            
                            //         }
                            
                            //     })
                            
                            //     .catch(function (error) {
                                //         window.location.reload();
                                //         $('#messageModal').modal('hide');
                                
                                
                                
                                //     });     
                                
                                
                                // }
                                
                                function testLogin() {
                                    
                                    if ( checkData() === true ) {
                                        
                                        let promise = checkConnection(false);
                                        
                                        promise
                                        
                                        .then(function(result) { 
                                            
                                            $('#messageModalTitleText').text('Success');
                                            $('#messageModalTitle').removeClass('text-danger').addClass('text-success');
                                            $('#messageModalTitleIcon').removeClass('fa-times-circle').addClass('fa-check-circle');
                                            $('#messageModalBody').text('You connected successfully.');
                                            $('#messageModal').modal('show');
                                            
                                        })
                                        
                                        .catch(function(error) {
                                            
                                            $('#messageModalTitleText').text('Unable To Connect');
                                            $('#messageModalTitle').removeClass('text-success').addClass('text-danger');
                                            $('#messageModalTitleIcon').removeClass('fa-check-circle').addClass('fa-times-circle');
                                            $('#messageModalBody').html('An error was encountered trying to connect to the server.<br><br><strong>Error:</strong> ' + error);
                                            $('#messageModal').modal('show');
                                            
                                        });    
                                        
                                    }
                                    
                                }
                                
                                
                                function checkConnection() {
                                    
                                    return new Promise( function(resolve, reject) {
                                        
                                        $('#checkConnectionModal').modal('show');
                                        
                                        let companyName = $("#companyName").val();
                                        
                                        axios.post('/test-database-connection', { 
                                            
                                            userID : "{{ Auth::user()->id }}",
                                            companyName:  companyName,
                                            
                                            dbHost: $("#dbHost").val(),
                                            dbPort: $("#dbPort").val(),
                                            dbDatabase: $("#dbDatabase").val(),
                                            dbUser: $("#dbUser").val(),
                                            dbPassword: $("#dbPassword").val(),
                                        })        
                                        
                                        .then(response => {
                                            
                                            $('#checkConnectionModal').modal('hide');
                                            
                                            let data = response.data;
                                            
                                            if (data.error) {
                                                
                                                reject(data.error);
                                                
                                            } else {
                                                
                                                // $("#name").val(data.employee.Name);
                                                
                                                resolve(companyName);
                                                
                                            }    
                                            
                                        })
                                        
                                        .catch(function (error) {
                                            
                                            $('#checkConnectionModal').modal('hide');
                                            
                                            reject(error);
                                            
                                        });     
                                        
                                    });    
                                    
                                }
                                
                                function validationError(message) {
                                    
                                    $('#messageModalTitleText').text('Incomplete Information');
                                    $('#messageModalTitle').removeClass('text-success').addClass('text-danger');
                                    $('#messageModalTitleIcon').removeClass('fa-check-circle').addClass('fa-times-circle');
                                    $('#messageModalBody').html(message);
                                    $('#messageModal').modal('show');
                                    
                                }
                                
                                
                                
                            </script>
                            @endsection
                            