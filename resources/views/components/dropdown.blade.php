<div class="relative inline-block text-left">
    <div>
        <button type="button"
            class="dropdown-button inline-flex w-85 md:w-60 lg:w-70 justify-between items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-500 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
            id="dropdown-button" aria-expanded="false" aria-haspopup="true">
            <span class="dropdown-selected-label">{{ $label }}</span>
            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-full lg:w-70 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none max-h-50 overflow-x-auto"
        role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button" tabindex="-1">
        <div class="py-1" role="none">
            {{ $options }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownButtons = document.querySelectorAll('.dropdown-button');

        dropdownButtons.forEach(button => {
            const parent = button.closest('.relative');
            const menu = parent.querySelector('.dropdown-menu');
            const label = button.querySelector('.dropdown-selected-label');
            const hiddenInput = parent.querySelector('input[type="hidden"]');

            // Toggle menu
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // Set selected value and label
            menu.querySelectorAll('.dropdown-option').forEach(option => {
                option.addEventListener('click', () => {
                    const value = option.getAttribute('data-value');
                    const text = option.textContent.trim();
                    label.textContent = text;
                    hiddenInput.value = value;

                    menu.classList.add('hidden');
                    button.setAttribute('aria-expanded', 'false');
                });
            });
        });

        // Close dropdowns on outside click
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
        });
    });
</script>
