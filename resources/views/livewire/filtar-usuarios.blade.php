<div>
    <form wire:submit.prevent='terminosBusqueda' class="flex
    ">
        <input class="border-red-500 bg-gray-100 p-1 pl-5 rounded-xl" type="search" placeholder="Buscador">
        <input 
        wire:model="usuario";
        type="submit"
        class="bg-gray-500 hover:bg-gray-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase w-full md:w-auto"
        value="Buscar"
    />
    </form>
   
</div>
