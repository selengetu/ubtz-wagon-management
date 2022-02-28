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
                <h3 class="card-title">Компаний мэдээлэл</h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-small right"  onclick="comEdit()" data-toggle="modal" data-target="#comModal"><i class="fa fa-plus"></i> Компани нэмэх</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Компаний код</th>
                            <th>Компаний нэр</th>
                            <th>Марк</th>
                            <th>Эзэн эсэх</th>
                            <th>Аррендер эсэх</th>
                            <th>Тэмдэглэл</th>
                            <th>Хаяг</th>
                            <th>Утас</th>
                            <th>Төмөр замын код</th>
                            <th>Нэр</th>
                            <th>Бүртгэгдсэн огноо</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($companies as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->company_code}}</td>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->nmark}}</td>
                            <td>{{$item->is_owner}}</td>
                            <td>{{$item->is_arrender}}</td>
                            <td>{{$item->note}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->rcode}}</td>
                            <td>{{$item->subway_name}}</td>
                            <td>{{$item->registered_date}}</td>
                        <td>
                            <button class='btn btn-primary btn-xs' onclick=comEdit('{{$item->company_id}}') data-toggle='modal' data-target='#comModal' title='Засах'><i class='fa fa-edit'></i></button> 
                            
                        </td>
                 
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
        <div class="modal fade" id="comModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveCom') }}>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Харьяа байгууллага</label>
                                <select class="form-control" name="p_abbr" id="p_abbr" >
                               
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Байгууллагын нэр</label>
                                <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Товч тушаал">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Товч нэр</label>
                                <input type="text" class="form-control" id="department_abbr" name="department_abbr" placeholder="Товч тушаал">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Баланс код</label>
                                <input type="text" class="form-control" id="balance_code" name="balance_code" placeholder="Товч тушаал">
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
    function comEdit(hid){
        if(hid){
            $.get('getDep/' + hid, function (data) {
                $('#p_abbr').val(data[0].department_par).trigger('change');
                $('#department_name').val(data[0].department_name);
                $('#department_abbr').val(data[0].department_abbr);
                $('#balance_code').val(data[0].balance_code);
                $('#hid').val(data[0].depid);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Байгуулагын мэдээллийг засварлах";
            });
        } else {
             $('#p_abbr').val(0);
                $('#department_name').val('');
                $('#department_abbr').val('');
                $('#balance_code').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр байгуулга нэмэх";
        }
    }



</script>
@stop
