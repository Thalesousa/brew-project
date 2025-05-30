<div>
    <button
        type="button"
        class="bg-transparent hover:bg-blue-700 text-blue-600 font-semibold py-1.5 px-4
                  rounded-lg transition duration-300 border-blue-600 border-2 hover:border-transparent
                  hover:text-white cursor-pointer"
        wire:click="toggleModal"
    >
        <span class="hidden md:inline">Novo Produto</span>
        <span class="inline md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </span>
    </button>
</div>
