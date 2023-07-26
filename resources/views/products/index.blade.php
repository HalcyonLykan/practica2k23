<x-app-layout>
    <div class="container mx-auto">
        <div class="mx-2 mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg container">
    
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
            @auth
            <div class="col-auto">
                <a class="btn btn-primary" href="{{route('products.create')}}"><i class="bi bi-plus-lg"></i></a>
            </div>
            @endauth
        </div>
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    @auth
                    <th>Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    @auth
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{route("products.edit", ["product" => $product->id])}}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <x-delete-button :deleteRoute='route("products.destroy", ["product" => $product->id])'>
                                </x-delete-button>
                            </div>
                        </div>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>