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
        <div class="col-lg-5">
            <div class="groupimage w90p pd10" id="titledrop">
                <p>表紙画像をこのエリアにドロップしてください。</p>
                <img src="/img/loading.gif" class="loadingimg" />
            </div>
            <?=$this->Form->input("filename",[
                'type'=>'hidden',
                'value'=>''
            ])?>
        </div>
        <div class="col-lg-6">
            <div class="w90p">
                <?=$this->Form->input("name",[
                    'type'=>'text',
                    'class'=>'form-control',
                    'label'=>'タイトル',
                    'placeholder'=>'第１巻'
                ])?>
                
                <br />
                <?=$this->Form->input("note",[
                    'type'=>'textarea',
                    'class'=>'form-control',
                    'label'=>'内容'
                ])?>
            </div>
        </div>
        
    </div>
    
    <div class="row mt20">
        <div class="col-lg-12">
            <?=$this->Form->input("次へ",[
                'type'=>'submit',
                'value'=>'次へ',
                'class'=>'btn btn-success'
            ])?>
        </div>
    </div>
    <?=$this->Form->input("titleid",[
        'type'=>'hidden',
        'value'=>$titleid
    ])?>
    <?= $this->Form->end() ?>
</section>
