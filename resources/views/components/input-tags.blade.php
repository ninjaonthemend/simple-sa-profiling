<div wire:ignore>
    <input
        x-data
        x-ref="input"
        x-init="new Tagify($refs.input, {
            whitelist: [],
            dropdown: {
                maxItems: 20,
                enabled: 0,
            }
        })

        $refs.input.addEventListener('change', function (event) {
            value = JSON.parse( event.target.value )
            values = []
            value.forEach(function (option) {
                values.push(option.value || option.text)
            })

            @this.set('{{ $attributes['wire:model'] }}', values);
        })
        "
        type="text" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
    >
</div>
