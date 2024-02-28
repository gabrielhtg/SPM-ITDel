<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-title {
            overflow-wrap: break-word;
            color: #106cfc; /* Ubah warna judul kartu */
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Ubah warna latar belakang footer sesuai kebutuhan */
            text-align: center;
        }
    </style>
</head>
@include("components.guessnavbar")

<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Document Management<span></span></h1>
                <h2>disini anda dapat melihat setiap document yang tersedia</h2>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<body style="margin: -10px 0;">

<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="form-inline">
                    <input id="searchInput" class="form-control mr-sm-2 flex-grow-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <div class="row" id="documentCards">
        <!-- Kartu dokumen akan ditampilkan di sini -->
    </div>
</div>

<div class="container mt-5">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end" id="pagination">
            <!-- Tombol penomoran halaman akan ditampilkan di sini -->
        </ul>
    </nav>
</div>

<footer class="footer py-3">
    <!-- @include('components.footer') -->
    <!-- Footer konten akan ditampilkan di sini -->
</footer>

<!-- jQuery and Bootstrap JS libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data dokumen
        const documents = {!! json_encode($documents) !!};
        const numPerPage = 8;
        let currentPage = 1;
        let filteredDocuments = []; // Variabel untuk menyimpan hasil pencarian

        // Fungsi untuk menampilkan kartu dokumen sesuai halaman yang dipilih
        function displayDocuments(page) {
            const startIndex = (page - 1) * numPerPage;
            const endIndex = startIndex + numPerPage;
            const paginatedDocuments = filteredDocuments.length > 0 ? filteredDocuments.slice(startIndex, endIndex) : documents.slice(startIndex, endIndex);

            const documentCardsContainer = document.getElementById('documentCards');
            documentCardsContainer.innerHTML = '';

            paginatedDocuments.forEach(function(e) {
                const accessor = e.give_access_to.split(";");
                let documentTitle = e.name;
                if (documentTitle.length > 10) {
                    documentTitle = documentTitle.substring(0, 29) + "...";
                }
                if (accessor.includes('0')) {
                    const cardHTML = `
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h2 class="card-title">${documentTitle}</h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Tipe: ${e.tipe_dokumen} | User Upload: ${e.created_by.name}</p>
                                    <a href="/view-document-detail/${e.id}" class="btn btn-primary">View Detail</a>
                                </div>
                            </div>
                        </div>`;
                    documentCardsContainer.innerHTML += cardHTML;
                }
            });
        }

        // Fungsi untuk menampilkan tombol-tombol penomoran halaman
        function displayPagination() {
            const totalItems = filteredDocuments.length > 0 ? filteredDocuments.length : documents.length;
            const totalPages = Math.ceil(totalItems / numPerPage);
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                if (i === currentPage) {
                    li.classList.add('active');
                }
                const a = document.createElement('a');
                a.classList.add('page-link');
                a.href = '#';
                a.innerText = i;
                a.addEventListener('click', function() {
                    currentPage = i;
                    displayDocuments(currentPage);
                    updatePagination();
                });
                li.appendChild(a);
                paginationContainer.appendChild(li);
            }

            // Tambahkan tombol "Next"
            const nextLi = document.createElement('li');
            nextLi.classList.add('page-item');
            const nextLink = document.createElement('a');
            nextLink.classList.add('page-link');
            nextLink.href = '#';
            nextLink.innerText = 'Next';
            nextLink.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayDocuments(currentPage);
                    updatePagination();
                }
            });
            nextLi.appendChild(nextLink);
            paginationContainer.appendChild(nextLi);
        }

        // Fungsi untuk memperbarui tampilan penomoran halaman
        function updatePagination() {
            const paginationItems = document.querySelectorAll('#pagination .page-item');
            paginationItems.forEach(function(item, index) {
                if (index + 1 === currentPage) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        // Pemanggilan fungsi untuk menampilkan dokumen dan penomoran halaman
        displayDocuments(currentPage);
        displayPagination();

        // Fungsi pencarian
        const searchInput = document.getElementById("searchInput");
        searchInput.addEventListener("input", function() {
            const searchQuery = searchInput.value.toLowerCase();
            filteredDocuments = documents.filter(function(e) {
                const documentTitle = e.name.toLowerCase();
                return documentTitle.includes(searchQuery);
            });
            currentPage = 1;
            displayDocuments(currentPage);
            displayPagination();
        });
    });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen input pencarian
    const searchInput = document.getElementById("searchInput");

    // Tambahkan event listener untuk mengawasi perubahan input
    searchInput.addEventListener("input", function() {
        // Ambil nilai pencarian
        const searchQuery = searchInput.value.toLowerCase();

        // Ambil semua kartu dokumen
        const documentCards = document.querySelectorAll(".card");

        // Iterasi melalui setiap kartu dokumen
        documentCards.forEach(function(card) {
            // Ambil judul dokumen dari kartu
            const documentTitle = card.querySelector(".card-title").innerHTML.toLowerCase();

            // Periksa apakah judul dokumen cocok dengan kueri pencarian
            if (searchQuery === "") {
                // Kembalikan struktur HTML ke aslinya jika pencarian kosong
                card.parentNode.classList.remove("col-lg-15");
                card.parentNode.classList.add("col-lg-6");
                card.parentNode.style.display = "block";
            } else if (documentTitle.includes(searchQuery)) {
                // Tampilkan kartu dokumen jika cocok
                card.parentNode.classList.add("col-lg-15");
                card.parentNode.classList.remove("col-lg-6");
                card.parentNode.style.display = "block";
            } else {
                // Sembunyikan kartu dokumen jika tidak cocok
                card.parentNode.style.display = "none";
            }
        });
    });
});


</script>

</body>
</html>
