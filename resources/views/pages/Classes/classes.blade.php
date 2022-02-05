@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.Classes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.Classes') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('classes_trans.add_class') }}
            </button>
            <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('classes_trans.delete_checkbox') }}
            </button>
            <br><br>
                <form action="{{ route('Filter_Classes') }}" method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker" data-style="btn-info" name="grade_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('classes_trans.Search_By_Grade') }}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </form>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ __('classes_trans.Name') }}</th>
                            <th>{{ __('classes_trans.Notes') }}</th>
                            <th>{{ __('classes_trans.Name_Grade') }}</th>
                            <th>{{ __('classes_trans.Operations') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (isset($details))
                        <?php $List_Classes = $details; ?>
                    @else
                        <?php $List_Classes = $classrooms; ?>
                    @endif

                        <?php $i = 0; ?>
                        @foreach ($List_Classes as $classroom)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $classroom->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $classroom->name }}</td>
                                <td>{{ $classroom -> notes }}</td>
                                <td>{{ $classroom->grade->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $classroom->id }}"
                                        title="{{ __('classes_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $classroom->id }}"
                                        title="{{ __('classes_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                     <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('classes_trans.edit_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('classrooms.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name_ar"
                                                               class="mr-sm-2">{{ trans('classes_trans.class_name_ar') }}
                                                            :</label>
                                                        <input id="name_ar" type="text" name="name_ar"
                                                               class="form-control"
                                                               value="{{ $classroom->getTranslation('name', 'ar') }}"
                                                               required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $classroom->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="name_en"
                                                               class="mr-sm-2">{{ trans('classes_trans.class_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $classroom->getTranslation('name', 'en') }}"
                                                               name="name_en" required>
                                                    </div>
                                                    
                                                </div><br>
                                                <div class="col">
                                                        <label for="notes"
                                                               class="mr-sm-2">{{ trans('classes_trans.Notes') }}
                                                            :</label>
                                                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                                             rows="3"></textarea>
                                                    </div><br>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('classes_trans.Name_Grade') }}
                                                        :</label>
                                                    <select class="form-control form-control-lg"
                                                            id="exampleFormControlSelect1" name="grade_id">
                                                        <option value="{{ $classroom->grade->id }}">
                                                            {{ $classroom->grade->name }}
                                                        </option>
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">
                                                                {{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('classes_trans.Save') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                          <!-- delete_modal_Grade -->
                          <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('classes_trans.delete_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('classrooms.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('classes_trans.Warning_class') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $classroom->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('classes_trans.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   {{ trans('classes_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label for="name_ar"
                                                class="mr-sm-2">{{ trans('classes_trans.class_name_ar') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_ar" />
                                        </div>

                                        <div class="col">
                                            <label for="name_en"
                                                class="mr-sm-2">{{ trans('classes_trans.class_name_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_en" />
                                        </div>
                                        
                                        
                                        <div class="col">
                                            <label for="notes"
                                                class="mr-sm-2">{{ trans('classes_trans.Notes') }}
                                                :</label>
                                            <input class="form-control" type="text" name="notes" />
                                        </div>


                                        <div class="col">
                                            <label for="grade_name"
                                                class="mr-sm-2">{{ trans('classes_trans.Name_Grade') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="operation"
                                                class="mr-sm-2">{{ trans('classes_trans.Operations') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('classes_trans.Delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_class') }}"/>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('classes_trans.Save') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
</div>
<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classes_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('classes_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('classes_trans.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>



</div>

</div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>
@endsection