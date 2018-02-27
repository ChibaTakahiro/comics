<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h" >
    
    <div class="mbr-gallery-filter container gallery-filter-active">&nbsp;</div>
    <?= $this->Form->create('null',[
        'type'=>'post',
        'id'=>'form1'
        ]) ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="dataimage w90p pd10" id="drop">
                    <p>内容画像をこのエリアにドロップしてください。</p>
                    <img src="/img/loading.gif" class="loadingimg"   />
                </div>
            </div>
        </div>
        <?=$this->Form->input("登録",[
            'type'=>"submit",
            'class'=>'btn btn-success'
        ])?>
    <div id="hidden"></div>
    
    <?=$this->Form->input("titleid",[
        'type'=>'hidden',
        'value'=>$titleid
    ])?>
    <?=$this->Form->input("groupid",[
        'type'=>'hidden',
        'value'=>$groupid
    ])?>
    <?= $this->Form->end() ?>
    
    
    <?php /*
    <div class="row">
        <div class="col-lg-6">
            <div class="col-lg-12">
                
                <h3 class="box-title"><span class="mbri-edit"></span><?=__("タイトル")?></h3>
                <p>
                    <?=$this->Form->input("title",[
                        'type'=>'text',
                        'value'=>$user[ 'title' ],
                        'label'=>false,
                        'class'=>'form-control titleblur'
                    ])?>
                </p>
            </div>
            <div class="col-lg-12">
                <h3><span class="mbri-edit"></span><?=__("タイトル画像")?></h3>
                <div class="imagedrop" id="titleimageEdit">
                    <img src="<?=$user[ 'topfilename' ]?>"  height="200"  />
                </div>
            </div>
            <div class="col-lg-12">
                <h3><span class="mbri-edit"></span><?=__("カテゴリ")?></h3>
                <?=$this->Form->input("category_id",[
                    'options'=>$category,
                    'label'=>false,
                    'class'=>'form-control categoryblur',
                    'default'=>$user[ 'category' ][ 'id' ]
                ])?>
            </div>
            <div class="col-lg-12">
                <h3><span class="mbri-edit"></span><?=__("紹介文")?></h3>
                <?=$this->Form->input('note',[
                    'type'=>'textarea',
                    'value'=>$user[ 'note' ],
                    'class'=>'form-control infoblur',
                    'label'=>false
                ])?>
            </div>
        </div>
        <div class="col-lg-5">
            <h3><span class="mbri-edit"></span>内容</h3>
            <div class="overflow">
                <table class="table" id="table">
                    <tr>
                        <th class="w20p">順番</th>
                        <th class="w60p">画像</th>
                        <th class="w30p">機能</th>
                    </tr>
                    <tbody id="sortable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <div class="row mt20">
        <div class="col-lg-12">
            <?=$this->Form->input("公開",[
                'type'=>'submit',
                'value'=>'公開',
                'class'=>'btn btn-success'
            ])?>
        </div>
    </div>
    <?= $this->Form->end() ?>
    <?=$this->Form->input("groupid",[
        'type'=>'hidden',
        'value'=>$groupid
    ])?>
     * 
     */?>
    
</section>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" >
    
