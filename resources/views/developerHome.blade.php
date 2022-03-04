@section('content')
<div class="container-fluid">
    {{-- <div class="row justify-content-center">
        <div class="col-md-12"> --}}
            <div class="mx-5">
                
                <div class="card">
                    <div class="card-header">
                        
                        <a href="{{ URL::previous() }}" style="margin-right: 0.5rem;"><i class="fa fa-2x fa-arrow-left"></i></a>
                        <h2 class="d-inline-block">LegalSuite Api Users</h2>
                    </div>
                    
                    <div class="card-body py-3">
                        
                        <div class="justify-content-center1">
                            
                            <div class="text-right mb-3">
                                <span class="mr-5">
                                    <input class="form-check-input" type="radio" name="clientType" value="myClients" onclick="handleClick(this)" checked>
                                    <label class="form-check-label" for="myClients">
                                        My Clients
                                    </label>
                                </span>
                                <span>
                                    <input class="form-check-input" type="radio" name="clientType" value="allClients" onclick="handleClick(this)">
                                    <label class="form-check-label" for="allClients">
                                        All Clients
                                    </label>
                                    
                                </span>
                            </div>
                            
                            <div  id="myClients" class="col-xs-12" style="overflow-x:auto;">
                                <table id="developerAccess"  class="table table-bordered table-hover" style="table-layout: fixed;">
                                    {{-- style="text-align: center; vertical-align: middle;" --}}
                                    <thead>
                                        <tr>
                                            <th> Client </th>
                                            <th> Contact </th>
                                            <th> Email </th>
                                            <th> Website </th>
                                            <th style="text-align: center; width: 10%">Access Granted</th>
                                            {{-- <th style="text-align: center; width: 6%">Read</th>
                                            <th style="text-align: center; width: 6%">Insert </th>
                                            <th style="text-align: center; width: 6%">Update </th>
                                            <th style="text-align: center; width: 6%">Delete</th> --}}
                                            {{-- <th> API Key</th> --}}
                                            <th style="text-align: center; width: 10%">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        @foreach(session('myClients') as $myClients)
                                        <tr>
                                            <td value= {{$myClients->clientId}} > {{$myClients->company_name}} </td>
                                            <td > {{$myClients->name}} </td>
                                            <td ><a href="mailto:{{$myClients->email}}">{{$myClients->email}}</a>  </td>
                                            <td > <a href="{{$myClients->website}}">{{$myClients->website}}</a> </td>
                                            
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="grantAccess" disabled class="" type="checkbox"  {{ $myClients->grantAccess ? 'checked' : '' }}></td>
                                            {{-- <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="getAccessFlag" disabled class="" type="checkbox"  {{ $myClients->getAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="postAccessFlag" disabled class="" type="checkbox"  {{ $myClients->postAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="putAccessFlag" disabled class="" type="checkbox"  {{ $myClients->putAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="deleteAccessFlag" disabled class="" type="checkbox"  {{ $myClients->deleteAccessFlag ? 'checked' : '' }}></td> --}}
                                            <td style="text-align: center; vertical-align: middle;"> <button class="btn btn-success btn-sm" type="button" data-apikey="{{ $myClients->api_token }}"  name="CopyButton" onclick="copyClicked(this)" title="{{ $myClients->api_token }}">Copy API Key</button> </td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                            
                            
                            
                            <div id="allClients" style="overflow-x:auto; display:none" class="col-xs-12">
                                <table id="developerAccess"  class="table table-bordered table-hover">
                                    {{-- style="text-align: center; vertical-align: middle;" --}}
                                    <thead>
                                        <tr>
                                            <th> Client </th>
                                            <th> Contact </th>
                                            <th> Email </th>
                                            <th> Website </th>
                                            {{-- <th style="text-align: center; width: 6%">View</th> --}}
                                            {{-- <th style="text-align: center; width: 6%">Insert </th> --}}
                                            {{-- <th style="text-align: center; width: 6%">Update </th> --}}
                                            {{-- <th style="text-align: center; width: 6%">Delete</th> --}}
                                            {{-- <th> API Key</th> --}}
                                            {{-- <th style="text-align: center; width: 10%">Action</th> --}}
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        @foreach(session('allClients') as $allClients)
                                        <tr>
                                            <td value= {{$allClients->id}} > {{$allClients->company_name}} </td>
                                            <td > {{$allClients->name}} </td>
                                            <td ><a href="mailto:{{$allClients->email}}">{{$allClients->email}}</a>  </td>
                                            <td > <a href="{{$allClients->website}}">{{$allClients->website}}</a> </td>
                                            
                                            {{-- <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="getAccessFlag" disabled class="" type="checkbox"  {{ $allClients->getAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="postAccessFlag" disabled class="" type="checkbox"  {{ $allClients->postAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="putAccessFlag" disabled class="" type="checkbox"  {{ $allClients->putAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle; padding:0px !important"> <input name="deleteAccessFlag" disabled class="" type="checkbox"  {{ $allClients->deleteAccessFlag ? 'checked' : '' }}></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($allClients->api_token)
                                                <button class="btn btn-success btn-sm" type="button" data-apikey="{{ $allClients->api_token }}"  name="CopyButton" onclick="copyClicked(this)" title="{{ $allClients->api_token }}">Copy API Key</button> 
                                                @endif
                                            </td> --}}
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    
                                    
                                </table>
                            </div>
                            {{-- <table id="developerAccess" class="table bordered" style="width:100%"></table> --}}
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        
        @endsection
        
        
        @section('scripts')
        
        
        
        <script>
            
            
            
            
            
            
            
            function handleClick(clientType) {
                document.getElementById("myClients").style.display = 'none';
                document.getElementById("allClients").style.display = 'none';
                
                document.getElementById(clientType.value).style.display = 'block';
                
                
                
            }
            
            function copyClicked(e) {
                
                console.log('e', $(e.target) );
                
                
                
                // console.log('e',e.getAttribute('data-apikey'));
                
                
                //let developerId = el.parentNode.parentNode.cells[8].children[0].value;
                
                
                copyToClipboard(e.getAttribute('data-apikey'));
                
                
            }
            
            function copyToClipboard(text) {
                console.log(text);
                if (window.clipboardData && window.clipboardData.setData) {
                    // IE specific code path to prevent textarea being shown while dialog is visible.
                    return clipboardData.setData("Text", text); 
                    
                } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                    var textarea = document.createElement("textarea");
                    textarea.textContent = text;
                    textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                        return document.execCommand("copy");  // Security exception may be thrown by some browsers.
                    } catch (ex) {
                        console.warn("Copy to clipboard failed.", ex);
                        return false;
                    } finally {
                        document.body.removeChild(textarea);
                    }
                }
            }   
            
            
            
        </script>
        @endsection
        