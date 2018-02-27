<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h" >
    <div class="mbr-gallery-filter container gallery-filter-active">&nbsp;</div>
            <div class="clearfix row">
                <div class="col-md-6">
                    <?= $this->Form->create() ?>
                    <?=$this->Form->input("title",[
                        'type'=>'text'
                        ,'label'=>"タイトル"
                        ,'class'=>'form-control'
                        ,'name'=>'title'
                    ])?>

       
                    <div class="mt10">
                        <?=$this->Form->input("category_id",[
                            'type'=>'select'
                            ,'options'=>$category
                            ,'label'=>"カテゴリ"
                            ,'class'=>'form-control'
                            ,'name'=>'category_id'
                        ])?>
                    </div>
                    <div class="mt10">
                        <?=$this->Form->input("note",[
                            'type'=>'textarea'
                            ,'label'=>"紹介文"
                            ,'class'=>'form-control'
                            ,'name'=>'note'
                        ])?>
                    </div>
                    
                    
                    
                    <?=$this->Form->input("新規投稿",[
                        'type'=>'submit'
                        ,'label'=>false
                        ,'class'=>'form-control btn btn-success mg0 mt20'
                        ,'name'=>'new'
                    ])?>
                    <?= $this->Form->end() ?>
                </div>
                <div class="col-md-5">
                    <?= $this->Form->create() ?>
                    
                   
                    <?=$this->Form->input("magaginetitle_id",[
                        'type'=>'select'
                        ,'options'=>$magaginetitle
                        ,'label'=>"タイトル記事選択"
                        ,'class'=>'form-control'
                    ])?>
                    <div class="mt20">
                        <b>カテゴリ</b>
                        <p id="changeCategoryName"></p>
                    </div>
                    <div class="mt20">
                        <b>紹介文</b>
                        <p id="changeNote"></p>
                    </div>
                    <?=$this->Form->input("連載投稿",[
                        'type'=>'submit'
                        ,'label'=>false
                        ,'class'=>'form-control btn btn-danger mg0 mt20'
                        ,'name'=>'renew'
                    ])?>
                    <?=$this->Form->input("createtype",[
                        'type'=>'hidden',
                        'value'=>'serial'                        
                    ])?>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
    
</section>
