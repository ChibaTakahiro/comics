
<section class="menu cid-qHDK3XhAeL" once="menu" id="menu1-e">

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="/">
                         <img src="/assets/images/logo2.png" alt="comee コミック" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap">
                    <a class="navbar-caption text-white display-4" href="/">

                    </a>
                </span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="https://mobirise.com">
                        <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="https://mobirise.com">
                        <span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="/Regists">
                        <span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        会員登録
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-buttons mbr-section-btn">
            <a class="btn btn-sm btn-primary display-4" href="/members/">
                <span class="mbri-idea mbr-iconfont mbr-iconfont-btn"></span>
                <?php if(isset($authid) && $authid > 0): ?>
                MEMBER
                <?php else: ?>
                LOGIN
                <?php endif;?>
            </a>
        </div>

    </nav>
</section>
