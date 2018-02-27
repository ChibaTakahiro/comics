<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    <?= $this->Form->create() ?>
    <div class="row">
        <div class="col-lg-12">

                <table class="table table-bordered vt">
                    <tr>
                        <th nowrap style="width:100px;">表紙</th>
                        <th nowrap style="width:220px;">タイトル</th>
                        <th nowrap >説明</th>
                        <th>状態</th>
                        <th style="width:220px;">機能</th>
                    </tr>
                    <?php foreach($groupfilename as $val):?>
                    <tr>
                        <td class="text-center"><img src="<?=$val[ 'filename' ]?>" style="height:80px;" /></td>
                        <td><?=h($val[ 'name' ])?></td>
                        <td><?=mb_strimwidth(nl2br(h($val[ 'note' ])),0,60,'...','UTF-8')?></td>
                        <td  class="text-center" style="width: 120px;">
                            <?php 
                            $act = [];
                            if($val[ 'status' ] == 0){
                                $act[0] = "active";
                                $act[1] = "";
                            }
                            if($val[ 'status' ] == 1){
                                $act[0] = "";
                                $act[1] = "active";
                            }
                            ?>
                            <div class="btn-group"  data-toggle="btn-toggle">
                                <button type="button" class="groupstatus btn btn-default btn-xs <?=$act[0]?>" data-toggle="on" id="hide-<?=$val[ 'id' ]?>">非公開</button>
                                <button type="button" class="groupstatus btn btn-default btn-xs <?=$act[1]?>" data-toggle="off" id="show-<?=$val[ 'id' ]?>">公開</button>
                            </div>
                        </td>
                        <td>
                            <?=$this->Form->button("編集",[
                                'class'=>'btn btn-success groupedit',
                                'id'=>'edit-'.$val[ 'id' ],
                                'type'=>'button',
                                'div'=>false
                            ])?>
                            <?=$this->Form->button("削除",[
                                'class'=>'btn btn-danger groupdelete',
                                'id'=>'delete-'.$val[ 'id' ],
                                'type'=>'button',
                                'div'=>false
                            ])?>
                        </td>
                    </tr>
                    
                    <?php endforeach;?>
                </table>

        </div>
    </div>
    
    
    <?= $this->Form->end() ?>
</section>
