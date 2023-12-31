<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
    $showCompare = (bool) core()->getConfigData('general.content.shop.compare_option');

    $showWishlist = (bool) core()->getConfigData('general.content.shop.wishlist_option');
@endphp

<div class="flex-wrap hidden gap-4 px-4 pt-6 max-lg:flex max-lg:mb-4">
    <div class="flex items-center justify-between w-full">
        <!-- Left Navigation -->
        <div class="flex items-center gap-x-1.5">
            <x-shop::drawer
                position="left"
                width="80%"
            >
                <x-slot:toggle>
                    <span class="text-2xl cursor-pointer icon-hamburger"></span>
                </x-slot:toggle>

                <x-slot:header>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('shop.home.index') }}">
                            <img
                                src="{{ bagisto_asset('images/logo.png') }}"
                                alt="ME Myanmar Foods & Products"
                                width="55"
                            >
                        </a>
                    </div>
                </x-slot:header>

                <x-slot:content>
                    <!-- Account Profile Hero Section -->
                    <div class="grid grid-cols-[auto_1fr] gap-4 items-center mb-4 p-2.5 border border-[#E9E9E9] rounded-xl">
                        <div class="">
                            <img
                                src="{{ auth()->user()?->image_url ??  bagisto_asset('images/user-placeholder.png') }}"
                                class="w-[60px] h-[60px] rounded-full"
                            >
                        </div>

                        @guest('customer')
                            <a
                                href="{{ route('shop.customer.session.create') }}"
                                class="flex text-base font-medium"
                            >
                                @lang('Sign up or Login')

                                <i class="icon-double-arrow text-2xl ltr:ml-2.5 rtl:mr-2.5"></i>
                            </a>
                        @endguest

                        @auth('customer')
                            <div class="flex flex-col gap-2.5 justify-between">
                                <p class="text-2xl font-mediums">Hello! {{ auth()->user()?->first_name }}</p>

                                <p class="text-[#6E6E6E] ">{{ auth()->user()?->email }}</p>
                            </div>
                        @endauth
                    </div>

                    <!-- Mobile category view -->
                    {{-- <v-mobile-category></v-mobile-category> --}}

                    <!-- Localization & Currency Section -->
                    {{-- <div class="absolute bottom-0 left-0 flex items-center justify-between w-full p-4 mb-4 bg-white shadow-lg gap-x-5">
                        <x-shop::dropdown position="top-left">
                            <!-- Dropdown Toggler -->
                            <x-slot:toggle>
                                <div class="w-full flex gap-2.5 justify-between items-center cursor-pointer" role="button">
                                    <span>
                                        {{ core()->getCurrentCurrency()->symbol . ' ' . core()->getCurrentCurrencyCode() }}
                                    </span>

                                    <span
                                        class="text-2xl icon-arrow-down"
                                        role="presentation"
                                    ></span>
                                </div>
                            </x-slot:toggle>

                            <!-- Dropdown Content -->
                            <x-slot:content class="!p-0">
                                <v-currency-switcher></v-currency-switcher>
                            </x-slot:content>
                        </x-shop::dropdown>

                        <x-shop::dropdown position="top-right">
                            <x-slot:toggle>
                                <!-- Dropdown Toggler -->
                                <div class="w-full flex gap-2.5 justify-between items-center cursor-pointer" role="button">
                                    <img
                                        src="{{ ! empty(core()->getCurrentLocale()->logo_url)
                                                ? core()->getCurrentLocale()->logo_url
                                                : bagisto_asset('images/default-language.svg')
                                            }}"
                                        class="h-full"
                                        alt="Default locale"
                                        width="24"
                                        height="16"
                                    />

                                    <span>
                                        {{ core()->getCurrentChannel()->locales()->orderBy('name')->where('code', app()->getLocale())->value('name') }}
                                    </span>

                                    <span
                                        class="text-2xl icon-arrow-down"
                                        role="presentation"
                                    ></span>
                                </div>
                            </x-slot:toggle>

                            <!-- Dropdown Content -->
                            <x-slot:content class="!p-0">
                                <v-locale-switcher></v-locale-switcher>
                            </x-slot:content>
                        </x-shop::dropdown>
                    </div> --}}
                </x-slot:content>

                <x-slot:footer></x-slot:footer>
            </x-shop::drawer>

            <a
                href="{{ route('shop.home.index') }}"
                class=""
                aria-label="@lang('shop::app.components.layouts.header.bagisto')"
            >
                <img
                    src="{{ bagisto_asset('images/logo.png') }}"
                    alt="ME Myanmar Foods & Products"
                    width="55"
                >
            </a>
        </div>

        <!-- Right Navigation -->
        <div>
            <div class="flex items-center gap-x-5">
                @if($showCompare)
                    <a
                        href="{{ route('shop.compare.index') }}"
                        aria-label="@lang('shop::app.components.layouts.header.compare')"
                    >
                        <span class="text-2xl cursor-pointer icon-compare"></span>
                    </a>
                @endif

                @include('shop::checkout.cart.mini-cart')

                <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                    <x-slot:toggle>
                        <span class="text-2xl cursor-pointer icon-users"></span>
                    </x-slot:toggle>

                    <!-- Guest Dropdown -->
                    @guest('customer')
                        <x-slot:content>
                            <div class="grid gap-2.5">
                                <p class="text-xl font-dmserif">
                                    @lang('shop::app.components.layouts.header.welcome-guest')
                                </p>

                                <p class="text-sm">
                                    @lang('shop::app.components.layouts.header.dropdown-text')
                                </p>
                            </div>

                            <p class="w-full mt-3 py-2px border border-[#E9E9E9]"></p>

                            <div class="flex gap-4 mt-6">
                                <a
                                    href="{{ route('shop.customer.session.create') }}"
                                    class="block w-max mx-auto m-0 ltr:ml-0 rtl:mr-0 py-4 px-7 bg-navyBlue rounded-2xl text-white text-base font-medium text-center cursor-pointer"
                                >
                                    @lang('shop::app.components.layouts.header.sign-in')
                                </a>

                                <a
                                    href="{{ route('shop.customers.register.index') }}"
                                    class="block w-max mx-auto m-0 ltr:ml-0 rtl:mr-0 py-3.5 px-7 bg-white border-2 border-navyBlue rounded-2xl text-navyBlue text-base font-medium  text-center cursor-pointer"
                                >
                                    @lang('shop::app.components.layouts.header.sign-up')
                                </a>
                            </div>
                        </x-slot:content>
                    @endguest

                    <!-- Customers Dropdown -->
                    @auth('customer')
                        <x-slot:content class="!p-0">
                            <div class="grid gap-2.5 p-5 pb-0">
                                <p class="text-xl font-dmserif">
                                    @lang('shop::app.components.layouts.header.welcome')’
                                    {{ auth()->guard('customer')->user()->first_name }}
                                </p>

                                <p class="text-sm">
                                    @lang('shop::app.components.layouts.header.dropdown-text')
                                </p>
                            </div>

                            <p class="w-full mt-3 py-2px border border-[#E9E9E9]"></p>

                            <div class="grid gap-1 mt-2.5 pb-2.5">
                                <a
                                    class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                    href="{{ route('shop.customers.account.profile.index') }}"
                                >
                                    @lang('shop::app.components.layouts.header.profile')
                                </a>

                                <a
                                    class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                    href="{{ route('shop.customers.account.orders.index') }}"
                                >
                                    @lang('shop::app.components.layouts.header.orders')
                                </a>

                                @if ($showWishlist)
                                    <a
                                        class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                        href="{{ route('shop.customers.account.wishlist.index') }}"
                                    >
                                        @lang('shop::app.components.layouts.header.wishlist')
                                    </a>
                                @endif

                                <!--Customers logout-->
                                @auth('customer')
                                    <x-shop::form
                                        method="DELETE"
                                        action="{{ route('shop.customer.session.destroy') }}"
                                        id="customerLogout"
                                    >
                                    </x-shop::form>

                                    <a
                                        class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                        href="{{ route('shop.customer.session.destroy') }}"
                                        onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                                    >
                                        @lang('shop::app.components.layouts.header.logout')
                                    </a>
                                @endauth
                            </div>
                        </x-slot:content>
                    @endauth
                </x-shop::dropdown>
            </div>
        </div>
    </div>

    <!-- Serach Catalog Form -->
    <form action="{{ route('shop.search.index') }}" class="flex items-center w-full">
        <label
            for="organic-search"
            class="sr-only"
        >
            @lang('shop::app.components.layouts.header.search')
        </label>

        <div class="relative w-full">
            <div
                class="absolute flex items-center text-2xl pointer-events-none icon-search ltr:left-3 rtl:right-3 top-3">
            </div>

            <input
                type="text"
                class="block w-full px-11 py-3.5 border border-['#E3E3E3'] rounded-xl text-gray-900 text-xs font-medium"
                name="query"
                value="{{ request('query') }}"
                placeholder="@lang('shop::app.components.layouts.header.search-text')"
                required
            >

            @if (core()->getConfigData('general.content.shop.image_search'))
                @include('shop::search.images.index')
            @endif
        </div>
    </form>
