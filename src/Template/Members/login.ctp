<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<section class="mbr-gallery mbr-slider-carousel cid-qHDNxFnYJ7" id="gallery2-h">
    <?= $this->Form->create() ?>
    <div class="form-group">
        <label class="form-control-label mbr-fonts-style display-7" for="email-form1-98">Username</label>
        <input type="text" class="form-control" name="username" data-form-field="Email" required="" id="email-form1-98">
    </div>
    <div class="form-group">
        <label class="form-control-label mbr-fonts-style display-7" for="email-form1-98">Password</label>
        <input type="password" class="form-control" name="password" data-form-field="Email" required="" id="email-form1-98">
    </div>
    
   <button href="" type="submit" class="btn btn-primary btn-form ">SEND FORM</button>
    
    <?= $this->Form->end() ?>
</section>
