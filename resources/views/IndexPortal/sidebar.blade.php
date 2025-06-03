  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="https://portal.ms-lhokseumawe.go.id/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Bilik Hukum Logo" width="35">
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">Portal</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
          @if (!function_exists('isActiveSubMenu'))
            @php
              function isActiveSubMenu($url)
              {
                $currentUrl = request()->path();
               
                $urlParts = explode('/', $currentUrl);
               
                $currentPart = isset($urlParts[1]) ? $urlParts[1] : '';
               
                if (strpos($url, '.') !== false) {
                    $urlParts = explode('.', $url);
                    $url = end($urlParts); // Ambil bagian setelah titik
                }
                return $url == $currentPart ? 'active' : '';
              }
            @endphp
      
          @endif

          @if (!function_exists('isActiveChildSubMenu'))
            @php
              function isActiveChildSubMenu($childRoute)
              {
                  $currentUrl = str_replace('/', '.', request()->path());
                  return $childRoute == $currentUrl ? 'active' : '';
              }
            @endphp
          @endif

          <ul class="menu-inner py-1">
            @php                
              $sortedSidebar = $sidebar->sortBy('menu.order');
            @endphp
            @foreach($sortedSidebar as $accessMenu)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ $accessMenu->menu->menu_name }}</span>
                </li>
                @php                    
                    $sortedAccessSubs = $accessMenu->accessSubs->sortBy('menuSub.order');
                @endphp
                @foreach($sortedAccessSubs as $accessSub)
                    @if($accessSub->menuSub->menu_id == $accessMenu->menu_id)
                        <li class="menu-item {{ isActiveSubMenu($accessSub->menuSub->url) }}">
                            <a href="{{ $accessSub->menuSub->itemsub != 1 ? route($accessSub->menuSub->url) : 'javascript:void(0);' }}" class="menu-link {{ $accessSub->menuSub->itemsub != 0 ? 'menu-toggle' : '' }}">
                                <i class="menu-icon tf-icons {{ $accessSub->menuSub->icon }}"></i>                
                                <div class="text-truncate" data-i18n="{{ ucfirst($accessSub->menuSub->title) }}">{{ ucfirst($accessSub->menuSub->title) }}</div>
                            </a>
                            @if($accessSub->menuSub->itemsub != 0)
                                @php                                    
                                    $sortedAccessSubChildren = $accessSub->accessSubChildren->sortBy('menuSubChild.order');                        
                                @endphp
                                <ul class="menu-sub">
                                    @foreach($sortedAccessSubChildren as $accessSubChild)
                                        @if($accessSubChild->menuSubChild->id_submenu == $accessSub->menuSub->id) <!-- Check to ensure child belongs to the correct submenu -->
                                            <li class="menu-item {{ isActiveChildSubMenu($accessSubChild->menuSubChild->url) }}">
                                                <a href="{{ route($accessSubChild->menuSubChild->url) }}" class="menu-link">
                                                    <div class="text-truncate" data-i18n="{{ ucfirst($accessSubChild->menuSubChild->title) }}">{{ ucfirst($accessSubChild->menuSubChild->title) }}</div>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            @endforeach

        </ul>
            
        
        
        
       
        </aside>
        <!-- / Menu -->