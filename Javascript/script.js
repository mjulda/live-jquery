// LIVE search === menggunakan fitur ajax
// berikan id pada element yang akan di pakai
// input id="keywords"
// button id="tombol-cari"
// <div id="container">

// var keywords = document.getElementById('keywords');
// var tombolCari = document.getElementById('tombol-cari');
// var container = document.getElementById('container');

// utk menjalankan ajax kita membutuhkan triger == sebuah aksi yang kita lakukan utk menjalankan ajax nya
// misal ketika mengganti elemen, = = menginput dll di javasript di sebut ============= event cnt onclick
// tambahkan event ketikan input di tulis
// console.log(keywords.value); == akan mengembalikan semua nilai

// ======================================================================
// Jika menggunakan Javascript

// keywords.addEventListener('keyup', function(){

//     // buat object ajax
//     var ajax = new XMLHttpRequest();

//     // cek kesiapan ajax nya
//     ajax.onreadystatechange = function(){
//         if(ajax.readyState == 4 && ajax.status == 200){
//             // apapun yang ada di talam coba.txt ganti isinya container
//             container.innerHTML = ajax.responseText;
//         }
//     }
//     // eksekusi ajax
//     ajax.open('GET','ajax/mahasiswa.php?keywords='+ keywords.value,true);
//     // pada saat kita mengambil data di mahasiswa.php degan GET
//     // kita juga sambil mengirim data keywords
//     ajax.send();
// });

// =========================================================================
// Jika menggunakan Jquery
$(document).ready(function () {
  $('#keywords').on('keyup', function(){
      // munculkan icon load
      $('.load').show();
      //jQuery tolong carikan saya element keywords on ketika keyup, jalankan fungsi berikut ini
      // ajax menggunakan load
    //   $('#container').load('ajax/mahasiswa.php?keywords=' + $('#keywords').val());
      // jQuery tolong carikan saya sebuah element container, lalu load isinya(ubah isinya)
      // dengan data yang kita ambil dari sumber dari ajax/mahasiswa.php
      // lalu kirimkan data keywords ?= diisi dengan apapun yang diketik user .val()
      // ingat fungsi load diatas hanya berfungsi menggunakan $_GET 

      $.get('ajax/mahasiswa.php?keywords=' + $('#keywords').val(),function(data){
          $('#container').html(data);
          $('.load').hide();
      })
  });
});
