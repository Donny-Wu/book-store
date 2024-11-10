import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import swal from 'sweetalert2';
window.Swal = swal;
import select2 from 'select2';
select2($);

import.meta.glob([
    '../images/**',
    '../fonts/**',
    '../videos/**',
  ]);
