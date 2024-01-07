<div class="flex flex-col">
    <p class="font-semibold leading-6 text-gray-800 dark:text-white">
        {{ $address->company_name ?? '' }}
    </p>

    <p class="font-semibold leading-6 text-gray-800 dark:text-white">
        {{ $address->name }}
    </p>

    <p class="text-gray-600 dark:text-gray-300 !leading-6">
        {{ $address->address1 }}<br>

        {{-- @if ($address->address2)
            {{ $address->address2 }}<br>
        @endif --}}


        {{-- {{ $address->state }}<br> --}}

        Country : {{ core()->country_name($address->country) }} @if ($address->postcode) ({{ $address->postcode }}) @endif<br>

        City : {{ $address->city }}<br>

        Address : {{ $address->address1 }}<br>

        Phone : {{ $address->phone }}
    </p>
</div>
