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

    <div class="container">
        <div class="row box-layout mt-5">
            <div class="col-lg-4" style="border-right:1px solid #ccc;">
            <div class="row">
                <div class="btn-white-text col-md-2 user-detail-container" style="display: none;" onclick="$('.user-detail-container').toggle('slow'); $('.slot-container').toggle('slow'); $('.next-detail').addClass('d-none') ">Back</div>
            </div>
                <p class="text-normal">{{$user->name}}</p>
                <h4>{{$event->name}} </h4>
                <span class="text-normal">
                    <span>
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span>{{$event->duration}} @if($event->duration_type == "min") Minutes  @else hrs  @endif
                </span>

                <!-- <p class="text-normal mt-30">Former Time (new 1234567890)</p> -->
                <div class="text-normal next-detail d-none">
                    <span>
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    </span> 
                    <spna class="full-time">  </spna>
                </div>
                <p class="text-normal mt-10 d-none next-detail">
                    <span>
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </span> Indian Standard Time
                </p>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 slot-container toggle">
                <!-- <div class="text">Reschudule Event</div> -->
                <h5 class="select-text">Select Date & Time</h5>

                <div class="calendar">
                    <div class="calendar__month">
                        <div class="cal-month__previous"><</div>
                        <div class="cal-month__current"></div>
                        <div class="cal-month__next">></div>
                    </div>
                    <div class="calendar__head">
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                        <div class="cal-head__day"></div>
                    </div>
                    <div class="calendar__body">
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                        <div class="cal-body__week">
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                            <div class="cal-body__day"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 user-detail-container toggle" style="display: none;">
                <div class="row ">
                    <h1 class="heading-meeting col-md-12 ">Enter Details </h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('submit-schedule-detail')}}" method="post" >
                            @csrf
                            <input type="hidden" name="duration" value="{{$event->duration}} {{$event->duration_type}}"  />
                            <input type="hidden" name="appointment_id" value="{{$event->id}}"  />
                            <input type="hidden" name="start_time" id="start_time" />
                            <input type="hidden" name="finish_time" id="finish_time" />
                            <div class="">
                                <label class="share-heading">Name*</label><br>
                                <input type="text" class="form-group" name="name" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="" required>
                            </div>

                            <div class="mt-10">
                                <label class="share-heading">Email*</label><br>
                                <input type="email" name="email" class="form-group" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="" required>
                            </div>
                          
                            <div class="share-heading mt-30 col-md-5">
                                Please share anything that will help prepare for our meeting.
                            </div>
                            <div class="col-md-5 mt-10 ">
                                <textarea name="comments" placeholder="" cols="50" rows="40"
                                    class="p-tb form-group"></textarea>
                            </div>
                            <div class="row mt-30">
                                <p>By proceeding, you confirm that have read and agree to<br><span class="text-blue">
                                        appointment's Terms of Use </span>and <span class="text-blue">Privacy
                                        Notice.</span></p>

                            </div>
                            <div class="row">
                                <button class="btn-white-text col-md-3" type="submit">  Event </button>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>
            <div class="col-lg-3 slot-container ">
                <div class="text display-selected "></div>
                    <div id="display_slot">
                        <!-- <div class="time mt-30 ">1:30pm</div> -->
    
                        <!-- <div class="mt-30 row">
                            <div  class=" col-md-6"><span class="back-g">2:00pm</span></div>
                            <div class=" col-md-6"><span class="back-b">Next</span></div>
                        </div> -->
                    </div>
                  
                  
                </div>
            </div>

        </div>
    </div>


    <script src='https://momentjs.com/downloads/moment-with-locales.js'></script>
   
    <script>
        function getAvailableSolt(date){
            $.ajax({
                url: "{{route('available-slot')}}",
                cache: false,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "date": date
                },
                success: function(responce)
                {
                    html = '';
                    $.each(responce.data, function (indexInArray, valueOfElement) { 
                        // html += `<div class="time mt-30 col-12">${valueOfElement}</div>`;     
                        html += ` <div class="time mt-30 col-12 main-slot" atr="${indexInArray}" id="slot_i_${indexInArray}"><a>${valueOfElement.slot}</a></div>
                                    <div class="mt-30 row sub-slot toggle " style="display: none;" id="slot_${indexInArray}">
                                        <div  class=" col-md-7 slots s_${indexInArray}" atr="${indexInArray}"><a href="#" ><span class="back-g">${valueOfElement.slot}</span></a></div>
                                        <div class=" col-md-5"><span class="back-b" onclick="$('.user-detail-container').toggle('slow'); $('.slot-container').toggle('slow');  $('.next-detail').removeClass('d-none'); $('.full-time').text('${valueOfElement.slot} ${$('.display-selected').text()}'); $('#start_time').val('${valueOfElement.start_time}'); $('#finish_time').val('${valueOfElement.finish_time}');" >Next</span></div>
                                    </div>`;     
                    });
                    $("#display_slot").html(html)
                }, 
            });
        }
        $(document).on("click" , ".main-slot" , function(){
            let index = $(this).attr('atr');
            $(".sub-slot").attr('style','display: none;');
            $(".main-slot").attr('style','');
            $(this).toggle('slow');
            $(`#slot_${index}`).toggle('slow');
        });
      
    </script>
     <script src="{{ asset('js/custom.js')}}"></script>



</body>
        </html>