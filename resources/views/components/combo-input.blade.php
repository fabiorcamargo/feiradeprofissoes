@props(['disabled' => false])
<div class="flex">
    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">
        <img src="{!!$img!!}" {!!$atributes!!}>
    </span>
    <input type="{{$type}}" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-r-lg shadow-sm">
</div>