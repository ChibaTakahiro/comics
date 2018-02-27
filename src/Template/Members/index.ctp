<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    

    <table class="table table-bordered vt">
        <tr>
            <th>タイトル</th>
            <th >説明</th>
            <th class="text-center">機能</th>
            <th class="text-center">状態</th>
            <th class="text-right">表示/非表示</th>
        </tr>
            <?php foreach($comictitle as $key=>$val): 
                    $statuscount = 0;
                    if(isset($groups[$val[ 'id' ]])){
                        $statuscount = sprintf("%d",$groups[$val[ 'id' ]]);
                    }
                ?>
                <tr>
                    <td><?=h($val[ 'title' ])?></td>
                    <td ><?=mb_strimwidth(nl2br(h($val[ 'note' ])),0,40,"...")?></td>
                    <td style="width: 220px;" class="text-center">
                            <?=$this->Form->button("編集",[
                                'class'=>'btn btn-success titleedit',
                                'id'=>'titleedit-'.$val[ 'id' ],
                                'label'=>false
                            ])?>

                            <?=$this->Form->button("詳細",[
                                'class'=>'btn btn-primary edit',
                                'id'=>'detail-'.$val[ 'id' ],
                                'label'=>false
                            ])?>
                        <?=$this->Form->button("削除",[
                            'class'=>'btn btn-danger delete',
                            'id'=>'delete-'.$val[ 'id' ],
                            'label'=>false
                        ])?>
                    </td>
                    <td  class="text-center" style="width: 120px;">
                        <?php
                            $sts = [];
                            $act = [];
                            if($val[ 'status' ] == 0){
                                $sts[0] = "on";
                                $sts[1] = 'off';
                                $act[0] = 'active';
                                $act[1] = '';
                            }
                            if($val[ 'status' ] == 1){
                                $sts[0] = "off";
                                $sts[1] = 'on';
                                $act[0] = '';
                                $act[1] = 'active';
                            }
                        ?>
                        <div class="btn-group"  data-toggle="btn-toggle">
                            <button type="button" id="hide-<?=$val[ 'id' ]?>" class="titlestatus btn btn-default btn-xs <?=$act[0]?>" data-toggle="<?=$sts[0]?>">非公開</button>
                            <button type="button" id="show-<?=$val[ 'id' ]?>" class="titlestatus btn btn-default btn-xs <?=$act[1]?>" data-toggle="<?=$sts[1]?>">公開</button>
                        </div>
                    </td>
                    <td class="text-right" >
                        <?=$statuscount?>/<?=$val[ 'totalgroup' ]?>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    
</section>
