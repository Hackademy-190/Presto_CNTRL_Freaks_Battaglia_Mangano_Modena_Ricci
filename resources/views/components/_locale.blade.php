<form action="{{ route('setLocale', $lang) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn" aria-label="{{ __('ui.languageNames.' . $lang) }}">
        <img src="{{ asset('vendor/blade-flags/country-' . ($lang === 'en' ? 'gb' : $lang) . '.svg') }}"
            width="32" height="32" alt="{{ __('ui.languageNames.' . $lang) }}">
    </button>
</form>