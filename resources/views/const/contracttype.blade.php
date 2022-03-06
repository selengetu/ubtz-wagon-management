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
                <h3 class="card-title">Гэрээний төрлийн мэдээлэл</h3>
                <div class="card-tools">
                    <button class="btn btn-primary btn-small right"  onclick="conEdit()" data-toggle="modal" data-target="#depModal"><i class="fa fa-plus"></i> Гэрээний төрөл нэмэх</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Нэр</th>
                            <th>#</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($types as $item )
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->contract_name}}</td>
                        <td>
                            <button class='btn btn-primary btn-xs' onclick=conEdit('{{$item->contract_type_code}}') data-toggle='modal' data-target='#depModal' title='Засах'><i class='fa fa-edit'></i></button> 
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
        <div class="modal fade" id="depModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveContractType') }}>
                <div class="modal-body">
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Нэр</label>
                                <input type="text" class="form-control" id="contract_name" name="contract_name" placeholder="Товч тушаал">
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
    function conEdit(hid){
        if(hid){
            $.get('getContractType/' + hid, function (data) {
                $('#contract_name').val(data[0].contract_name);
                $('#hid').val(data[0].contract_type_code);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Гэрээний төрлийн мэдээллийг засварлах";
            });
        } else {
             $('#p_abbr').val(0);
                $('#contract_name').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр гэрээний төрөл нэмэх";
        }
    }


</script>
@stop
