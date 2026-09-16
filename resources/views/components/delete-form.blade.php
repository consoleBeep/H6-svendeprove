@props(['action', 'confirm' => null, 'formClass' => null])

<form method="POST" action="{{ $action }}" @if ($formClass) class="{{ $formClass }}" @endif
      @if ($confirm) onsubmit="return confirm('{{ $confirm }}')" @endif>
    @csrf
    @method('DELETE')
    <button type="submit" {{ $attributes }}>{{ $slot }}</button>
</form>
