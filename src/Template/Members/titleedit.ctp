<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    <?= $this->Form->create() ?>
    <div class="col-lg-12">
        
        <div class="box pd10">
            <div class="mt10">
                <?=$this->Form->input("title",[
                    'type'=>'text',
                    'class'=>'form-control',
                    'label'=>'タイトル',
                    'value'=>$member[ 'title' ]
                ])?>
            </div>
            <div class="mt10">
                <?=$this->Form->input("category_id",[
                    'type'=>'select',
                    'class'=>'form-control',
                    'label'=>'カテゴリ',
                    'options'=>$category,
                    'value'=>$member[ 'category_id' ]
                ])?>
            </div>
            <div class="mt10">
                <?=$this->Form->input("note",[
                    'type'=>'textarea',
                    'class'=>'form-control',
                    'label'=>'内容',
                    'value'=>$member[ 'note' ]
                ])?>
            </div>
        </div>
        <div>
            <?=$this->Form->button("編集",[
                'class'=>'btn btn-success titleEditPost',
                'label'=>false
            ])?>
        </div>
        
    </div>

    <?= $this->Form->end() ?>
</section>