</div>

@pushOnce('scripts')
    <script type="text/x-template" id="v-mobile-category-template">
        <div>
            <template v-for="(category) in categories">
                <div class="flex justify-between items-center border border-b border-l-0 border-r-0 border-t-0 border-[#f3f3f5]">
                    <a
                        :href="category.url"
                        class="flex items-center justify-between pb-5 mt-5"
                        v-text="category.name"
                    >
                    </a>

                    <span
                        class="text-2xl cursor-pointer"
                        :class="{'icon-arrow-down': category.isOpen, 'icon-arrow-right': ! category.isOpen}"
                        @click="toggle(category)"
                    >
                    </span>
                </div>

                <div
                    class="grid gap-2"
                    v-if="category.isOpen"
                >
                    <ul v-if="category.children.length">
                        <li v-for="secondLevelCategory in category.children">
                            <div class="flex justify-between items-center ltr:ml-3 rtl:mr-3 border border-b border-l-0 border-r-0 border-t-0 border-[#f3f3f5]">
                                <a
                                    :href="secondLevelCategory.url"
                                    class="flex items-center justify-between pb-5 mt-5"
                                    v-text="secondLevelCategory.name"
                                >
                                </a>

                                <span
                                    class="text-2xl cursor-pointer"
                                    :class="{
                                        'icon-arrow-down': secondLevelCategory.category_show,
                                        'icon-arrow-right': ! secondLevelCategory.category_show
                                    }"
                                    @click="secondLevelCategory.category_show = ! secondLevelCategory.category_show"
                                >
                                </span>
                            </div>

                            <div v-if="secondLevelCategory.category_show">
                                <ul v-if="secondLevelCategory.children.length">
                                    <li v-for="thirdLevelCategory in secondLevelCategory.children">
                                        <div class="flex justify-between items-center ltr:ml-3 rtl:mr-3 border border-b border-l-0 border-r-0 border-t-0 border-[#f3f3f5]">
                                            <a
                                                :href="thirdLevelCategory.url"
                                                class="flex items-center justify-between mt-5 ltr:ml-3 rtl:mr-3 pb-5"
                                                v-text="thirdLevelCategory.name"
                                            >
                                            </a>
                                        </div>
                                    </li>
                                </ul>

                                <span
                                    class="ltr:ml-2 rtl:mr-2"
                                    v-else
                                >
                                    @lang('shop::app.components.layouts.header.no-category-found')
                                </span>
                            </div>
                        </li>
                    </ul>

                    <span
                        class="ltr:ml-2 rtl:mr-2 mt-2"
                        v-else
                    >
                        @lang('shop::app.components.layouts.header.no-category-found')
                    </span>
                </div>
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-mobile-category', {
            template: '#v-mobile-category-template',

            data() {
                return  {
                    categories: [],
                }
            },

            mounted() {
                // this.get();
            },

            methods: {
                get() {
                    this.$axios.get("{{ route('shop.api.categories.tree') }}")
                        .then(response => {
                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                toggle(selectedCategory) {
                    this.categories = this.categories.map((category) => ({
                        ...category,
                        isOpen: category.id === selectedCategory.id ? ! category.isOpen : false,
                    }));
                },
            },
        });
    </script>
@endPushOnce
