<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
     
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
      
        
        <link href="{{asset('public/css/style.css')}}" rel="stylesheet">



    </head>
<body>
    <div class="container main-contain-box">
        <div class="row text-center ">
            <h1 class="heading-meeting col-md-12 text-center" > <i class="fa fa-check" aria-hidden="true"></i>
                You are scheduled</h1>
            <p > A calender invitation has been send to your email address .</p>
        
            <div class="col-md-12 text-center"><a href="#" class="scheduled-button">
                Open invitation <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            </p>
            </div>
        </div>
        <div class="row-center">
            <div class="offset-4 col-md-5 main-contain-box ">
                <h5 class="scheduled-heading">{{$Metting->duration}} Meeting
                </h5>
                <div class="text-normal">
                    <span>
                        <i class="fa fa-user" aria-hidden="true"></i>

                    </span>{{$Metting->name}}
                </div>
                
                <div class="text-normal mt-10">
                    <span>
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    </span>{{ date('h:iA',  strtotime($Metting->start_time)) }} - {{ date('h:iA',  strtotime($Metting->finish_time)) }} , {{ date('l F j, Y',  strtotime($Metting->start_time)) }} 
                </div>
                <div class="text-normal mt-10">
                    <span>
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </span> Indian Standard Time
                </div>
            </div>
        </div>

    </div>

    
   
