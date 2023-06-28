<nav class="sidebar">
    <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    Equipments
    </a>
    <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
    </div>
    </div>
    <div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <?php if(!isEqual(whoIs('user_type'),'student')):?>
        <li class="nav-item">
            <a href="<?php echo _route('item:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Items</span>
            </a>
        </li>
        <?php endif?>

        <li class="nav-item">
            <a href="<?php echo _route('course:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Courses</span>
            </a>
        </li>

        <?php if(!isEqual(whoIs('user_type'),'student')):?>
        <li class="nav-item">
            <a href="<?php echo _route('stock:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Inventory</span>
            </a>
        </li>
        <?php endif?>
        <li class="nav-item">
            <a href="<?php echo _route('borrow:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Borrow</span>
            </a>
        </li>
        <?php if(!isEqual(whoIs('user_type'),'student')):?>
        <li class="nav-item">
            <a href="<?php echo _route('user:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">User</span>
            </a>
        </li>
        <?php endif?>
        <?php if(!isEqual(whoIs('user_type'),'student')):?>
        <li class="nav-item">
            <a href="<?php echo _route('category:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Categories</span>
            </a>
        </li>
        <?php endif?>
        <li class="nav-item">
            <a href="<?php echo _route('report:index')?>" class="nav-link">
                <i class="link-icon" data-feather="message-square"></i>
                <span class="link-title">Reports</span>
            </a>
        </li>
    </ul>
    </div>
</nav>