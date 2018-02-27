<?= $this->element('member_header'); ?>

<body class="skin-black">

<header class="header">
            <a href="/" class="logo">
                <img src="/assets/images/logo2.png" style="height:40px;" />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                
                <div class="navbar-right">
                    
                </div>
            </nav>
        </header>
    
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        
                        <li class="active">
                            <a href="/members/">
                                <i class="fa  fa-bars"></i> <span>作品一覧</span>
                            </a>
                                <ul class="treeview-menu" style="display: block;">
                                    <?php foreach($comictitle as $key=>$val): ?>
                                        <li>
                                            <a href="/members/edit/<?=$val[ 'id' ]?>" style="margin-left: 10px;">
                                            <i class="fa fa-angle-double-right"></i><?=h($val[ 'title' ])?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                        </li>
                        <li class="active">
                            <a href="/members/create/">
                                <i class="fa fa-wrench"></i> <span>作品登録</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="/members/profile/">
                                <i class="fa fa-user"></i> <span>プロフィール変更</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="/members/logout/">
                                <i class="fa fa-sign-out"></i> <span>ログアウト</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="/">
                                <i class="fa fa-home"></i> <span>TOPに戻る</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<?= $this->element('member_footer'); ?>            