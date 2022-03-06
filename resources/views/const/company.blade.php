@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<style>
     .disabledTab {
    pointer-events: none;
}
.disabledTab1 {
    pointer-events: none;
}
              .table-row{
                  cursor:pointer;
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
                    <button class="btn btn-primary btn-small right"  onclick="comEdit()" id="comButton" data-toggle="modal" data-target="#comModal"><i class="fa fa-plus"></i> Компани нэмэх</button>
                </div>
            </div>
            <div class="card-body">
            <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Жагсаалт</a>
                <a class="nav-item nav-link menuli1 disabled disabledTab" id="nav-contract-tab" data-toggle="tab" href="#nav-contract" role="tab" aria-controls="nav-contract" aria-selected="false">Гэрээ</a>
                <a class="nav-item nav-link menuli1 disabled disabledTab" id="nav-vagon-tab" data-toggle="tab" href="#nav-vagon" role="tab" aria-controls="nav-vagon" aria-selected="false"> Вагон жагсаалт</a>
                <a class="nav-item nav-link menuli2 disabled disabledTab1" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false"> Үндсэн мэдээлэл</a>
                <a class="nav-item nav-link  menuli2 disabled disabledTab1" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Засвар</a>
                <a class="nav-item nav-link menuli2 disabled disabledTab1" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Эд анги</a>
            </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="table-responsive">
                <br>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                            <th>#</th>
                            <th>Компаний код</th>
                            <th>Компаний нэр</th>
                            <th>Марк</th>
                            <th>Эзэмшигч эсэх</th>
                            <th>Түрээслэгч эсэх</th>
                            <th>Тэмдэглэл</th>
                            <th>Хаяг</th>
                            <th>Утас</th>
                            <th>Төмөр замын код</th>
                            <th>Замын нэр</th>
                            <th>Бүртгэгдсэн огноо</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($companies as $item )
                        <tr >
                            <td>{{$no}}</td>
                            <td >{{$item->company_code}}</td>
                            <td class="comwagon" onclick="$('#nav-contract-tab').trigger('click')" tag="{{$item->company_id}}"><b>{{$item->company_name}}</b></td>
                            <td>{{$item->nmark}}</td>
                            <td>@if($item->is_owner == 1) Тийм @else Үгүй @endif</td>
                            <td>@if($item->is_arrender == 1) Тийм @else Үгүй @endif</td>
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
            <div class="tab-pane fade" id="nav-vagon" role="tabpanel" aria-labelledby="nav-vagon-tab">
            <div class="table-responsive">
                <br>
                <button class="btn btn-default btn-xs right"  onclick="wagonEdit()" data-toggle="modal" data-target="#wagonModal"><i class="fa fa-plus"></i> Вагон нэмэх</button>
                    <table class="table table-bordered table-striped" id="vagonsTable">
                        <thead >

                            <th>Вагон №</th>
                            <th>Төрөл</th>
                            <th>Төмөр замын код</th>
                            <th>Ангилал</th>
                            <th>Групп</th>
                            <th>Голын тоо</th>
                            <th>Жин</th>
                            <th>Баазын урт</th>
                            <th>Эзэлхүүн</th>
                            <th>Шал</th>
                            <th>Хаалганы тоо</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                      
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contract-tab">
            <div class="table-responsive">
                <br>
                <button class="btn btn-default btn-xs right"  onclick="conEdit()" data-toggle="modal" data-target="#conModal"><i class="fa fa-plus"></i> Гэрээ нэмэх</button>
                    <table class="table table-bordered table-striped" id="contractTable">
                        <thead >
                            <th>Гэрээний төрөл</th>
                            <th>Гэрээний дугаар</th>
                            <th>Эхлэх огноо</th>
                            <th>Дуусах огноо</th>
                            <th>Тэмдэглэл</th>
                            <th></th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                      
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
             
            </div>
        </div>
    </div>
</div>
        <!-- Modal -->
        <div class="modal fade" id="comModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Компаний код</label>
                                <input type="text" class="form-control" id="company_code" name="company_code" placeholder="Компаний код">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jobname">Компаний нэр</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Компаний нэр">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Марк</label>
                                <input type="text" class="form-control" id="nmark" name="nmark" placeholder="Марк">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Эзэмшигч эсэх</label>
                                <select class="form-control" name="is_arrender" id="is_arrender" >
                              
                                        <option value="1">Тийм</option>
                                        <option value="2">Үгүй</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Түрээслэгч эсэх</label>
                                <select class="form-control" name="is_arrender" id="is_arrender" >
                              
                                        <option value="1">Тийм</option>
                                        <option value="2">Үгүй</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тэмдэглэл</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="Тэмдэглэл">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Хаяг</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Хаяг">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Утас</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Утас">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төмөр замын код</label>
                                <input type="text" class="form-control" id="rcode" name="rcode" placeholder="Төмөр замын код">
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Замын нэр</label>
                                <input type="text" class="form-control" id="subway_name" name="subway_name" placeholder="Замын нэр">
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
        </div>
        <div class="modal fade" id="conModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title1" id="exampleModalLabel1"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveCom') }}>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний №</label>
                                <input type="text" class="form-control" id="contract_no" name="contract_no" placeholder="Гэрээний №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Эхлэх огноо</label>
                                <input type="text" class="form-control" id="begin_date" name="begin_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Дуусах огноо</label>
                                <input type="text" class="form-control" id="end_date" name="end_date" >
                            </div>
                        </div>
                     
                     
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тэмдэглэл</label>
                                <input type="text" class="form-control" id="contract_notes" name="contract_notes" >
                            </div>
                        </div>
                      
                       
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid1" name="hid1">
                    <input type="hidden"  id="cid1" name="cid1">
                    <input type="hidden"  id="flg1" name="flg1">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
        <div class="modal fade" id="wagonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallabel">Вагон бүртгэл</h5>
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
                                <input type="text" class="form-control" id="wagno" name="wagno" required>
                            </div>
                        </div>
                      
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Загвар</label>
                                <select class="form-control" name="model_id" id="model_id" >
                                @foreach ($models as $item)
                                        <option value="{{ $item->model_id }}">{{ $item->model_no }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ангилал</label>
                                <select class="form-control" name="catcode" id="catcode" >
                                @foreach ($categories as $item)
                                        <option value="{{ $item->catcode }}">{{ $item->abbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Групп</label>
                                <input type="text" class="form-control" id="waggroup" name="waggroup" required>
                            </div>
                        </div>
                  
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Голын тоо</label>
                                <input type="number" class="form-control" id="axes" name="axes" required>
                            </div>
                        </div>
                       
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Жин</label>
                                <input type="number" class="form-control" id="weight" name="weight" required>
                            </div>
                        </div>
                   
                         <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Урт</label>
                                <input type="number" class="form-control" id="len" name="len" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Эзэлхүүн</label>
                                <input type="number" class="form-control" id="volume" name="volume" required>
                            </div>
                        </div>
                   
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хаалга</label>
                                <input type="number" class="form-control" id="door" name="door" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Шал</label>
                                <input type="text" class="form-control" id="floor" name="floor" required>
                            </div>
                        </div>
                        </div>
        
                       
                    </div>
            
                <div class="modal-footer">
                    <input type="hidden"  id="hid2" name="hid2">
                    <input type="hidden"  id="cid2" name="cid2">
                    <input type="hidden"  id="flg2" name="flg2">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
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
            $.get('getcompany/' + hid, function (data) {
                $('#company_code').val(data[0].company_code).trigger('change');
                $('#company_name').val(data[0].company_name);
                $('#nmark').val(data[0].nmark);
                $('#is_owner').val(data[0].is_owner);
                $('#is_arrender').val(data[0].is_arrender);
                $('#note').val(data[0].note);
                $('#phone').val(data[0].phone);
                $('#address').val(data[0].address);
                $('#rcode').val(data[0].rcode);
                $('#subway_name').val(data[0].subway_name);
                $('#registered_date').val(data[0].registered_date);
                $('#hid').val(data[0].company_id);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Компаний мэдээллийг засварлах";
            });
        } else {
             $('#company_code').val('').trigger('change');
                $('#company_name').val('');
                $('#nmark').val('');
                $('#is_owner').val(1);
                $('#is_arrender').val(1);
                $('#note').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#rcode').val('');
                $('#subway_name').val('');
                $('#registered_date').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр компани нэмэх";
        }
    }
    function conEdit(hid){
        if(hid){
            $.get('getContract/' + hid, function (data) {
                $('#contract_no').val(data[0].contract_no);
                $('#begin_date').val(data[0].begin_date);
                $('#end_date').val(data[0].end_date);
                $('#contract_notes').val(data[0].contract_notes);
                $('#company_id').val(data[0].company_id);
                $('#contract_type_code').val(data[0].contract_type_code).trigger('change');
                $('#hid').val(data[0].contract_type_code);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel1").innerHTML="Компаний гэрээг засварлах";
            });
        } else {
             $('#company_code').val('').trigger('change');
             $('#contract_no').val('');
                $('#begin_date').val('');
                $('#end_date').val('');
                $('#contract_notes').val('');
                $('#contract_type_code').val('');
                $('#company_id').val('');
                $('#hid1').val(0);
                $('#flg1').val(0);
                document.getElementById("exampleModalLabel1").innerHTML="Шинээр гэрээ нэмэх";
        }
    }
    function wagonEdit(hid){
        if(hid){
            $.get('getwagon/' + hid, function (data) {
                $('#company_code').val(data[0].company_code).trigger('change');
                $('#company_name').val(data[0].company_name);
                $('#nmark').val(data[0].nmark);
                $('#is_owner').val(data[0].is_owner);
                $('#is_arrender').val(data[0].is_arrender);
                $('#note').val(data[0].note);
                $('#phone').val(data[0].phone);
                $('#address').val(data[0].address);
                $('#rcode').val(data[0].rcode);
                $('#subway_name').val(data[0].subway_name);
                $('#registered_date').val(data[0].registered_date);
                $('#hid').val(data[0].company_id);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Компаний мэдээллийг засварлах";
            });
        } else {
             $('#company_code').val('').trigger('change');
                $('#company_name').val('');
                $('#nmark').val('');
                $('#is_owner').val(1);
                $('#is_arrender').val(1);
                $('#note').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#rcode').val('');
                $('#subway_name').val('');
                $('#registered_date').val('');
                $('#hid').val(0);
                $('#flg').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр компани нэмэх";
        }
    }
    $('.comwagon').on('click',function(){
            var itag=$(this).attr('tag');
            $( ".menuli1" ).removeClass("disabled disabledTab");
            $( "#comButton" ).hide();
            $("#contractTable tbody").empty();    
            $("#vagonsTable tbody").empty();   
            $('#cid1').val(itag); 
            $('#cid2').val(itag); 
            $.get('getwagons/'+itag,function(data){

                $.each(data,function(i,qwe){
              var sHtml = "<tr>" +
        "   <td class='m1'>" + qwe.wagno + "</td>" +
        "   <td class='m2'>" + qwe.wagtype + "</td>" +
        "   <td class='m3'>" + qwe.rcode + "</td>" +
         "   <td class='m3'>" + qwe.category_name + "</td>"+
       "   <td class='m3'>" +  qwe.waggroup + "</td>"+
       "   <td class='m3'>" + qwe.axes + "</td>"+
       "   <td class='m3'>" +  qwe.weight + "</td>"+
       "   <td class='m3'>" + qwe.len + "</td>"+
       "   <td class='m3'>" +  qwe.volume + "</td>"+
       "   <td class='m3'>" +  qwe.floor + "</td>"+
       "   <td class='m3'>" +  qwe.door + "</td>"+
       "   <td class='m1'> <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#wagonModal' data-id=" + qwe.wagid + " tag=" + qwe.wagid + " onclick='wagonEdit(" + qwe.wagid + ")'><i class='fa fa-edit'></i></a> </td>" +
        "</tr>";

        $("#vagonsTable tbody").append(sHtml);
               
               
         });
                });
                $.get('getcontract/'+itag,function(data){

                $.each(data,function(i,qwe){
                var sHtml = "<tr>" +
                "   <td class='m1'>" + qwe.contract_type_name + "</td>" +
                "   <td class='m2'>" + qwe.contract_no + "</td>" +
                "   <td class='m3'>" + qwe.begin_date + "</td>" +
                "   <td class='m3'>" + qwe.end_date + "</td>"+
                "   <td class='m3'>" +  qwe.contract_notes + "</td>"+
                "   <td class='m1'> <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#wagonModal' data-id=" + qwe.contract_id + " tag=" + qwe.contract_id + " onclick='wagonEdit(" + qwe.contract_id + ")'><i class='fa fa-edit'></i></a> </td>" +
      
                "</tr>";

                $("#contractTable tbody").append(sHtml);


                });
                });
        });

</script>
@stop
