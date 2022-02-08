@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<style>
    .scroll {
        margin:4px, 4px;
        padding:4px;
        height: 710px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align:justify;
    }
   
   
    </style>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card" style="font-size:12px;">
            <div class="card-header">
                <h3 class="card-title">Вагоны мэдээлэл</h3>
                <div class="card-tools">
                    <button class="btn btn-default btn-small right"  onclick="" data-toggle="modal" data-target="#wagonModal"><i class="fa fa-plus"></i> Вагон нэмэх</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                        <th>#</th>
                            <th>Төмөр замын код</th>
                            <th>Вагон №</th>
                            <th>Загвар</th>
                            <th>Ангилал</th>
                            <th>Үйлдвэрлэгч</th>
                            <th>Загвар</th>
                            <th>Ангилал</th>
                            <th>Үйлдвэрлэгч</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($wagons as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->rcode}}</td>
                            <td>{{$item->wag_no}}</td>
                            <td>{{$item->model}}</td>
                            <td>{{$item->category}}</td>
                            <td>{{$item->usr_name}}</td>
                            @if((Auth::user()->userlevel<>4) )
                        <td>
                            <button class='btn btn-primary btn-xs' onclick=depEdit('{{$item->depid}}') data-toggle='modal' data-target='#depModal' title='Засах'><i class='fa fa-edit'></i></button> 
                            <button class='btn btn-primary btn-xs' onclick="depDel('{{$item->depid}}','{{$item->department_name}}')" data-toggle='modal' title='Устгах'><i class='fa fa-trash-alt'></i></button>
                        </td>
                        @endif
                        </tr>
                        <?php $no++; ?>

                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Modal -->
        <div class="modal fade" id="wagonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Вагон бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action='savewagon'>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Төмөр зам</label>
                                <select class="form-control" name="rcode" id="rcode" >
                                @foreach ($railways as $item)
                                        <option value="{{ $item->rcode }}">{{ $item->rabbr }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Вагон дугаар</label>
                                <input type="text" class="form-control" id="wagno" name="wagno" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Загвар</label>
                                <select class="form-control" name="model_id" id="model_id" >
                                @foreach ($models as $item)
                                        <option value="{{ $item->model_id }}">{{ $item->model_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Төрөл</label>
                                <select class="form-control" name="catcode" id="catcode" >
                                @foreach ($categories as $item)
                                        <option value="{{ $item->catcode }}">{{ $item->abbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Үйлдвэрлэгч</label>
                                <select class="form-control" name="factory_code" id="factory_code" >
                                @foreach ($factories as $item)
                                        <option value="{{ $item->factory_code }}">{{ $item->factory_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Үйлдвэрлэсэн он</label>
                                <input type="text" class="form-control" id="factory_date" name="factory_date" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Голын тоо</label>
                                <input type="text" class="form-control" id="axes" name="axes" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Голын даац</label>
                                <input type="text" class="form-control" id="axe_capacity" name="axe_capacity" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Бохир жин</label>
                                <input type="text" class="form-control" id="brutto" name="brutto" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Цэвэр жин</label>
                                <input type="text" class="form-control" id="netto" name="netto" >
                            </div>
                        </div>
                         <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Баазын урт</label>
                                <input type="text" class="form-control" id="base_length" name="base_length" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тэнхлэгийн урт</label>
                                <input type="text" class="form-control" id="ram_length" name="ram_length" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Х/б овор</label>
                                <input type="text" class="form-control" id="carrying_capacity" name="carrying_capacity" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ачааны даац</label>
                                <input type="text" class="form-control" id="tare_weight" name="tare_weight" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Эзэлхүүн</label>
                                <input type="text" class="form-control" id="volume" name="volume" >
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Length_outer</label>
                                <input type="text" class="form-control" id="length_outer" name="length_outer" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Width_outer</label>
                                <input type="text" class="form-control" id="width_outer" name="width_outer" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Height_outer</label>
                                <input type="text" class="form-control" id="height_outer" name="height_outer" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Length_inner </label>
                                <input type="text" class="form-control" id="length_inner" name="length_inner" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Width_inner</label>
                                <input type="text" class="form-control" id="width_inner" name="width_inner" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Height_inner</label>
                                <input type="text" class="form-control" id="heigth_inner" name="heigth_inner" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хаалга</label>
                                <input type="text" class="form-control" id="door" name="door" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">number_of_hatches</label>
                                <input type="text" class="form-control" id="number_of_hatches" name="number_of_hatches" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">side_hatches</label>
                                <input type="text" class="form-control" id="side_hatches" name="side_hatches" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">roof_hatches</label>
                                <input type="text" class="form-control" id="roof_hatches" name="roof_hatches" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Шал</label>
                                <input type="text" class="form-control" id="floor_area" name="floor_area" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">number_of_side_boards</label>
                                <input type="text" class="form-control" id="number_of_side_boards" name="number_of_side_boards" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">number_of_side_rack_brackets</label>
                                <input type="text" class="form-control" id="number_of_side_rack_brackets" name="number_of_side_rack_brackets" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">purposed_cargoes</label>
                                <input type="text" class="form-control" id="purposed_cargoes" name="purposed_cargoes" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">load_hatch</label>
                                <input type="text" class="form-control" id="load_hatch" name="load_hatch" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">unload_hatch</label>
                                <input type="text" class="form-control" id="unload_hatch" name="unload_hatch" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Дамжих тавцан</label>
                                <input type="text" class="form-control" id="transfer_panel" name="transfer_panel" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Гар тоормос</label>
                                <input type="text" class="form-control" id="hand_stop" name="hand_stop" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тоормосын төрөл</label>
                                <input type="text" class="form-control" id="stop_type" name="stop_type" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Автоугсраа</label>
                                <input type="text" class="form-control" id="auto_hook_type" name="auto_hook_type" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Автодэглэм</label>
                                <input type="text" class="form-control" id="auto_trigger_type" name="auto_trigger_type" >
                            </div>
                        </div>
                       
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ш/аппарат ангилал</label>
                                <input type="text" class="form-control" id="absorption_type" name="absorption_type" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Төрөл</label>
                                <input type="text" class="form-control" id="absorption_category" name="absorption_category" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Баталгаа</label>
                                <input type="text" class="form-control" id="absorption_date" name="absorption_date" >
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">ВУ-4М маягт</label>
                                <input type="text" class="form-control" id="ram_length" name="ram_length" >
                            </div>
                        </div>

                       
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
@stop

@section('script')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready( function () {
    $('#myTable').DataTable(
        {
            stateSave: true,
            "language": {
                "lengthMenu": " _MENU_ бичлэг",
                "zeroRecords": "Бичлэг олдсонгүй",
                "info": "_PAGE_ ээс _PAGES_ хуудас" ,
                "infoEmpty": "Бичлэг олдсонгүй",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Хайлт:",
                "paginate": {
                    "first":      "Эхнийх",
                    "last":       "Сүүлийнх",
                    "next":       "Дараагийнх",
                    "previous":   "Өмнөх"
                },
            },
            "pageLength": 25
        } 
    );
} );


</script>
@stop
