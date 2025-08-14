<ul class="menu">
    <li class="sidebar-title">Menu</li>
   
    <li class="sidebar-item @if(Request::is('home') || Request::is('/')) active @endif">
        <a href="/" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

     <li class="sidebar-item @if(Request::is('invoice/*') || Request::is('/invoice/*')) active @endif">
        <a href="" class='sidebar-link'>
            <i class="fas fa-dollar"></i>
            <span>Invoice</span>
        </a>
    </li>

    <li class="sidebar-item  has-sub @if(Request::is('master/*')) active @endif">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-collection-fill"></i>
            <span>Master</span>
        </a>
        <ul class="submenu @if(Request::is('master/*')) active @endif">
            <li class="submenu-item @if(Request::is('master/vessel/*')) active @endif">
                <a href="">Master Vessel</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub @if(Request::is('userSystem/*') || Request::is('/userSystem/*')) active @endif">
        <a href="#" class='sidebar-link'>
            <i class="fas fa-user"></i>
            <span>User Management</span>
        </a>
        <ul class="submenu @if(Request::is('userSystem/*')) active @endif">
            <li class="submenu-item @if(Request::is('userSystem/user/*')) active @endif">
                <a href="{{route('userSystem.user.index')}}">User</a>
            </li>
            <li class="submenu-item @if(Request::is('userSystem/role/*')) active @endif">
                <a href="{{route('userSystem.role.index')}}">Role</a>
            </li>
        </ul>
    </li>
 
</ul> 