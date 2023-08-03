<div class="col-12 col-md-auto mx-auto my-2">
    <div class="row">
        <div class="col-auto ms-auto">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                name="search" value="{{ Request::instance()->get('search') }}">
            <input type="hidden" name="page" value="1">
        </div>
        <div class="col-auto me-auto">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
    </div>
</div>