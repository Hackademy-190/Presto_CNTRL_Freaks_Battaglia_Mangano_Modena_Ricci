<x-layout>
    <main class="container py-5">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-6">
                <h1>{{ __('ui.makeReviewer') }}</h1>
                <p>{{ __('ui.makeUserReviewer') }}</p>
                <p>{{ $user->name }} ({{ $user->email }})</p>
                <form method="POST" action="{{ request()->fullUrl() }}">
                    @csrf
                    <button type="submit" class="btn bg-a">{{ __('ui.makeReviewer') }}</button>
                </form>
            </div>
        </div>
    </main>
</x-layout>