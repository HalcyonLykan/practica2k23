<div class="col-auto ms-auto">
    <label for="orderBy" class="form-label">Order By</label>
    <select id="orderBy" class="form-select" name="orderBy">
        <option @if (Request::instance()->get('orderBy') && Request::instance()->get('orderBy') == '') selected @endif value=""></option>
        <option @if (Request::instance()->get('orderBy') && Request::instance()->get('orderBy') == 'name') selected @endif value="name">Name</option>
        <option @if (Request::instance()->get('orderBy') && Request::instance()->get('orderBy') == 'description') selected @endif value="description">
            Description</option>
        {{$slot}}
    </select>
</div>