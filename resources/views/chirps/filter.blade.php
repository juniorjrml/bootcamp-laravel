<form action="{{ route('chirps.index') }}" method="get">
<div class="hidden p-2 sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div>
        @if (isset($search))
            <span class="bg-gray-200 px-2 py-2 rounded">
                Filtro Atual:
                <span class="inline-block px-2 py-1 bg-blue-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    {{$search}}
                    <span class=" inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-600 text-white rounded ml-2">
                        <a href="{{route("chirps.index")}}">resetar</a>

                    </span>
                </span>
            </span>
        @endif
    </div>

    <div>
        <input type="text" name="search" value="@if($search) {{$search}} @endif" class="
            bg-gray-200
            appearance-none
            border-2 border-gray-200
            rounded
            py-2 px-4
            text-gray-700
            focus:outline-none focus:bg-white focus:border-purple-500
        ">
        <button type="submit" class="
                shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded
            ">
            Pesquisar
        </button>
    </div>
</div>
</form><Br>
