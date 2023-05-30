import './bootstrap';




import { Datepicker, Input, initTE } from "tw-elements";
initTE({ Datepicker, Input });

import 'flowbite';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
Alpine.plugin(focus)
window.Alpine = Alpine;
Alpine.start();

