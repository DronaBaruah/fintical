<nav
    class="z-50 md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 md:py-4 px-6">
    <div
        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <div
            class="md:block text-left md:pb-2 text-gray-600 mr-0 whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
            <img height=52 class="h-10 w-auto m-auto" src="{{ asset('logo.png') }}">
        </div>
        <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
                <a class="text-gray-500 block py-1 px-3" href="#pablo"
                    onclick="openDropdown(event,'notification-dropdown')"><i class="fas fa-bell"></i></a>
            </li>
            <li class="inline-block relative">
                <div class="md:hidden block sm:flex sm:items-center sm:ml-6">

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center pl-2 text-sm font-medium text-white ">
                                <div
                                    class="text-black p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full">
                                    <i class="fas fa-user"></i>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </li>
        </ul>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-2 mb-2">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <div
                            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0">
                            Fintical.com
                        </div>
                        <div class="text-xs uppercase py-1 font-bold block text-gray-700">
                            {{ Auth::user()->name }}</div>

                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button"
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="mb-4 md:min-w-full" />
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="/dashboard"
                        class="text-xs uppercase py-3 font-bold block text-pink-500 hover:text-pink-600 font">
                        <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                        Dashboard
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />

            <!-- Heading -->

            <h6 class="md:min-w-full text-gray-700 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Member Details
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="/members" class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-users mr-2 text-sm"></i>
                        Members
                    </a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li class="items-center">
                    <a href="/member_register"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-user mr-2 text-sm"></i>
                        Add Member
                    </a>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />

            @if(Auth::user()->hasRole('admin'))

            <!-- Heading -->
            <h6 class="md:min-w-full text-gray-700 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Transaction
            </h6>

            <!-- Navigation -->
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="/deposit" class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-university mr-2 text-sm"></i>
                        Deposit
                    </a>
                </li>

                <li class="items-center">
                    <a href="/interest"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-rupee-sign mr-2 text-sm"></i>
                        Collect Loan Interest
                    </a>
                </li>
                <li class="items-center">
                    <a href="/interest_non_payment"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-money-check-alt mr-2 text-sm"></i>
                        Interest Non Payment
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />


            <!-- Heading -->

            <h6 class="md:min-w-full text-gray-700 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Loan
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="/loan" class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-hand-holding-usd mr-2 text-sm"></i>
                        Issue Loan
                    </a>
                </li>

                <li class="items-center">
                    <a href="/loan_repayment"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-money-bill-alt mr-2 text-sm"></i>
                        Loan Repayment
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            @endif
            <!-- Heading -->

            <h6 class="md:min-w-full text-gray-700 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Expenditure
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="/expenditure"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-align-justify mr-2 text-sm"></i>
                        Expenditures
                    </a>
                </li>
                @if(Auth::user()->hasRole('admin'))

                <li class="items-center">
                    <a href="/expenditure/create"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-receipt mr-2 text-sm"></i>
                        Add Expenditure
                    </a>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />

            <!-- Heading -->

            <h6 class="md:min-w-full text-gray-700 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
                Reports
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                @if(Auth::user()->hasRole('admin'))
                <li class="items-center">
                    <a href="/reports" class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-clipboard-list mr-2 text-sm"></i>
                        Society Reports
                    </a>
                </li>
                <li class="items-center">
                    <a href="/members_reports"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-users mr-2 text-sm"></i>
                        Members Reports
                    </a>
                </li>
                @endif
                <li class="items-center">
                    <a href="/my_reports"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-user mr-2 text-sm"></i>
                        My Reports
                    </a>
                </li>

                <li class="items-center">
                    <a href="/settings"
                        class="text-xs uppercase py-3 font-bold block text-gray-700 hover:text-gray-500">
                        <i class="fas fa-tools mr-2 text-sm"></i>
                        Settings
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="mt-4 mb-2 md:min-w-full" />

            <div class="md:flex-col md:min-w-full flex flex-col list-none">
                <a href="/" class="text-xs  text-center py-1">
                    Copyright © {{ date('Y') }} <strong class="hover:text-red-500">Fintical Team</strong>
                </a>
            </div>
        </div>
    </div>
</nav>
<script type="text/javascript">
/* Sidebar - Side navigation menu on mobile/responsive mode */
function toggleNavbar(collapseID) {
    document.getElementById(collapseID).classList.toggle("hidden");
    document.getElementById(collapseID).classList.toggle("bg-white");
    document.getElementById(collapseID).classList.toggle("m-2");
    document.getElementById(collapseID).classList.toggle("py-3");
    document.getElementById(collapseID).classList.toggle("px-6");
}
/* Function for dropdowns */
function openDropdown(event, dropdownID) {
    let element = event.target;
    while (element.nodeName !== "A") {
        element = element.parentNode;
    }
    Popper.createPopper(element, document.getElementById(dropdownID), {
        placement: "bottom-start",
    });
    document.getElementById(dropdownID).classList.toggle("hidden");
    document.getElementById(dropdownID).classList.toggle("block");
}
</script>