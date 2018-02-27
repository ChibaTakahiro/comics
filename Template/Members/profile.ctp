<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    <?= $this->Form->create() ?>
    <?php
    /*
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('role');
     * 
     */
        ?>
    <div class="row">
        <div class="col-md-12">
            <?=$this->Form->input("username",[
                'type'=>'text',
                'class'=>'form-control',
                'label'=>false,
                'value'=>$user[ 'username' ]
            ])?>
        </div>
        <div class="col-md-12 mt10">
            <?=$this->Form->input("password",[
                'type'=>'text',
                'class'=>'form-control',
                'label'=>false
            ])?>
        </div>
        
        <div class="col-md-12 mt10">
            <button href="" type="submit" class="btn btn-primary btn-form ">編集</button>
        </div>
    </div>
    <?= $this->Form->end() ?>
</section>
