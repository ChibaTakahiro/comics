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
                    if(isset($value[0][ 'filename' ])){
                        $pathes[0] = "/comics/".$value[0][ 'code' ]."/".$value[0][ 'magazinetitle_id' ]."/data/".$value[0][ 'magazinegroup_id' ]."/".$value[0][ 'filename' ];
                    }
                    if(isset($value[1][ 'filename' ])){
                        $pathes[1] = "/comics/".$value[1][ 'code' ]."/".$value[1][ 'magazinetitle_id' ]."/data/".$value[1][ 'magazinegroup_id' ]."/".$value[1][ 'filename' ];
                    }
         ?>
        
            <div class="swiper-slide" >
                <div class="col-sm-5 border">
                    <?php if(isset($pathes[0])): ?>
                    <img src="<?=$pathes[0]?>"  class="img" />
                    <?php endif;?>
                </div>
                <div class="col-sm-5 border" >
                    <?php if(isset($pathes[1])): ?>
                    <img src="<?=$pathes[1]?>"  class="img"  />
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach;?>
        
        <!--
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
      <div class="swiper-slide">Slide 10</div>
        -->
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    <!--
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    -->
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
        initialSlide:<?=$ceil?>, //開始画像
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