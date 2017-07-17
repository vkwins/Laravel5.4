@extends('layouts.app')
@section('content')
    <div class="container"> 
        <div class="title m-b-md">
            Tracked stocks Form Page
        </div>
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Tracked stocks</div>
                        
                </div>     

                <div style="padding-top:30px" class="panel-body" >
                    <div id="msg"  class="alert alert-success">
                        <strong>Success!</strong> Inserted successful</div>
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                    <form id="trakingcode" class="form-horizontal" role="form" method="get" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />        
                       
                        <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"></span>
                           <input id="tracked_code" type="text" class="form-control" name="tracked_code" placeholder="Tracked Code">

                        </div>
                        <div id="tracked_err" class="alert alert-warning" ></div>


                        <div style="margin-top:25px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                              <a id="btn-traking" href="#" > <button type="button" class="btn btn-success">Submit </button> </a>
                            </div>
                        </div>

                    </form>     

                </div>                     
            </div>  
        </div>


  <div class="container">

    
           
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#Cod</th>
          <th>Traking code</th>
          <th>open</th>
          <th>high</th>
          <th>low</th>
          <th>close</th>
        </tr>
      </thead>
      <tbody>
       @foreach($Arrtrakingdata as $Arrtrakingdatas)
        <tr>
          <td>1</td>
         
          <td><a herf="/traking-info-{{$Arrtrakingdatas->trakingcode}}_{{$Arrtrakingdatas->tid}}">{{$Arrtrakingdatas->trakingcode}}</a></td>
            @if(isset($Arrtrakingdatas->open) && !empty($Arrtrakingdatas->open))
                <td ><span class="badge">{{$Arrtrakingdatas->open}}</span></td>
                <td> <span class="badge">{{$Arrtrakingdatas->high}}</span></td>
                <td><span class="badge">{{$Arrtrakingdatas->low}}</span></td>
                <td><span class="badge">{{$Arrtrakingdatas->close}}</span></td>
            @else
                 <td>
                <a id="" href="/traking-info-{{preg_replace("/[\s_]/ ","-", $Arrtrakingdatas->trakingcode)}}_{{$Arrtrakingdatas->tid}}" > <button type="button" class="btn btn-success">Get Price </button> </a>
                </td>
            @endif
        </tr>
        @endforeach
             
      </tbody>
    </table>  
    
    
    
   
        
</div>

       
    </div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>

$(function() {
 document.getElementById("msg").style.display = "none";
 document.getElementById("tracked_err").style.display = "none";
$("a#btn-traking").click(function(event) {
   
    event.preventDefault();
    if(document.getElementById("tracked_code").value=="") 
    {
    document.getElementById("tracked_err").style.display = "inline";
    document.getElementById("tracked_err").innerHTML="Please enter  Traking code";
    return false;
      }
    else{
    document.getElementById("tracked_err").style.display = "none";

   
    $.ajax({
    url : "/trakingcode-info/", // the endpoint
    type : "GET", // http method
    data : $('#trakingcode').serialize(), // data sent with the post request
    
    cache: false,
    // handle a successful response
        success: function( response ) {
              
              document.getElementById("msg").style.display = "block";

             setTimeout(function() {
              window.location.reload(true);
            }, 4000);
            
           }
    
        });

        }
    });

 });

</script>

@endsection  
