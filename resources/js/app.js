import './bootstrap';

import Alpine from 'alpinejs';

import { Datepicker, Input, initTE } from "tw-elements";
initTE({ Datepicker, Input });

import 'flowbite';

window.Alpine = Alpine;

Alpine.start();
