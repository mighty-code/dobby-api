require('./bootstrap');

import Alpine from 'alpinejs'

import { format, formatDistance, formatRelative, subDays } from 'date-fns'

window.format = format

window.Alpine = Alpine

Alpine.start()


