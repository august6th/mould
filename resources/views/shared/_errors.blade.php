@if (count($errors) > 0)
<div class="alert alert-danger show-errors">
    <ul>
        @foreach($errors->all() as $error)
        <li><small>{{ $error }}</small></li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
</div>
@endif
