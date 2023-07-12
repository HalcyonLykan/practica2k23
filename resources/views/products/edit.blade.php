<x-guest-layout>
    <div class="container-fluid mx-2">
        <form action="{{route("products.update", ["product" => $product->id])}}" method="POST">
            @csrf
            @method("PATCH")
            <div class="mb-3">
              <label for="nameInput" class="form-label">Name</label>
              <input type="text" class="form-control" id="nameInput" name="name" value="{{$product->name}}">
            </div>
            <div class="mb-3">
              <label for="descriptionInput" class="form-label">Description</label>
              <input type="text" class="form-control" id="descriptionInput" name="description" value="{{$product->description}}">
            </div>
            <div class="mb-3">
              <label for="priceInput" class="form-label">price</label>
              <input type="number" class="form-control" id="priceInput" name="price" value="{{$product->price}}">
            </div>
            <div class="mb-3">
              <label for="quantityInput" class="form-label">quantity</label>
              <input type="number" class="form-control" id="quantityInput" name="quantity" value="{{$product->quantity}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-guest-layout>