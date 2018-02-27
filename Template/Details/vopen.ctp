<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<link rel="stylesheet" href="/css/defaultswipe.css">

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php 
                $pathes = [];
                foreach($list as $value):
                    $pathes=[];
                    if(isset($value[ 'filename' ])){
                        $pathes = "/comics/".$value[ 'user' ][ 'code' ]."/".$value[ 'magazinetitle_id' ]."/data/".$value[ 'magazinegroup_id' ]."/".$value[ 'filename' ];
                    }

         ?>
        
            <div class="swiper-slide" >
                <div class="col-sm-12 border">
                    <img src="<?=$pathes?>"  class="img" />
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->

  </div>

  <!-- Swiper JS -->
  <script src="/dist/js/swiper.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  
  <!-- Initialize Swiper -->
  <script>
    $(function(){  
        var _ht = $(window).height()*0.95;
        $(".img").height(_ht);
    });
      
    var swiper = new Swiper('.swiper-container', {
        initialSlide:0, //開始画像
        direction:'vertical',
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
      },
      keyboard: {
        enabled: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>