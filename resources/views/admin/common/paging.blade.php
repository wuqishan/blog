{{ $pagingHelper = \App\Helper\PagingHelper::pageInit($results['data']['total'], $results['data']['page_number']) }}

<div class="bs-component" style="margin-bottom: 15px;">
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">

            @if($pagingHelper->getPrevUrl())
                <a class="btn btn-secondary" type="button">上一页</a>
            @endif

{{--            @foreach()--}}

            <button class="btn btn-secondary" type="button">1</button>
            <button class="btn btn-secondary" type="button">2</button>
            <button class="btn btn-secondary active" type="button">3</button>
            <button class="btn btn-secondary" type="button">4</button>
        </div>
    </div>
</div>