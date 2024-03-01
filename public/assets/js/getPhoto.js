
//get photo halaman utama

$(document).ready(function () {
    $.ajax({
        url: "/getPhoto",
        type: "get",
        success: function (response) {
            console.log(response);

            // Mendapatkan array foto dari JSON
            var photos = response.foto;

            // Membagi foto ke dalam 4 kolom
            var columns = [[], [], [], []];

            photos.forEach(function (photo, index) {
                columns[index % 4].push(photo);
            });

            // Membuat HTML untuk setiap kolom
            var htmlColumns = columns.map(function (column) {
                var htmlItems = column.map(function (photo) {
                    return `<div class="gallery-item" data-id="${photo.id_photo}">
                                <img src="/assets/img/gallery/${photo.photo}" class="img-fluid" alt="">
                                <div class="gallery-links d-flex align-items-center justify-content-center">
                                    <a href="#" title="Detail" class="preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                </div>
                            </div>`;
                }).join('');

                return `<div class="galeri-col">${htmlItems}</div>`;
            }).join('');

            // Menyisipkan HTML ke dalam elemen dengan id "galeri-section"
            $("#galeri-section").html(htmlColumns);
        }
    });
});
