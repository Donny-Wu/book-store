import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;
import swal from 'sweetalert2';
window.Swal = swal;
import.meta.glob([
    '../images/**',
    '../fonts/**',
    '../videos/**',
  ]);