var _edittext = "";
$(function(){
    
    /*
    $(this).setSort();
    $(document).on("blur","input.titleblur",function(e){
       _edittext = $(this).val();
       $(this).textDataUpdate("title");
    });
    $(document).on("blur","select.categoryblur",function(e){
       _edittext = $(this).val();
       $(this).textDataUpdate("category");
    });
    $(document).on("blur","textarea.infoblur",function(e){
       _edittext = $(this).val();
       $(this).textDataUpdate("info");
    });
    
    
    
    $(document).on("click","input.delete",function(e){
        if(!confirm("データの削除を行います。")){
            return false;
        }
        var _id = $(this).attr("id").split("-");
        var _groupid = $("#groupid").val();
        var _data = {
            'id':_id[1]
        };
        $.ajax({
          type:"POST",
          url:'/members/delete/'+_groupid,
          data:_data,
          success:function(msg){
              $("#tr-"+_id[1]).remove();
              
              $(this).changeSorts();
          }
       });
        
    });
    $('#sortable').sortable({
        'axis':'y'
        ,cursor: "move"
        , opacity: 0.5
        ,helper: helper1
    });
    $('#sortable').disableSelection();
    $('#sortable').bind('sortstop', function (e, ui) {
        $(this).changeSorts();
        
       
    });
    
    
    
    //-----------------------
    //画像ドラッグ
    //------------------------
    $(document).on('dragenter',".imagedrop", function (e)
    {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '2px solid #0B85A1');
    });
    
    $(document).on('dragover',".imagedrop", function (e)
    {
         e.stopPropagation();
         e.preventDefault();
    });
    
    $(document).on('drop',".imagedrop", function (e)
    {

        var _id = $(this).attr("id").split("-");
         $(this).css('border', '2px solid #ccc');
         e.preventDefault();
         var files = e.originalEvent.dataTransfer.files;
         
         imageFileUpload(files,_id);
    });
    
    $(document).on('dragenter',".imagedrop", function (e)
    {
        e.stopPropagation();
        e.preventDefault();
    });
    
    $(document).on('dragover',".imagedrop", function (e)
    {
      e.stopPropagation();
      e.preventDefault();
      tobj.css('border', '2px dotted #0B85A1');
    });
    $(document).on('drop', function (e)
    {
        e.stopPropagation();
        e.preventDefault();
    });
    
    */
});

/*
$.fn.textDataUpdate = function(_type){
    var _groupid = $("#groupid").val();
    var _data = {
        "text":_edittext
        ,"type":_type
    };
    $.ajax({
            type:'POST',
            url:"/members/editText/"+_groupid,
            data:_data,
            cache: false,
            success:function(data){
                
            }
     });
    
};

function imageFileUpload(files,_id){
    var fd = new FormData();
    var _id2 = "";
    var _top = true;
    if(_id.length > 1){
        _top = false;
        //内容の時
        _id2 = _id[1]; //titledata id
        _id = _id[0]; //id
    }
    fd.append('image', files[0]);
    var _groupid = $("#groupid").val();
    $.ajax({
            type:'POST',
            url:"/members/editFileupload/"+_groupid+"/"+_id+"/"+_id2,
            data:fd,
            contentType:false,
            processData: false,
            cache: false,
            success:function(data){

                if(_top){
                    var _img = "#titleimageEdit";
                    $(_img).html("<img src='"+data+"' style='height:200px;' />");
                }else{
                    var _img = "#notes-"+_id2;
                    $(_img).html("<img src='"+data+"' style='height:100px;' />");
                }
            }
     });
}


function helper1(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width());
    });
    return $helper;
}
$.fn.changeSorts = function(){
    var _groupid = $("#groupid").val();
    var _tbl = $("#sortable tr td:first-child");
    var _num = [];
    _tbl.each(function(_i,_val){
       var _class = $(this).attr("id").split("-");
       _num.push(_class[1]);
    });
    var _data = {
       "num":_num
    };

    $.ajax({
      type:"POST",
      url:'/members/changeSort/'+_groupid,
      data:_data,
      success:function(msg){
          $(this).setSort();
      }
    });
};
$.fn.setSort = function(){
    $("#sortable").html("<tr><td colspan=3 class='text-center'><img src='/img/loading.gif' /></td></tr>");
    var _groupid = $("#groupid").val();
    $.ajax({
          type:"POST",
          url:'/members/getMagazineData/'+_groupid,
          dataType:"json",
          success:function(data){
                var _td = "";
                for(var _i=0;_i<data.length;_i++){
                    var _id = data[_i][ 'id' ];
                    var _num = data[_i][ 'number' ];
                    var _fname = data[_i][ 'filename' ];
                    var _note = "notes-"+data[_i][ 'id' ];
                   _td += "<tr id='tr-"+_id+"'>";
                   _td += "<td id='num-"+_id+"'>"+_num+"</td>";
                   _td += "<td class='imagedrop text-center' id='"+_note+"'><img src='"+_fname+"'  style='height:100px;' /></td>";
                   _td += "<td><input type='button'  class='delete btn btn-danger'  id='delete-"+_id+"'  value='削除'  /></td>";
                   _td += "</tr>";
                   
                }
                $("#sortable").html(_td);
          }
       });
};
*/
</script>
