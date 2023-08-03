<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
        </div>
        <div>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input disabled type="text" class="form-control" id="nameInput" name="name"
                    value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label for="descriptionInput" class="form-label">Description</label>
                <input disabled type="text" class="form-control" id="descriptionInput" name="description"
                    value="{{ $product->description }}">
            </div>
            <div class="mb-3">
                <label for="priceInput" class="form-label">Price</label>
                <input disabled type="number" class="form-control" id="priceInput" name="price"
                    value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="quantityInput" class="form-label">Qty</label>
                <input disabled type="number" class="form-control" id="quantityInput" name="quantity"
                    value="{{ $product->quantity }}">
            </div>
            <div class="mb-3">
                <label for="productImages" class="form-label">Product images</label>
                <input disabled class="form-control" type="file" multiple id="productImages" name="productImages[]">
            </div>
            </form>
            @if(count($attachedCategories))
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
                            @foreach ($attachedCategories as $categoy)
                                <tr>
                                    <td>{{ $categoy->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if ($product->media)
                <div class="row bg-secondary">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($product->media as $media)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ env('APP_URL', 'http://localhost') }}{{ Storage::url($media->path) }}"
                                        class="d-block mx-auto" style="max-height: 600px">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            @endif
        </div>
        </x-guest-layout>
