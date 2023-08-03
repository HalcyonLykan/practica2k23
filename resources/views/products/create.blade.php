<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name">
            </div>
            <div class="mb-3">
                <label for="descriptionInput" class="form-label">Description</label>
                <input type="text" class="form-control" id="descriptionInput" name="description">
            </div>
            <div class="mb-3">
                <label for="priceInput" class="form-label">Price</label>
                <input type="number" class="form-control" id="priceInput" name="price">
            </div>
            <div class="mb-3">
                <label for="quantityInput" class="form-label">Qty</label>
                <input type="number" class="form-control" id="quantityInput" name="quantity">
            </div>
            <div class="mb-3">
                <label for="productImages" class="form-label">Product images</label>
                <input class="form-control" type="file" multiple id="productImages" name="productImages[]">
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
    </div>
</x-app-layout>
