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
                    <button class="btn btn-default btn-small right"  id="addbutton" data-toggle="modal" data-target="#wagonModal"><i class="fa fa-plus"></i> Вагон нэмэх</button>
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
                        <th>#</th>
                            <th>Төмөр замын код</th>
                            <th>Вагон №</th>
                            <th>Ангилал</th>
                            <th>Баазын урт</th>
                            <th>Голын тоо</th>
                            <th>Голын Даац</th>
                            <th>Цэвэр жин</th>
                            <th>Бохир жин</th>
                            <th>Эзэлхүүн</th>
                        </thead>
                        <tbody id="tbody">
                        <?php $no = 1; ?>
                        @foreach ($wagons as $item )
                        <tr class="wagondetail" onclick="$('#nav-detail-tab').trigger('click')" tag="{{$item->wagid}}">
                            <td>{{$no}}</td>
                            <td>{{$item->rcode}}</td>
                            <td>{{$item->wagno}}</td>
                            <td>{{$item->catcode}}</td>
                            <td>{{$item->len}}</td>
                            <td>{{$item->axes}}</td>
                            <td>{{$item->weight}}</td>
                            <td>{{$item->door}}</td>
                            <td>{{$item->floor}}</td>
                            <td>{{$item->volume}}</td>
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
    <p><b>Үйлдвэрлэгч: </b><span id="d_factory_code"></span></p>
    <p><b>Үйлдвэрлэсэн он: </b><span id="d_factory_date"></span></p>
    <p><b>Голын тоо: </b><span id="d_axes"></span></p>
    <p><b>Голын даац: </b><span id="d_axe_capacity"></span></p>
    <p><b>Бохир жин: </b><span id="d_brutto"></span></p>
    <p><b>Цэвэр жин: </b><span id="d_netto"></span></p>
    <p><b>Баазын урт: </b><span id="d_base_length"></span></p>
    <p><b>Рамын урт: </b><span id="d_ram_length"></span></p>
    <p><b>Хөдлөх бүрэлдэхүүний овор: </b><span id="d_carrying_capacity"></span></p>
    <p><b>Ачааны даац: </b><span id="d_tare_weight"></span></p>
    <p><b>Эзэлхүүн: </b><span id="d_volume"></span></p>
    <p><b>Хаалга: </b><span id="d_door"></span></p>
    <p><b>Нээлхийний тоо: </b><span id="d_number_of_hatches"></span></p>
    <p><b>Хажуугийн нээлхий: </b><span id="d_side_hatches"></span></p>
    <p><b>Дээврийн нээлхий: </b><span id="d_roof_hatches"></span></p>
    </div>
    <div class="col-md-6">
    <br><br>
   
    <p><b>Шал: </b><span id="d_floor_area"></span></p>
    <p><b>Хажуугийн тэвш: </b><span id="d_number_of_side_boards"></span></p>
    <p><b>Бэхэлгээний тоо: </b><span id="d_number_of_side_rack_brackets"></span></p>
    <p><b>Ачааны онцлог: </b><span id="d_purposed_cargoes"></span></p>
    <p><b>Ачих нээлхий: </b><span id="d_load_hatch"></span></p>
    <p><b>Буулгах нээлхий: </b><span id="d_unload_hatch"></span></p>
    <p><b>Дамжих тавцан: </b><span id="d_transfer_panel"></span></p>
    <p><b>Гар тоормос: </b><span id="d_hand_stop"></span></p>
    <p><b>Тоормосын төрөл: </b><span id="d_stop_type"></span></p>
    <p><b>Автоугсраа: </b><span id="d_auto_hook_type"></span></p>
    <p><b>Автодэглэм: </b><span id="d_auto_trigger_type"></span></p>
    <p><b>ВУ-4М маягт: </b><span id="vu4m_wagon_techinfo"></span></p>
    <p><b>Шингээх аппаратны ангилал: </b><span id="d_absorption_type"></span></p>
    <p><b>Шингээх аппаратны төрөл: </b><span id="d_absorption_category"></span></p>
    <p><b>Шингээх аппаратны баталгаа: </b><span id="d_absorption_date"></span></p>
    <button class="btn btn-default btn-small right"  id="editbutton" data-toggle="modal" data-target="#wagonModal"><i class="fa fa-pencil"></i> Вагон засварлах</button>
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
        <!-- Modal -->
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
                                <input type="hidden" class="form-control" id="type" name="type">
                                <input type="hidden" class="form-control" id="wag_id" name="wag_id">
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
                                <input type="date" class="form-control" id="factory_date" name="factory_date" >
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
                                <label for="jobname">Голын даац</label>
                                <input type="number" class="form-control" id="axe_capacity" name="axe_capacity" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Бохир жин</label>
                                <input type="number" class="form-control" id="brutto" name="brutto" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Цэвэр жин</label>
                                <input type="number" class="form-control" id="netto" name="netto" required>
                            </div>
                        </div>
                         <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Баазын урт</label>
                                <input type="number" class="form-control" id="base_length" name="base_length" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Рамын урт</label>
                                <input type="number" class="form-control" id="ram_length" name="ram_length" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Х/б овор</label>
                                <input type="number" class="form-control" id="carrying_capacity" name="carrying_capacity" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ачааны даац</label>
                                <input type="number" class="form-control" id="tare_weight" name="tare_weight" required>
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
                                <label for="jobname">Нээлхийний тоо</label>
                                <input type="number" class="form-control" id="number_of_hatches" name="number_of_hatches" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хажуугийн нээлхий</label>
                                <input type="number" class="form-control" id="side_hatches" name="side_hatches" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Дээврийн нээлхий</label>
                                <input type="number" class="form-control" id="roof_hatches" name="roof_hatches" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Шал</label>
                                <input type="number" class="form-control" id="floor_area" name="floor_area" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хажуугийн тэвш</label>
                                <input type="number" class="form-control" id="number_of_side_boards" name="number_of_side_boards" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Бэхэлгээний тоо</label>
                                <input type="number" class="form-control" id="number_of_side_rack_brackets" name="number_of_side_rack_brackets" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ачааны онцлог</label>
                                <input type="text" class="form-control" id="purposed_cargoes" name="purposed_cargoes" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Ачих нээлхий</label>
                                <input type="number" class="form-control" id="load_hatch" name="load_hatch" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Буулгах нээлхий</label>
                                <input type="number" class="form-control" id="unload_hatch" name="unload_hatch" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Дамжих тавцан</label>
                                <input type="number" class="form-control" id="transfer_panel" name="transfer_panel" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Гар тоормос</label>
                                <input type="number" class="form-control" id="hand_stop" name="hand_stop" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тоормосын төрөл</label>
                                <input type="text" class="form-control" id="stop_type" name="stop_type" required>
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
                            <label for="exampleFormControlFile1">ВУ-4М маягт</label>
                                <input type="file" class="form-control-file" id="vu4m_wagon_techinfo" name="vu4m_wagon_techinfo">
                              
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">

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
                                <input type="date" class="form-control" id="absorption_date" name="absorption_date" >
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
$('.wagondetail').on('click',function(){
            var itag=$(this).attr('tag');
           $.get('getwagon/'+itag,function(data){

             $.each(data,function(i,qwe){

               
                    $('#d_rcode').text(qwe.rabbr);
                    $('#d_wagno').text(qwe.wagno);
                    $('#d_model_id').text(qwe.model_name);
                    $('#d_catcode').text(qwe.category_name);
                    $('#d_factory_code').text(qwe.f_name);
                    $('#d_factory_date').text(qwe.factory_date);
                    $('#d_axes').text(qwe.axes);
                    $('#d_axe_capacity').text(qwe.axe_capacity);
                    $('#d_brutto').text(qwe.brutto);
                    $('#d_netto').text(qwe.netto);
                    $('#d_base_length').text(qwe.base_length);
                    $('#d_ram_length').text(qwe.ram_length);
                    $('#d_carrying_capacity').text(qwe.carrying_capacity);
                    $('#d_tare_weight').text(qwe.tare_weight);
                    $('#d_volume').text(qwe.volume);
                    $('#d_door').text(qwe.door);
                    $('#d_number_of_hatches').text(qwe.number_of_hatches);
                    $('#d_side_hatches').text(qwe.side_hatches);
                    $('#d_roof_hatches').text(qwe.roof_hatches);
                    $('#d_floor_area').text(qwe.floor_area);
                    $('#d_number_of_side_boards').text(qwe.number_of_side_boards);
                    $('#d_number_of_side_rack_brackets').text(qwe.number_of_side_rack_brackets);
                    $('#d_purposed_cargoes').text(qwe.purposed_cargoes);
                    $('#d_load_hatch').text(qwe.load_hatch);
                    $('#d_unload_hatch').text(qwe.unload_hatch);
                    $('#d_transfer_panel').text(qwe.transfer_panel);
                    $('#d_hand_stop').text(qwe.hand_stop);
                    $('#d_stop_type').text(qwe.stop_type);
                    $('#d_auto_hook_type').text(qwe.auto_hook_type);
                    $('#d_auto_trigger_type').text(qwe.auto_trigger_type);
                    $('#d_absorption_type').text(qwe.absorption_type);
                    $('#d_absorption_category').text(qwe.absorption_category);
                    $('#d_absorption_date').text(qwe.absorption_date);


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
