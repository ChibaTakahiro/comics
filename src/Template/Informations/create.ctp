<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */


?>



<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">

    <div class="mbr-gallery-filter container gallery-filter-active">&nbsp;</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><?=h($data[0][ 'magazinetitle' ]->title)?></h3>
            </div>
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="col-md-6 text-center">
                        <img src="<?=$appObj->getThumnail("/comics/".$data[0]['user'][ 'code' ]."/".$data[0][ 'magaginetitle_id' ]."/title/".$data[0][ 'id' ]."/".$data[0][ 'filename' ])?>" class="w150" />
                    </div>
                    <div class="col-md-5">
                        
                        <dl>
                            <dt><?=__("タイトル")?></dt>
                            <dd><?=h($data[0][ 'name' ])?></dd>
                            <dt><?=__("作者")?></dt>
                            <dd><?=h($data[0]['user'][ 'username' ])?></dd>
                            <dt><?=__("作成日")?></dt>
                            <dd><?=$data[0][ 'modified' ]?></dd>
                            <dt><?=__("カテゴリ")?></dt>
                            <dd><?=$categories[$data[0][ 'magazinetitle' ][ 'category_id' ]]?></dd>
                        </dl>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="viewer act">
                        <a href="/details/open/<?=$data[0][ 'magaginetitle_id' ]?>/<?=$data[0][ 'id' ]?>" target=_blank>
                            <span class="mbri-hearth mbri-left-right"></span> 横型ビューワー
                        </a>
                    </div>
                    
                    <div class="viewer act">
                        <a href="/details/vopen/<?=$data[0][ 'magaginetitle_id' ]?>/<?=$data[0][ 'id' ]?>" target=_blank>
                            <span class="mbri-hearth mbri-up-down"></span> 縦型ビューワー</a>
                    </div>
                    
                    <div class="viewer favorite">
                        <a href=""><span class="mbri-hearth mbr-iconfont"></span>お気に入り</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <h3>紹介</h3>
                    <p>
                        <?=nl2br(h($data[0][ 'note' ]))?>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="grouparea">
                    
                    <?php foreach($group as $key=>$val):
                            $filename = $appObj->getThumnail("/comics/".$val[ 'user' ][ 'code' ]."/".$val[ 'magaginetitle_id' ]."/title/".$val[ 'id' ]."/".$val[ 'filename' ]);
                        ?>
                        <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" >
                            <div href="/informations/create/<?=$val[ 'id' ]?>" data-slide-to="0" data-toggle="modal" class="detail" align="center">
                                <img src="<?=$filename?>"  alt="" style="height:200px;width:auto;">
                                <span class="icon-focus"></span>
                            </div>
                        </div>
                    <?php endforeach;?>
                    
                </div>
            </div>
        </div>                        
    </div>

</section>
