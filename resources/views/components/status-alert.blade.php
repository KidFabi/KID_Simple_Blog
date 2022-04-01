@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif (session('fail'))
    <div class="alert alert-danger" role="alert">
        {{ session('fail') }}
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ __('Fix the following errors and try again') }}.
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif