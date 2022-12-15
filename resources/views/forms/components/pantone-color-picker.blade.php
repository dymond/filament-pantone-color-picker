<x-forms::field-wrapper :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()" :hint="$getHint()"
    :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div x-data="{
            colors: @js( $getColors() ),
            isOpen: false,
            darkSelector: '',
            colorSelectedHex: @js($colorSelectedHex),
            colorSelectedRgb: @js($colorSelectedRgb),
            changeColor(name, hex, rgb) {
                this.colorSelected = name;
                this.colorSelectedHex = hex;
                this.colorSelectedRgb = rgb;
            },
            init() {
                this.colorSelectedHex = this.arrayLookup(this.colorSelected, this.colors, 'name', 'hex');
                this.colorSelectedRgb = this.arrayLookup(this.colorSelected, this.colors, 'name', 'rgb');
            },
            arrayLookup(searchValue,array,searchIndex,returnIndex)
            {
                var returnVal = null;
                var i;
                for(i=0; i<array.length; i++)
                {
                    if(array[i][searchIndex]==searchValue)
                    {
                    returnVal = array[i][returnIndex];
                    break;
                    }
                }
                return returnVal;
            },
            colorSelected: $wire.entangle('{{ $getStatePath() }}'),
        }"
        x-init="init()"
    >
        <div class="flex items-center relative">
            <div class="w-full">
                <input
                    x-ref="input"
                    id="{{ $getId() }}"
                    type="text"
                    {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : "Pick a color" !!}
                    class="w-full bg-white block border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:border-primary-600 dark:text-white disabled:opacity-70 duration-75 focus:border-primary-600 focus:outline-none focus:ring-1 focus:ring-inset focus:ring-primary-600 focus:shadow-outline leading-normal px-4 py-2 rounded-lg shadow-sm text-gray-700 transition"
                    readonly
                    x-model="colorSelected"
                />
            </div>
            <div class="ml-3 w-auto">
                <button
                    type="button"
                    @click="isOpen = !isOpen"
                    class="w-10 h-10 rounded-full focus:outline-none focus:shadow-outline inline-flex p-2 shadow"
                    :class="{ 'text-white': darkSelector, 'text-black': ! darkSelector }"
                    :style="{ 'background-color': colorSelectedHex }"
                >
                    {{-- :style="{ 'text-color': darkSelector }"> --}}
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="none" d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z" />
                        <path d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z" />
                    </svg>
                </button>
            </div>
            <div
                x-show="isOpen" @click.away="isOpen = false"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute top-full left-0 w-full h-64 mt-4 bg-gray-800 rounded-md shadow-lg z-50 border border-gray-300"
            >
                <div class="rounded-md shadow-xs w-full h-full overflow-hidden flex flex-col">
                    <div class="text-xs text-gray-50 text-center w-full pt-2">Preview zone</span></div>
                    <div class="rounded-md border-dashed border border-gray-50 h-12 md:h-16 m-4 mt-2">
                        <div
                            class="w-full h-full rounded-md"
                            :style="`background-color: #${colorSelectedHex};`"
                        ></div>
                    </div>
                    <div class="grid grid-cols-10 pt-2 bg-gray-100 h-full overflow-y-auto">
                        <template x-for="color in colors" :key="color.name">
                            <div class="w-full h-full p-1">
                                <template x-if="colorSelected === color.name">
                                    <div
                                        class="w-full h-full inline-flex rounded-md cursor-pointer border border-gray-400"
                                        style="box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);"
                                        :style="`background-color: #${color.hex}`"
                                        :title="color.name"
                                    ></div>
                                </template>
                                <template x-if="colorSelected != color.name">
                                    <div
                                        @click="changeColor(color.name, color.hex)"
                                        wire:keydown.enter="changeColor(color.name, color.hex)" role="checkbox"
                                        tabindex="0" :aria-checked="colorSelected"
                                        class="w-full h-full inline-flex rounded-md cursor-pointer border border-gray-400 focus:outline-none focus:shadow-outline"
                                        :style="`background-color: #${color.hex}`"
                                        :title="color.name"
                                    ></div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-forms::field-wrapper>
