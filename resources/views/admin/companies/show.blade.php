@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.companies.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.companies.fields.company-logo')</th>
                            <td field-key='company_logo'>@if($company->company_logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $company->company_logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $company->company_logo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.companies.fields.name')</th>
                            <td field-key='name'>{{ $company->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.companies.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($company->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.companies.fields.photos')</th>
                            <td field-key='photos'> @foreach($company->getMedia('photos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.companies.fields.address')</th>
                            <td field-key='address'>{{ $company->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.companies.fields.country')</th>
                            <td field-key='country'>{{ $company->country }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.companies.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


