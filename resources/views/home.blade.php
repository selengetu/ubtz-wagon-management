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
                <form method="POST" id="formSub" action=''>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Төрөл</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($categories as $item)
                                        <option value="{{ $item->catcode }}">{{ $item->abbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Компани</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($companies as $item)
                                        <option value="{{ $item->company_id }}">{{ $item->main_station_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Орон</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($countries as $item)
                                        <option value="{{ $item->country_code }}">{{ $item->contry_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Үйлдвэрлэгч</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($factories as $item)
                                        <option value="{{ $item->factory_code }}">{{ $item->factory_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Загвар</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($models as $item)
                                        <option value="{{ $item->model_id }}">{{ $item->model_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Төмөр зам</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($railways as $item)
                                        <option value="{{ $item->rcode }}">{{ $item->rabbr }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Вагон депо</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                                @foreach ($wagon_depos as $item)
                                        <option value="{{ $item->depo_id }}">{{ $item->depo_name }}</option>
                                    @endforeach
                                    </select>
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
