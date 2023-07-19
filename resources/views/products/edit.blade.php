<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
        </div>
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label for="descriptionInput" class="form-label">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description"
                    value="{{ $product->description }}">
            </div>
            <div class="mb-3">
                <label for="priceInput" class="form-label">Price</label>
                <input type="number" class="form-control" id="priceInput" name="price" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="quantityInput" class="form-label">Qty</label>
                <input type="number" class="form-control" id="quantityInput" name="quantity"
                    value="{{ $product->quantity }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-striped-columns">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonAttachedCategories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto">
                                            <form
                                                action="{{ route('categoryproduct.store', ['category' => $category->id, 'product' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="table table-striped table-striped-columns">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attachedCategories as $categoy)
                            <tr>
                                <td>{{ $categoy->name }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-auto">
                                            <form
                                                action="{{ route('categoryproduct.destroy', ['category' => $category->id, 'product' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-guest-layout>
