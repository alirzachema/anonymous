<tr data-index="{{ $index }}">
    <td>{!! Form::text('companies['.$index.'][name]', old('companies['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('companies['.$index.'][address]', old('companies['.$index.'][address]', isset($field) ? $field->address: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('companies['.$index.'][country]', old('companies['.$index.'][country]', isset($field) ? $field->country: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>