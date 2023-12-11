<div>

        <x-shop::accordion>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <h2 class="text-[26px] font-medium max-sm:text-[20px]">
                        @lang('shop::app.checkout.onepage.addresses.billing.billing-address')
                    </h2>
                </div>
            </x-slot:header>

            <x-slot:content>

                <!-- Billing address form -->
                <x-shop::form
                    v-slot="{ meta, errors, handleSubmit }"
                    as="div"
                >
                    <form @submit="handleSubmit($event, store)">

                        <div class="grid grid-cols-2 gap-x-[20px]">
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="!mt-[0px] required">
                                    @lang('shop::app.checkout.onepage.addresses.billing.first-name')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="text"
                                    name="billing[first_name]"
                                    rules="required"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.first-name')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.first-name')"
                                    v-model="forms.billing.address.first_name"
                                >
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[first_name]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.first_name.after') !!}


                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="!mt-[0px] required">
                                    @lang('shop::app.checkout.onepage.addresses.billing.last-name')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="text"
                                    name="billing[last_name]"
                                    rules="required"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.last-name')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.last-name')"
                                    v-model="forms.billing.address.last_name"
                                >
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[last_name]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.last_name.after') !!}
                        </div>

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="!mt-[0px] required">
                                @lang('shop::app.checkout.onepage.addresses.billing.email')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="email"
                                name="billing[email]"
                                rules="required|email"
                                :label="trans('shop::app.checkout.onepage.addresses.billing.email')"
                                placeholder="email@example.com"
                                v-model="forms.billing.address.email"
                            >
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error
                                control-name="billing[email]"
                            >
                            </x-shop::form.control-group.error>
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.email.after') !!}

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="!mt-[0px] required">
                                @lang('shop::app.checkout.onepage.addresses.billing.street-address')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="text"
                                name="billing[address1][]"
                                rules="required"
                                :label="trans('shop::app.checkout.onepage.addresses.billing.street-address')"
                                :placeholder="trans('shop::app.checkout.onepage.addresses.billing.street-address')"
                                v-model="forms.billing.address.address1[0]"
                            >
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error
                                class="mb-2"
                                control-name="billing[address1][]"
                            >
                            </x-shop::form.control-group.error>

                            @if (core()->getConfigData('customer.address.information.street_lines') > 1)
                                @for ($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++)
                                    <x-shop::form.control-group.control
                                        type="text"
                                        name="billing[address1][{{ $i }}]"
                                        :label="trans('shop::app.checkout.onepage.addresses.billing.street-address')"
                                        :placeholder="trans('shop::app.checkout.onepage.addresses.billing.street-address')"
                                        v-model="forms.billing.address.address1[{{$i}}]"
                                    >
                                    </x-shop::form.control-group.control>
                                @endfor
                            @endif
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.address1.after') !!}

                        <div class="grid grid-cols-2 gap-x-[20px]">
                            <x-shop::form.control-group class="!mb-4">
                                <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }} !mt-[0px]">
                                    @lang('shop::app.checkout.onepage.addresses.billing.country')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="select"
                                    name="billing[country]"
                                    class="py-2 mb-2"
                                    rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.country')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.country')"
                                    v-model="forms.billing.address.country"
                                >
                                    <option
                                        v-for="country in countries"
                                        :value="country.code"
                                        v-text="country.name"
                                    >
                                    </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[country]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.country.after') !!}

                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="!mt-[0px] required">
                                    @lang('shop::app.checkout.onepage.addresses.billing.city')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="select"
                                    name="billing[city]"
                                    rules="required"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.city')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.city')"
                                    v-model="forms.billing.address.city"
                                >
                                    <option
                                        v-for='(state, index) in states[forms.billing.address.country]'
                                        :value="state.code"
                                    >
                                        @{{ state.default_name }}
                                    </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[city]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.city.after') !!}

                            {{-- <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }} !mt-[0px]">
                                    @lang('shop::app.checkout.onepage.addresses.billing.state')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="select"
                                    name="billing[city]"
                                    class="py-2 mb-2"
                                    rules="required"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.state')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.state')"
                                    v-model="forms.billing.address.city"
                                >
                                    <option
                                        v-for='(state, index) in states[forms.billing.address.country]'
                                        :value="state.code"
                                    >
                                        @{{ state.default_name }}
                                    </option>
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[state]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.state.after') !!} --}}

                        </div>

                        {{-- <div class="grid grid-cols-2 gap-x-[20px]">
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="!mt-[0px] required">
                                    @lang('shop::app.checkout.onepage.addresses.billing.city')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="text"
                                    name="billing[city]"
                                    rules="required"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.city')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.city')"
                                    v-model="forms.billing.address.city"
                                >
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[city]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.city.after') !!}

                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isPostCodeRequired() ? 'required' : '' }} !mt-[0px]">
                                    @lang('shop::app.checkout.onepage.addresses.billing.postcode')
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="text"
                                    name="billing[postcode]"
                                    rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}"
                                    :label="trans('shop::app.checkout.onepage.addresses.billing.postcode')"
                                    :placeholder="trans('shop::app.checkout.onepage.addresses.billing.postcode')"
                                    v-model="forms.billing.address.postcode"
                                >
                                </x-shop::form.control-group.control>

                                <x-shop::form.control-group.error
                                    control-name="billing[postcode]"
                                >
                                </x-shop::form.control-group.error>
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.postcode.after') !!}

                        </div> --}}

                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="!mt-[0px] required">
                                @lang('shop::app.checkout.onepage.addresses.billing.telephone')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="text"
                                name="billing[phone]"
                                rules="required|phone_uae"
                                :label="trans('shop::app.checkout.onepage.addresses.billing.telephone')"
                                :placeholder="trans('shop::app.checkout.onepage.addresses.billing.telephone')"
                                v-model="forms.billing.address.phone"
                            >
                            </x-shop::form.control-group.control>

                            <x-shop::form.control-group.error
                                control-name="billing[phone]"
                            >
                            </x-shop::form.control-group.error>
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.phone.after') !!}

                        {{-- <div class="mt-[30px] pb-[15px]">
                            <div class="grid gap-[10px]">
                                @auth('customer')
                                    <div class="select-none flex gap-x-[15px]">
                                        <input
                                            type="checkbox"
                                            name="billing[default_address]"
                                            id="billing[default_address]"
                                            class="hidden peer"
                                            v-model="forms.billing.address.isSaved"
                                        >

                                        <label
                                            class="icon-uncheck text-[24px] text-navyBlue peer-checked:icon-check-box peer-checked:text-navyBlue cursor-pointer"
                                            for="billing[default_address]"
                                        >
                                        </label>

                                        <label for="billing[default_address]">
                                            @lang('shop::app.checkout.onepage.addresses.billing.save-address')
                                        </label>
                                    </div>
                                @endauth
                            </div>
                        </div> --}}

                        <div class="flex justify-end mt-4 mb-4">
                            <button
                                v-if="! isProcessing"
                                type="submit"
                                class="block py-[11px] px-[43px] bg-navyBlue text-white text-base w-max font-medium rounded-[18px] text-center cursor-pointer"
                            >
                                @lang('shop::app.checkout.onepage.addresses.billing.confirm')
                            </button>

                            <button
                                v-else
                                class="flex gap-[10px] items-center w-max py-[11px] px-[32px] bg-navyBlue text-white text-base font-medium rounded-[18px] text-center max-sm:text-[14px] max-sm:px-[25px] max-sm:mb-[40px]"
                            >
                                <!-- Spinner -->
                                <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    >
                                    </circle>

                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    >
                                    </path>
                                </svg>

                                @lang('shop::app.checkout.onepage.summary.processing')
                            </button>
                        </div>
                    </form>
                </x-shop::form>

                {!! view_render_event('bagisto.shop.checkout.onepage.billing_address.after') !!}

            </x-slot:content>
        </x-shop::accordion>

</div>
