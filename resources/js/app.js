import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';
import 'select2/dist/js/select2.min';

// Inisialisasi Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Inisialisasi Select2
$(document).ready(function () {
    $('#tembusan').select2({
        placeholder: "Pilih Tembusan (Bisa lebih dari satu)",
        allowClear: true
    });
});
