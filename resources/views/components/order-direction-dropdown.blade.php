<div class="col-auto me-auto">
    <label for="orderByDirection" class="form-label">Order By Direction</label>
    <select id="orderByDirection" class="form-select" name="orderByDirection">
        <option @if (Request::instance()->get('orderByDirection') &&
                (Request::instance()->get('orderByDirection') == '' || Request::instance()->get('orderByDirection') == 'asc')) selected @endif value="asc">Ascending
        </option>
        <option @if (Request::instance()->get('orderByDirection') && Request::instance()->get('orderByDirection') == 'desc') selected @endif value="desc">Descending
        </option>
    </select>
</div>