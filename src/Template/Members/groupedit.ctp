<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    <?= $this->Form->create("null",[
        'type'=>'post',
        'id'=>'form1'
        
    ]) ?>
    <div class="col-lg-12">
        <div class="col-lg-5">
            <div class="box pd10">
                <div class="mt10">
                    <?=$this->Form->input("name",[
                        'type'=>'text',
                        'class'=>'form-control',
                        'label'=>'タイトル',
                        'value'=>$group[ 'name' ]
                    ])?>
                </div>
                <div class="mt10">
                    <?=$this->Form->input("note",[
                        'type'=>'textarea',
                        'class'=>'form-control',
                        'label'=>'説明',
                        'value'=>$group[ 'note' ]
                    ])?>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="box pd10">
                <div class="groupimage w90p pd10"  id="titledrop" style="min-height:200px;">
                    <img src="/comics/<?=$code?>/<?=$group['magaginetitle_id']?>/title/<?=$group[ 'id' ]?>/s_<?=$group[ 'filename' ]?>" style="height:200px;" />
                    <img src="/img/loading.gif" class="loadingimg" />
                </div>
            </div>
        </div>
    </div>
    <?=$this->Form->input("filename",[
                'type'=>'hidden',
                'value'=>$group[ 'filename' ]
            ])?>
    <?=$this->Form->input('titleid',[
        'type'=>'hidden',
        'value'=>$group['magaginetitle_id']
    ])?>
    <?=$this->Form->input('groupid',[
        'type'=>'hidden',
        'value'=>$groupid
    ])?>
    
    <div class="row">
        <div class="col-lg-10">
            <div class="box pd10">
                <div id="addgroupimagedata">
                    <p>こちらに追加画像をドロップしてください。</p>
                    <img src="/img/loading.gif" class="loadingimg" />
                </div>
                
                <div id='sortable'>
                    <?php foreach($groupdata as $val): ?>
                        <div class='sort-elements col-md-2 ' id="groupdata-<?=$val[ 'id' ]?>">
                            [<a href="#"  class="groupdataimagedelete"  id="groupdataimagedelete-<?=$val[ 'id' ]?>">削除</a>]
                            <img src="/comics/<?=$code?>/<?=$val[ 'magazinetitle_id' ]?>/data/<?=$val[ 'magazinegroup_id' ]?>/s_<?=$val[ 'filename' ]?>" id="imagedata-<?=$val[ 'id' ]?>" />
                            <img src="/img/loading.gif" class="loadingimg" id="loading-<?=$val[ 'id' ]?>"/>
                            <?=$this->Form->input("datafilename[".$val[ 'id' ]."]",[
                                'type'=>'hidden',
                                'value'=>$val[ 'filename' ]
                            ])?>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?=$this->Form->button("編集",[
        'class'=>'btn btn-success absolutebutton',
        'id'=>'editbutton',
        'type'=>'button'
    ])?>
    <?= $this->Form->end() ?>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
    jQuery(function(){
        $(document).on("click",".groupdataimagedelete",function(){
            if(confirm("画像の削除を行います。削除したデータは戻せません")){
                var _id = $(this).attr("id").split("-");
                location.href="/members/groupdataimagedelete/"+_id[1];
                return true;
            }
            return false;
        });
        
        $(document).on("click","#editbutton",function(){
            if(confirm("データの変更を行います。よろしいですか？")){
                $("#form1").submit();
            }
            return false;
        });
        jQuery("#sortable").sortable({
            cursor: 'move',
            opacity: 0.7,
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true
        });
        $( '#sortable' ).disableSelection();
        jQuery(document).on('sortstop','#sortable',function(){
            //alert('並び替え時の動作')               //sortstopイベントで並び替え後処理を実行
        });
        
    });
    
    
    
    
    var _length = 0;
    $(function(){
        var obj = $("#addgroupimagedata");
        obj.on('dragenter', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
            $(".loadingimg").show();
            $(this).css('border', '2px solid #0B85A1');
        });
        obj.on('dragover', function (e)
        {

             e.stopPropagation();
             e.preventDefault();
        });
        obj.on('drop', function (e)
        {
             $(this).css('border', '2px dotted #0B85A1');
             e.preventDefault();
             //We need to send dropped files to Server
             var files = e.originalEvent.dataTransfer.files;
           groupDataFileUpload(files,obj);
       
       
        });

        $(document).on('dragenter', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });
        $(document).on('dragover', function (e)
        {
          e.stopPropagation();
          e.preventDefault();
          obj.css('border', '2px dotted #0B85A1');
        });
        $(document).on('drop', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });

    });

    function groupDataFileUpload(files,obj){
        _length = files.length;
        for (var i = 0; i < files.length; i++)
        {
            groupDataFileToServer(files[i],i);
        }
    }

    function groupDataFileToServer(f,_no){
        var fd = new FormData();
        var _titleid = $("#titleid").val();
        var _groupid = $("#groupid").val();
         fd.append('image', f);
         $.ajax({
                type:'POST',
                url:"/members/addgroupdatafileupload/"+_titleid+"/"+_groupid,
                data:fd,
                contentType:false,
                processData: false,
                cache: false,
                success:function(data){
                    
                    console.log(data);
                    console.log("LENGTH=>"+_length);
                    console.log("No=>"+_no);
                    if(_length-1 <= _no){
                        location.href="/members/groupedit/"+_groupid;
                    }
                    
                }
         });

    }
</script>
