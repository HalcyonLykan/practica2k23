{{-- Components and layout are used by calling the name of their file in kebab case prepended with an "x-" --}}
{{-- Componentele si layout-urile sunt utilizate prin scrierea numelor fisierului in kebab case prepozitionat cu "x-" --}}
<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
            @auth
                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="bi bi-plus-lg"></i></a>
                </div>
            @endauth
        </div>
        <div class="row mb-3">
            <form class="" role="search" method="GET">
                <div class="col-12 col-md-auto mx-auto my-2">
                    <x-search-field></x-search-field>
                </div>
                <div class="col-12 col-md-auto mx-auto my-2">
                    <div class="row">
                        <x-order-by-dropdown>
                            <option @if (Request::instance()->get('orderBy') && Request::instance()->get('orderBy') == 'price') selected @endif value="price">Price</option>
                            <option @if (Request::instance()->get('orderBy') && Request::instance()->get('orderBy') == 'quantity') selected @endif value="quantity">Quantity
                            </option>
                        </x-order-by-dropdown>
                        <x-order-direction-dropdown></x-order-direction-dropdown>
                    </div>
                </div>
                <div class="col-12 col-md-auto mx-auto my-2">
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <label for="productPriceGreaterThanFilter" class="form-label">Price Grater Than ...</label>
                            <input type="number" class="form-control" id="productPriceGreaterThanFilter"
                                name="productPriceGreaterThanFilter" placeholder="Price Grater Than ..." min="1"
                                max="999"  value="{{ Request::instance()->has('productPriceGreaterThanFilter') ? clamp(1, 999, Request::instance()->get('productPriceGreaterThanFilter')) : 1 }}">
                        </div>
                        <div class="col-auto me-auto">
                            <label for="productPriceLowerThanFilter" class="form-label">Price Lower Than ...</label>
                            <input type="number" class="form-control" id="productPriceLowerThanFilter"
                                name="productPriceLowerThanFilter" placeholder="Price Lower Than ..." min="0"
                                max="999" 
                                value="{{ Request::instance()->has('productPriceLowerThanFilter') ? clamp(1, 999, Request::instance()->get('productPriceLowerThanFilter')) : 999 }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <label for="productQuantityGreaterThanFilter" class="form-label">Quantity Grater Than
                                ...</label>
                                {{-- in blade files you can use global helpers and facades without importing them --}}
                                {{-- in fisierele blade putem folosi fatade si helperele globale fara a le importa --}}
                            <input type="range" class="form-range" min="0" max="999" step="1"
                                id="productQuantityGreaterThanFilter" name="productQuantityGreaterThanFilter"
                                value="{{ Request::instance()->has('productQuantityGreaterThanFilter') ? clamp(1, 999, Request::instance()->get('productQuantityGreaterThanFilter')) : 1 }}">
                        </div>
                        <div class="col-auto me-auto">
                            <label for="productQuantityLowerThanFilter" class="form-label">Quantity Lower Than
                                ...</label>
                            <input type="range" class="form-range" min="0" max="999" step="1"
                                id="productQuantityLowerThanFilter" name="productQuantityLowerThanFilter"
                                value="{{  Request::instance()->has('productQuantityGreaterThanFilter') ? clamp(1, 999, Request::instance()->get('productQuantityLowerThanFilter')) : 999 }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="d-none d-lg-table-cell">Description</th>
                    <th class="d-none d-lg-table-cell">Price</th>
                    <th>Quantity</th>
                    @auth
                        <th>Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="d-none d-lg-table-cell">{{ $product->description }}</td>
                        <td class="d-none d-lg-table-cell">{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        @auth
                            <td>
                                <div class="row">
                                    <div class="col-auto my-1">
                                        <a class="btn btn-primary"
                                            href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto my-1">
                                        <x-delete-button :deleteRoute="route('products.destroy', ['product' => $product->id])">
                                        </x-delete-button>
                                    </div>
                                </div>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</x-app-layout>
