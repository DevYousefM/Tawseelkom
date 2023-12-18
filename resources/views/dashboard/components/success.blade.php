@if (session($title ?? 'success'))
    <div class="alert alert-success" id="success">{{ session($title ?? 'success') }}</div>
@endif
