document.getElementById('searchInput').addEventListener('keyup', filterTable);

function filterTable() {
    var searchInput = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('table tbody tr');

    rows.forEach(function(row) {
      var cells = row.getElementsByTagName('td');
      var found = false;

      // Cek apakah ada pencarian nama
      if (searchInput) {
        for (var i = 0; i < cells.length; i++) {
          if (cells[i].textContent.toLowerCase().includes(searchInput)) {
            found = true;
            break;
          }
        }
      }

      // Tampilkan atau sembunyikan baris berdasarkan pencarian
      if (found || !searchInput) {
        row.style.display = ''; // Tampilkan baris
        row.classList.add('text-white'); // Tambahkan kelas untuk warna putih
      } else {
        row.style.display = 'none'; // Sembunyikan baris
      }
    });
  }

  
