@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.products.fields.name')</th>
                            <td field-key='name'>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.description')</th>
                            <td field-key='description'>{!! $product->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.price')</th>
                            <td field-key='price'>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.category')</th>
                            <td field-key='category'>
                                @foreach ($product->category as $singleCategory)
                                    <span class="label label-info label-many">{{ $singleCategory->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.tag')</th>
                            <td field-key='tag'>
                                @foreach ($product->tag as $singleTag)
                                    <span class="label label-info label-many">{{ $singleTag->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.photo1')</th>
                            <td field-key='photo1'>@if($product->photo1)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo1) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo1) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.photo2')</th>
                            <td field-key='photo2'>@if($product->photo2)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo2) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo2) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.photo3')</th>
                            <td field-key='photo3'>@if($product->photo3)<a href="{{ asset(env('UPLOAD_PATH').'/' . $product->photo3) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $product->photo3) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.products.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


