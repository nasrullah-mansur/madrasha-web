<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        
   
        
        <li class=" nav-item {{ Route::is('image_gallery.*', 'image_gallery_category.*') ? 'active open' : '' }}">
          <a href="#"><i class="ft-image"></i><span class="menu-title">Gallery</span></a>
          <ul class="menu-content">
            <li class="{{ Route::is('image_gallery.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('image_gallery.index') }}">Image</a>
            </li>
            <li class="{{ Route::is('image_gallery_category.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('image_gallery_category.index') }}">Image Category</a>
            </li>
            
          </ul>
        </li>


        <li class=" nav-item ">
          <a href="#"><i class="ft-layers"></i><span class="menu-title">Sections</span></a>
          <ul class="menu-content">
            <li class="{{ Route::is('banner.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('banner.edit') }}">Banner</a>
            </li>

            <li class="{{ Route::is('slider.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('slider.index') }}">Sliders</a>
            </li>

            <li class="{{ Route::is('division.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('division.index') }}">Divisions</a>
            </li>

            <li class="{{ Route::is('notice.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('notice.edit') }}">Notice</a>
            </li>

            <li class="{{ Route::is('glance.*') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('glance.edit') }}">Glance</a>
            </li>

            <li class="{{ Route::is('contact.section') ? 'active' : '' }}">
                <a class="menu-item" href="{{ route('contact.section') }}">Contact</a>
            </li>

          </ul>
        </li>

        <li class=" nav-item {{ Route::is('admin.user.*', 'admin.user', 'admin.admin.*', 'admin.admin') ? 'active' : ''}}">
          <a href="#"><i class="ft-user"></i><span class="menu-title">Users</span></a>
          <ul class="menu-content">
            <li class="{{ Route::is('admin.admin.*', 'admin.admin') ? 'active' : '' }}">
                <a class="menu-item" href="{{route('admin.admin')}}">Admins</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item {{ Route::is('appearance.edit') ? 'active' : ''}}">
            <a href="{{route('appearance.edit')}}"><i class="ft-settings"></i><span class="menu-title">Appearance</span></a>
        </li>

        <li class=" nav-item {{ Route::is('menu.*', 'menuItem.*') ? 'active' : ''}}">
            <a href="{{route('menu.index')}}"><i class="ft-menu"></i><span class="menu-title">Menu</span></a>
        </li>

        <li class=" nav-item {{ Route::is('page.seo.*') ? 'active' : ''}}">
            <a href="{{route('page.seo.index')}}"><i class="ft-monitor"></i><span class="menu-title">Page SEO</span></a>
        </li>

        <li class=" nav-item {{ Route::is('custom.page.*') ? 'active' : ''}}">
            <a href="{{route('custom.page.index')}}"><i class="ft-clipboard"></i><span class="menu-title">Custom Page</span></a>
        </li>
        
      </ul>
    </div>
  </div>