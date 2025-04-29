<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url() ?>" class="nav-link">Home</a>
        </li>
        <?php if(isset($nav_links)): ?>
            <?php foreach($nav_links as $link): ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= $link['url'] ?>" class="nav-link"><?= $link['title'] ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline" action="<?= base_url('search') ?>" method="get">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" name="q" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <?php if(isset($messages) && count($messages) > 0): ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge"><?= count($messages) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php foreach($messages as $index => $message): ?>
                    <?php if($index > 0): ?>
                        <div class="dropdown-divider"></div>
                    <?php endif; ?>
                    <a href="<?= base_url('messages/view/' . $message['id']) ?>" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="<?= $message['avatar'] ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    <?= $message['sender'] ?>
                                    <span class="float-right text-sm text-<?= $message['priority_color'] ?>">
                                        <i class="fas fa-star"></i>
                                    </span>
                                </h3>
                                <p class="text-sm"><?= $message['subject'] ?></p>
                                <p class="text-sm text-muted">
                                    <i class="far fa-clock mr-1"></i> <?= $message['time_ago'] ?>
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('messages') ?>" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <?php endif; ?>

        <!-- Notifications Dropdown Menu -->
        <?php if(isset($notifications) && count($notifications) > 0): ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?= count($notifications) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= count($notifications) ?> Notifications</span>
                <?php foreach($notifications as $notification): ?>
                    <div class="dropdown-divider"></div>
                    <a href="<?= $notification['url'] ?>" class="dropdown-item">
                        <i class="<?= $notification['icon'] ?> mr-2"></i> <?= $notification['text'] ?>
                        <span class="float-right text-muted text-sm"><?= $notification['time_ago'] ?></span>
                    </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('notifications') ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <!-- User dropdown -->
        <?php if(isset($user) && $user): ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= $user['name'] ?></span>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('profile') ?>" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('settings') ?>" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('logout') ?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
        <?php endif; ?>
    </ul>
</nav> 