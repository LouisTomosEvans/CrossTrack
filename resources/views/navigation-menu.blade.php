<nav x-data="{ open: false }" style="background-color: #f05628;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center" style="width: 120px">
                    <a href="{{ route('dashboard') }}" style="width: 120px">
                        <x-jet-application-mark style="width: 120px" class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div style="display: flex; align-content: center; align-self: center; padding: 10px; border-radius: 5px; padding-left: 12px; padding-right: 12px;">
                        <a style="color: white; font-size: 0.75rem; font-weight: bold; text-decoration: none;" href="/dashboard">
                        ◄ Back To Dashboard
                        </a>
                    </div>
            </div>
        </div>
    </div>
</nav>
