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
                  
                </div>
            </div>
            <div class="card-body">
            <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Жагсаалт</a>
    <a class="nav-item nav-link" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false"> Үндсэн мэдээлэл</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Засвар</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Эд анги</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <div class="table-responsive">
      <br>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead >
                        <thead >
                        <th> №</th>
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
                        @foreach ($wagons as $item )
                        <tr class="wagondetail" onclick="$('#nav-detail-tab').trigger('click')" tag="{{$item->wagid}}">
                            <td>{{$no}}</td>
                            <td>{{$item->wagno}}</td>
                            <td>{{$item->wagtype}}</td>
                            <td>{{$item->rcode}}</td>
                            <td>{{$item->category_name}}</td>
                            <td>{{$item->waggroup}}</td>
                            <td>{{$item->axes}}</td>
                            <td>{{$item->weight}}</td>
                            <td>{{$item->len}}</td>
                            <td>{{$item->volume}}</td>
                            <td>{{$item->floor}}</td>
                            <td>{{$item->door}}</td>
                        </tr>
                        <?php $no++; ?>

                        @endforeach
                        
                        </tbody>
                      
                    </table>
                </div>
  </div>
  <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-profile-tab">
  <div class="row">
    <div class="col-md-6">
        <br><br>
    <p><b>Төмөр зам: </b><span id="d_rcode"></span></p>
    <p><b>Вагон дугаар: </b><span id="d_wagno"></span></p>
    <p><b>Загвар: </b><span id="d_model_id"></span></p>
    <p><b>Төрөл: </b><span id="d_catcode"></span></p>
    <p><b>Голын тоо: </b><span id="d_axes"></span></p>
    <p><b>Жин: </b><span id="d_weight"></span></p>
    <p><b>Баазын урт: </b><span id="d_base_length"></span></p>
    <p><b>Эзэлхүүн: </b><span id="d_volume"></span></p>
    <p><b>Хаалга: </b><span id="d_door"></span></p>
    <p><b>Шал: </b><span id="d_floor"></span></p>
    </div>
   
    </div>
    <br>
   
    
   

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>
               
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
$('.wagondetail').on('click',function(){
            var itag=$(this).attr('tag');
           $.get('getwagon/'+itag,function(data){

             $.each(data,function(i,qwe){

               
                    $('#d_rcode').text(qwe.rcode);
                    $('#d_wagno').text(qwe.wagno);
                    $('#d_model_id').text(qwe.waggroup);
                    $('#d_catcode').text(qwe.category_name);
                    $('#d_axes').text(qwe.axes);
                    $('#d_weight').text(qwe.weight);
                    $('#d_base_length').text(qwe.len);
                    $('#d_volume').text(qwe.volume);
                    $('#d_door').text(qwe.door);
                    $('#d_floor').text(qwe.floor);
                  

                    $('#wag_id').val(qwe.wagid);
                    $('#rcode').val(qwe.rcode);
                    $('#wagno').val(qwe.wagno);
                    $('#model_id').val(qwe.model_id);
                    $('#catcode').val(qwe.catcode);
                    $('#factory_code').val(qwe.factory_code);
                    $('#factory_date').val(qwe.factory_date);
                    $('#axes').val(qwe.axes);
                    $('#axe_capacity').val(qwe.axe_capacity);
                    $('#brutto').val(qwe.brutto);
                    $('#netto').val(qwe.netto);
                    $('#base_length').val(qwe.base_length);
                    $('#ram_length').val(qwe.ram_length);
                    $('#carrying_capacity').val(qwe.carrying_capacity);
                    $('#tare_weight').val(qwe.tare_weight);
                    $('#volume').val(qwe.volume);
                    $('#door').val(qwe.door);
                    $('#number_of_hatches').val(qwe.number_of_hatches);
                    $('#side_hatches').val(qwe.side_hatches);
                    $('#roof_hatches').val(qwe.roof_hatches);
                    $('#floor_area').val(qwe.floor_area);
                    $('#number_of_side_boards').val(qwe.number_of_side_boards);
                    $('#number_of_side_rack_brackets').val(qwe.number_of_side_rack_brackets);
                    $('#purposed_cargoes').val(qwe.purposed_cargoes);
                    $('#load_hatch').val(qwe.load_hatch);
                    $('#unload_hatch').val(qwe.unload_hatch);
                    $('#transfer_panel').val(qwe.transfer_panel);
                    $('#hand_stop').val(qwe.hand_stop);
                    $('#stop_type').val(qwe.stop_type);
                    $('#auto_hook_type').val(qwe.auto_hook_type);
                    $('#auto_trigger_type').val(qwe.auto_trigger_type);
                    $('#absorption_type').val(qwe.absorption_type);
                    $('#absorption_category').val(qwe.absorption_category);
                    $('#absorption_date').val(qwe.absorption_date);

         });
          });
        });
        $('#addbutton').on('click',function(){
            $('#type').val('1');
            $('#modallabel').text('ВАГОН НЭМЭХ');
        });

        $('#editbutton').on('click',function(){
            $('#type').val('2');
            $('#modallabel').text('ВАГОН ЗАСВАРЛАХ');
});
</script>
@stop
