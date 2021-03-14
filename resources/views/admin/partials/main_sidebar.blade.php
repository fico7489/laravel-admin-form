<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link">
                <i class="icon-home4"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Webshop Narudžbe</div>
        </li>
        @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.orders.index'), 'label' => 'Narudžbe', 'count' => App\Models\Order::whereNotIn('status', [App\Models\Order::STATUS_CART, App\Models\Order::STATUS_ABANDONED])->count(), 'icon' => 'icon-cart'])
        @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.users.index'), 'label' => 'Korisnici', 'count' => App\Models\User::count(), 'icon' => 'icon-users'])
        @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.contacts.index'), 'label' => 'Kontakti', 'count' => App\Models\Contact::count(), 'icon' => 'icon-bubble-notification'])

        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Webshop Proizvodi</div>
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.products.index'), 'label' => 'Proizvodi', 'count' => App\Models\Product::count(), 'icon' => 'icon-box'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.categories.index'), 'label' => 'Kategorije', 'count' => App\Models\Category::count(), 'icon' => 'icon-price-tag3'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.productCollections.index'), 'label' => 'Kolekcije proizvoda', 'count' => App\Models\ProductCollection::count(), 'icon' => 'icon-price-tags'])
        </li>

        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Sadržaj web stranice</div>
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.pages.index'), 'label' => 'Stranice', 'count' => App\Models\Page::count(), 'icon' => 'icon-magazine'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.resources.index'), 'label' => 'Resursi', 'count' => App\Models\Resource::count(), 'icon' => 'icon-paragraph-left2'])
        </li>
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Izvještaji</div>
        </li>
        @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.reports.sales'), 'label' => 'Prodaja', 'icon' => 'icon-graph'])

        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Postavke</div>
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.homepageSliders.index'), 'label' => 'Naslovna - slideri', 'icon' => 'icon-drag-left-right'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.seo.dashboard'), 'label' => 'Seo', 'icon' => 'icon-magazine'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.points.index'), 'label' => 'Bodovi', 'icon' => 'icon-medal2'])
            @include('admin_form::admin.partials.main_sidebar_item', ['route' => route('admin.settings.index'), 'label' => 'Postavke', 'icon' => 'icon-cog'])
        </li>

        <br/><br/><br/><br/>
        &nbsp;
    </ul>
</div>
