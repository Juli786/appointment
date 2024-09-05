@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.appointments.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Appointment">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                       id
                    </th>
                    <th>
                       Name
                    </th>
                    <th>
                       Duration
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>


    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
  
    <div class="container">
        
        <div class="row">
            <div class="main-contain-box col-md-12 ">
                <div class="row ">
                    <h1 class="heading-meeting col-md-12 duration"> </h1>
                </div>
                <div class="row border-bottom">
                    <div  class="text-normal col-md-2">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                       <span class="sm_duration"></span>
                    </div>
                
                    <div class="col-md-2 text-normal">
                        No location
                    </div>
                </div>  
                
    
                    <div class="row col-md-12 text-center border-bottom">
                        <div class=" col-md-4 "> <span class="share">Share a link</span></div>
                    </div>
                    <div class="row">
                        <div class="text col-md-7 text-center ">Copy and paste scheduling link into a message</div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="path offset-0 col-md-10 col-12 "><span style="font-size: medium;" class="schedule-url"></span>
                            <div class=" col-md-3 button col-2 copy-link" onclick="">Copy link</div>
                        </div>
                      
                    </div>
                    </div> 
                    <div class="row">
                        <div class="text-normal-right offset-5 col-md-4 ">Let this link expire after booking</div>

                    </div>
                                  
            </div>
        </div>
    </div>
              
    </div>
  </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.appointments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.appointments.index') }}",
    columns: [
       { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'duration', name: 'duration' },
        { data: 'actions', name: 'actions' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Appointment').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

function openModel(url,duration, sm_duration) {
    
    $(".bd-example-modal-lg").modal('show');
    $('.duration').text(`${duration} metting`)
    $('.sm_duration').text(`${sm_duration}`)
    $(".schedule-url").text(url.substring(0, 50) + '...')
    $(".copy-link").attr('onclick' , `copyURL('${url}')`)
}
function copyURL(url) {
   
    navigator.clipboard.writeText(url)
        .then(() => {
            alert('URL copied to clipboard!');
        })
        .catch(err => {
            console.error('Failed to copy: ', err);
        });
}
</script>
@endsection