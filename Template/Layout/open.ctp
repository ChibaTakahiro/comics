<?= $this->element('open_header'); ?>
<body>
    <?= $this->element('open_menu'); ?>
    
    <?= $this->Flash->render() ?>
    <div class="container clearfix" id="main">
        <div id="contents" >
            <?= $this->fetch('content') ?>
        </div>
    </div>
<?= $this->element('open_footer'); ?>