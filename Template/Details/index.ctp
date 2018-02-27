<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<link rel="stylesheet" href="/css/defaultswipe.css">

<div class="swiper-container">
    <div class="swiper-wrapper">
        
        <?php for($i=0;$i<20;$i++):?>
        <div class="swiper-slide" >
            <div class="col-sm-5 border">
                <img src="https://images.yogajournal.jp/article/3980/yaNurisbWtS6rpVpD4i62egswq5dK5hy3HRERmQZ.jpeg"  style="width: 90%;" />
            </div>
            <div class="col-sm-5 border" >
                <img src="https://images.yogajournal.jp/article/3980/yaNurisbWtS6rpVpD4i62egswq5dK5hy3HRERmQZ.jpeg"  style="width: 90%;"  />
            </div>
        </div>
        <?php endfor; ?>

       
        
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
  <script src="../dist/js/swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
        initialSlide:0, //開始画像　後ろから読むため
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