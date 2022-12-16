<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')', lazilyEntangledModifiers: ['defer']) }},
            colors: @js( $getColors() ),
            isOpen: false,
            darkSelector: '',
            colorSelectedName: @js($colorSelectedName),
            colorSelectedHex: @js($colorSelectedHex),
            colorSelectedRgb: @js($colorSelectedRgb),
            changeColor(name, hex, rgb) {
                this.colorSelectedName = name;
                this.colorSelectedHex = hex;
                this.colorSelectedRgb = rgb;
                if (this.textColorContrast(hex)) { this.darkSelector = false} else { this.darkSelector = true};
            },
            init() {
                this.colorSelectedHex = this.arrayLookup(this.colorSelectedName, this.colors, 'name', 'hex');
                this.colorSelectedRgb = this.arrayLookup(this.colorSelectedName, this.colors, 'name', 'rgb');
            },
            textColorContrast(bgColor) {
                var color = (bgColor.charAt(0) === '#') ? bgColor.substring(1, 7) : bgColor;
                var r = parseInt(color.substring(0, 2), 16); // hexToR
                var g = parseInt(color.substring(2, 4), 16); // hexToG
                var b = parseInt(color.substring(4, 6), 16); // hexToB
                var uicolors = [r / 255, g / 255, b / 255];
                var c = uicolors.map((col) => {
                if (col <= 0.03928) {
                  return col / 12.92;
                }
                return Math.pow((col + 0.055) / 1.055, 2.4);
                });
                var L = (0.2126 * c[0]) + (0.7152 * c[1]) + (0.0722 * c[2]);
                console.log(L > 0.179);
                return (L > 0.179);
            },
            arrayLookup(searchValue,array,searchIndex,returnIndex)
            {
                var returnVal = null;
                var i;
                for(i=0; i<array.length; i++) {
                    if(array[i][searchIndex]==searchValue) {
                    returnVal = array[i][returnIndex];
                    break;
                    }
                }
                return returnVal;
            },
            colorSelectedName: $wire.entangle('{{ $getStatePath() }}'),
        }"
        x-init="init()"
         wire:ignore.self
    >


        @if ($label = $getPrefixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif
        <div class="flex items-center relative">
            <div class="flex w-full border border-gray-300 focus:border-primary-600 dark:border-gray-600 dark:focus:border-primary-600 rounded-lg overflow-hidden">
                <input
                    x-ref="input"
                    id="{{ $getId() }}"
                    type="text"
                    @click="isOpen = !isOpen"
                    {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                    {!! $isLazy() ? "x-on:blur=\"\$wire.\$refresh\"" : null !!}
                    {!! $isDebounced() ? "x-on:input.debounce.{$getDebounce()}=\"\$wire.\$refresh\"" : null !!}
                    {{ $getExtraAlpineAttributeBag() }}
                    {!! ($placeholder = $getPlaceholder()) ? "placeholder=\"{$placeholder}\"" : "Pick a color" !!}
                    class="block w-full px-4 py-2 leading-normal border-0 bg-white dark:bg-gray-700 text-gray-700 dark:text-white disabled:opacity-70 duration-75 focus:outline-none focus:ring-0 shadow-none focus:shadow-none transition"
                    readonly
                    x-model="colorSelectedName"
                    wire:ignore.self
                />
                <button
                    type="button"
                    @click="isOpen = !isOpen"
                    class="inline-flex p-2 w-10 h-10 border-l border-gray-300 focus:outline-none focus:shadow-outline shadow"
                    :class="{ 'text-white': darkSelector, 'text-black': ! darkSelector }"
                    :style="`background-color: #${colorSelectedHex}`"
                    wire:ignore.self
                >
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
                wire:ignore.self
                class="absolute top-full left-0 w-full h-64 mt-4 bg-white rounded-md shadow-lg z-50 border border-gray-300 overflow-hidden"
            >
                <div class="rounded-md shadow-xs w-full h-full overflow-hidden flex flex-col">
                    <div class="relative rounded-md border border-gray-300 h-12 md:h-16 m-4 overflow-hidden">
                        <div
                            class="w-full h-full rounded-md flex items-center justify-center"
                            :style="`background-color: #${colorSelectedHex}`"
                            wire:ignore.self
                        ></div>
                        <div class="absolute right-0 bottom-0 py-1 px-2 text-xs bg-white rounded-tl-md" wire:ignore.self x-text="`${colorSelectedName}` !== `null` ? `${colorSelectedName}` : 'Pick a color'"></div>
                    </div>
                    <div class="grid grid-cols-10 pt-2 bg-white border-t border-gray-300 h-full overflow-y-auto">
                        <template x-for="color in colors" :key="color.name" wire:ignore.self>
                            <div class="w-full h-full p-1">
                                <template x-if="colorSelectedName === color.name" wire:ignore.self>
                                    <div
                                        class="w-full h-full inline-flex rounded-md cursor-pointer border border-gray-400"
                                        style="box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);"
                                        :style="`background-color: #${color.hex}`"
                                        :title="color.name"
                                        wire:ignore.self
                                    ></div>
                                </template>
                                <template x-if="colorSelectedName != color.name" wire:ignore.self>
                                    <div
                                        @click="changeColor(color.name, color.hex)"
                                        wire:keydown.enter="changeColor(color.name, color.hex)"
                                        wire:ignore.self
                                        role="checkbox"
                                        tabindex="0" :aria-checked="colorSelectedName"
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
</x-dynamic-component>
