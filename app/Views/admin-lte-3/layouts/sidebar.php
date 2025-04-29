<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url((!empty($Pengaturan->logo) ? 'file/app/' . $Pengaturan->logo : 'public/assets/theme/' . $ThemePath . '/dist/img/AdminLTELogo.png')) ?>" 
             alt="<?= $Pengaturan->judul ?>" 
             class="brand-image img-circle elevation-3" 
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $Pengaturan->judul ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if(isset($user) && $user): ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(!empty($user['avatar']) ? $user['avatar'] : 'public/assets/theme/' . $ThemePath . '/dist/img/user2-160x160.jpg') ?>" 
                     class="img-circle elevation-2" 
                     alt="<?= $user['name'] ?>">
            </div>
            <div class="info">
                <a href="<?= base_url('profile') ?>" class="d-block"><?= $user['name'] ?></a>
            </div>
        </div>
        <?php endif; ?>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link <?= (current_url() == base_url()) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <!-- Dynamic Menu -->
                <?php if(isset($menu_items) && is_array($menu_items)): ?>
                    <?php foreach($menu_items as $menu): ?>
                        <?php if(isset($menu['submenu']) && count($menu['submenu']) > 0): ?>
                            <!-- Menu with submenu -->
                            <li class="nav-item <?= ($menu['active'] ?? false) ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= ($menu['active'] ?? false) ? 'active' : '' ?>">
                                    <i class="nav-icon <?= $menu['icon'] ?>"></i>
                                    <p>
                                        <?= $menu['title'] ?>
                                        <i class="right fas fa-angle-left"></i>
                                        <?php if(isset($menu['badge'])): ?>
                                            <span class="badge badge-<?= $menu['badge']['type'] ?? 'info' ?> right"><?= $menu['badge']['text'] ?></span>
                                        <?php endif; ?>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php foreach($menu['submenu'] as $submenu): ?>
                                        <li class="nav-item">
                                            <a href="<?= $submenu['url'] ?>" class="nav-link <?= ($submenu['active'] ?? false) ? 'active' : '' ?>">
                                                <i class="<?= $submenu['icon'] ?> nav-icon"></i>
                                                <p><?= $submenu['title'] ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <!-- Regular menu item -->
                            <li class="nav-item">
                                <a href="<?= $menu['url'] ?>" class="nav-link <?= ($menu['active'] ?? false) ? 'active' : '' ?>">
                                    <i class="nav-icon <?= $menu['icon'] ?>"></i>
                                    <p>
                                        <?= $menu['title'] ?>
                                        <?php if(isset($menu['badge'])): ?>
                                            <span class="badge badge-<?= $menu['badge']['type'] ?? 'info' ?> right"><?= $menu['badge']['text'] ?></span>
                                        <?php endif; ?>
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <!-- Static menu items can be added here if needed -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside> 