{!! view_render_event('bagisto.shop.checkout.payment.method.before') !!}

<v-payment-method ref="vPaymentMethod">
    <x-shop::shimmer.checkout.onepage.payment-method/>
</v-payment-method>

{!! view_render_event('bagisto.shop.checkout.payment.method.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-payment-method-template">
        <div class="mt-[30px] mb-[30px]">

                <div>
                    <x-shop::accordion>
                        <x-slot:header>
                            <div class="flex items-center justify-between">
                                <h2 class="text-[26px] font-medium max-sm:text-[20px]">
                                    @lang('shop::app.checkout.onepage.payment.payment-method')
                                </h2>
                            </div>
                        </x-slot:header>

                        <x-slot:content>
                            <div class="flex flex-wrap gap-[29px] mt-[30px] mb-[30px]">
                                <div
                                    class="relative cursor-pointer max-sm:max-w-full max-sm:flex-auto"
                                    v-for="(payment, index) in payment_methods"
                                    style="width: 100%"
                                >

                                    {!! view_render_event('bagisto.shop.checkout.payment-method.before') !!}

                                    <input
                                        type="radio"
                                        name="payment[method]"
                                        :value="payment.payment"
                                        :id="payment.method"
                                        class="hidden peer"
                                        @change="store(payment)"
                                        checked
                                    >

                                    <label
                                        :for="payment.method"
                                        class="absolute ltr:right-[20px] rtl:left-[20px] top-[20px] icon-radio-unselect text-[24px] text-navyBlue peer-checked:icon-radio-select cursor-pointer"
                                    >
                                    </label>

                                    <label
                                        :for="payment.method"
                                        class="w-full p-[20px] block border border-[#E9E9E9] rounded-[12px] max-sm:w-full cursor-pointer"
                                    >
                                        <img
                                            class="max-w-[55px] max-h-[45px]"
                                            :src="payment.image"
                                            width="55"
                                            height="55"
                                            :alt="payment.method_title"
                                            :title="payment.method_title"
                                        />

                                        <p class="text-sm font-semibold mt-1.5">
                                            @{{ payment.method_title }}
                                        </p>

                                        <p class="text-[12px] font-medium mt-[10px]" style="white-space: break-spaces;">
                                            @{{ payment.description }}
                                        </p>
                                    </label>

                                    {!! view_render_event('bagisto.shop.checkout.payment-method.after') !!}

                                    <!-- Todo implement the additionalDetails -->
                                    {{-- \Webkul\Payment\Payment::getAdditionalDetails($payment['method'] --}}
                                </div>
                            </div>
                        </x-slot:content>
                    </x-shop::accordion>
                </div>

        </div>
    </script>

    <script type="module">
        app.component('v-payment-method', {
            template: '#v-payment-method-template',

            data() {
                return {
                    payment_methods: [],

                    paymentMethods: [],

                    isShowPaymentMethod: true,

                    isPaymentMethodLoading: false,
                }
            },

            created() {
                this.getPaymentMethods();
            },

            methods: {
                getPaymentMethods() {
                    this.$axios.get("{{ route('shop.api.core.payments') }}")
                        .then(response => {
                            this.payment_methods = response.data.data.payment_methods;
                        })
                        .catch(function (error) {});
                },

                store(selectedPaymentMethod) {
                    this.$axios.post("{{ route('shop.checkout.onepage.payment_methods.store') }}", {
                            payment: selectedPaymentMethod
                        })
                        .then(response => {
                            this.$parent.$refs.vCartSummary.selectedPaymentMethod = selectedPaymentMethod;

                            if (response.data.cart) {
                                this.$parent.$refs.vCartSummary.canPlaceOrder = true;
                            }
                        })
                        .catch(error => console.log(error));
                },
            },
        });
    </script>
@endPushOnce
