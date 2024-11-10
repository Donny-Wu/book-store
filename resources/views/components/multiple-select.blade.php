<div>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <select id="{{ $select_id }}" name="{{ $name }}[]" multiple="multiple" autocomplete="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
        @foreach($options as $id=>$text)
            <option value="{{ $id }}" >{{ $text }}</option>
        @endforeach
    </select>
    <script type="module">
        $('#{{ $select_id }}').select2({
            placeholder: '{{ $placeholder }}',
            multiple:true
        });
        @if(is_array($values)&&!empty($values))
            $('#{{ $select_id }}').val({{ Illuminate\Support\Js::from($values) }}).trigger('change');
        @endif
    </script>
</div>
