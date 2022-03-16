<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>DropDown Feature</h1>
            <div class="form-group">
                <label for="country">Select your Country</label>
                <select name="state" id="state" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($states as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                     </select>    
            </div>
              <div class="form-group">
                <label for="state">Select your State</label>
                <select name="lg" id="lg" class="form-control">
                    <option value="">Select State</option>   
                </select>    
            </div>
            <div class="form-group">
                <label for="city">Select your City</label>
                <select name="ward" id="ward" class="form-control">
                <option value="">Select City</option>   
                </select>    
            </div>
        </div>
       <script src="{{asset('js/jquery.js')}}"></script>
       <script>
           $(document).ready(function(){
            $('select[name="state"]').on('change',function(){
                var state_id= $(this).val();
                if (state_id) {
                 $.ajax({
                    url: "{{url('/getLocalgovernments/')}}/"+state_id,
                  type: "GET",
                  dataType: "json",
                  success: function(data){
                    console.log(data);
                    $('select[name="lg"]').empty();
                    $.each(data,function(key,value){
                        $('select[name="lg"]').append('<option value="'+key+'">'+value+'</option>');
                    });
                  }
                 });
                }else {
                     $('select[name="lg"]').empty();
               }
           });
             $('select[name="lg"]').on('change',function(){
                var lg_id= $(this).val();
                if (lg_id) {
                 $.ajax({
                    url: "{{url('/getWards/')}}/"+lg_id,
                  type: "GET",
                  dataType: "json",
                  success: function(data){
                    console.log(data);
                    $('select[name="ward"]').empty();
                    $.each(data,function(key,value){
                        $('select[name="ward"]').append('<option value="'+key+'">'+value+'</option>');
                    });
                  }
                 });
                }else {
                     $('select[name="ward"]').empty();
               }
           });
           });
       </script>
    </body>
</html>