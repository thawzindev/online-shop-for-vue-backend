<div class="form-group {{ $errors->has($name) ? 'has-danger' : '' }}">
  <label for="{{ $name }}">{{ $title }}</label>

  <select name="{{ $name }}" id="{{ trim($name, '[]') }}" class="form-control" 
          {{ isset($required) ? 'required' : '' }}
          {{ isset($multiple) ? 'multiple' : '' }}>
    @if (isset($objects))
      @foreach ($objects as $object)
          <option
            value="{{ $object->id }}"
            {{ old($name, (isset($selected) ? $selected : '') ) == $object->id ? 'selected' : '' }}
          >
          {{ $object->$objectName }}
        </option>
      @endforeach
    @endif
  </select>

  @if($errors->has($name))
      <label class="error mt-2 text-danger">{{ $errors->first($name) }}</label>
  @endif
</div>