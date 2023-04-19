<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo">
                    <a href="{{ route('backend.index') }}">
                        {{-- <img style="width:80%;" src="{{ url('/uploads/settings/',settings()->logo) }}"
                            alt="{{ settings()->name }}" srcset=""> --}}
                        <span class="font-weight-bold"> {{ settings()->name }}</span>
                    </a>
                </div>
                @permission('backend.index')
                <li>
                    <a href="{{ route('backend.index') }}"><i class="fa-solid fa-house"></i> Dashboard </a>
                </li>
                @endpermission
                @permission('backend.shop.index')
                <li>
                    <a href="{{ route('backend.shop.index') }}">
                        <i class="fa-solid fa-store"></i>
                        Shop
                    </a>
                </li>
                @endpermission
                @permission('backend.order.management.index')
                <li>
                    <a href="{{ route('backend.order.management.index') }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Orders
                    </a>
                </li>
                @endpermission
                @permission('backend.customer-order.index')
                <li>
                    <a href="{{ route('backend.customer-order.index') }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                        Customer Order
                    </a>
                </li>
                @endpermission
                @permission('backend.role-permission.index')
                <li>
                    <a href="{{ route('backend.role-permission.index') }}"><i class="fa-solid fa-user-secret"></i></i>
                        Access Control </a>
                </li>
                @endpermission
                {{-- @if (hasAnyPermissions('backend.user.index')) --}}
                @permission('backend.user.index')
                <li>
                    <a href="{{ route('backend.user.index') }}"><i class="fa-solid fa-user"></i></i>
                        User </a>
                </li>
                @endpermission
                @permission('backend.category.index')
                <li>
                    <a href="{{ route('backend.category.index') }}">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        Category
                    </a>
                </li>
                @endpermission
                @permission('backend.product.index')
                <li>
                    <a href="{{ route('backend.product.index') }}">
                        <i class="fa-solid fa-qrcode"></i>
                        Product
                    </a>
                </li>
                @endpermission
                @permission('backend.exibition.index')
                <li>
                    <a href="{{ route('backend.exibition.index') }}">
                        <i class="fa-solid fa-qrcode"></i>
                        Exibition
                    </a>
                </li>
                @endpermission
                @permission('backend.settings.index')
                <li>
                    <a href="{{ route('backend.settings.index') }}"><i class="fa-solid fa-gear"></i></i>
                        Settings </a>
                </li>
                @endpermission
            </ul>
        </div>
    </div>
</div>

<!-- /# sidebar -->