<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */


?>



<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">

    

    <div class="container">
        <div><!-- Filter -->
            <div class="mbr-gallery-filter container gallery-filter-active">
                <ul buttons="0">
                    <li class="mbr-gallery-filter-all">
                        <a class="btn btn-md btn-primary-outline active display-4" href="">All</a>
                    </li>
                </ul>
            </div><!-- Gallery -->
            <div class="mbr-gallery-row">
                <div class="mbr-gallery-layout-default">
                    <div>
                        <div>
                            <?php foreach($data as $key=>$val):
                                    $categoryname = $categories[$val[ 'magazinetitle' ][ 'category_id' ]];
                                    $filename = $appObj->getThumnail("/comics/".$val[ 'user' ][ 'code' ]."/".$val[ 'magaginetitle_id' ]."/title/".$val[ 'id' ]."/".$val[ 'filename' ]);
                                ?>
                                <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="<?=$categoryname?>">
                                    <div href="/informations/create/<?=$val[ 'id' ]?>" data-slide-to="0" data-toggle="modal" class="detail" align="center">
                                        <img src="<?=$filename?>"  alt="" style="height:200px;width:auto;">
                                        <span class="icon-focus"></span>
                                    </div>
                                </div>
                            <?php endforeach;?>
                            <!--
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Awesome">
                                <div href="#lb-gallery2-h" data-slide-to="0" data-toggle="modal">
                                    <img src="assets/images/gallery00.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Responsive">
                                <div href="#lb-gallery2-h" data-slide-to="1" data-toggle="modal">
                                    <img src="assets/images/gallery01.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Creative">
                                <div href="#lb-gallery2-h" data-slide-to="2" data-toggle="modal">
                                    <img src="assets/images/gallery02.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Animated">
                                <div href="#lb-gallery2-h" data-slide-to="3" data-toggle="modal">
                                    <img src="assets/images/gallery03.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Awesome">
                                <div href="#lb-gallery2-h" data-slide-to="4" data-toggle="modal">
                                    <img src="assets/images/gallery04.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Awesome">
                                <div href="#lb-gallery2-h" data-slide-to="5" data-toggle="modal">
                                    <img src="assets/images/gallery05.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Responsive">
                                <div href="#lb-gallery2-h" data-slide-to="6" data-toggle="modal">
                                    <img src="assets/images/gallery06.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p2" data-video-url="false" data-tags="Animated">
                                <div href="#lb-gallery2-h" data-slide-to="7" data-toggle="modal">
                                    <img src="assets/images/gallery07.jpg" alt="">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            -->
                            
                        </div>
                    </div>                        
                </div>
            </div>    
        </div>

</section>
