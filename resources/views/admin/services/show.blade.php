@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           Id
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Name
                        </th>
                        <td>
                            {{ $service->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Link
                        </th>
                        <td>
                            {{ $service->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection