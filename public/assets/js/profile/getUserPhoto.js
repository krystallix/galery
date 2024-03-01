

// get photo posted by u

$(document).ready(function () {
    var userId = $("#user-id").val();
    data = { "user_id": userId }
    $.ajax({
        url: "/getUserPhoto",
        type: "post",
        data: data,
        success: function (response) {
            console.log(response);

            // Mendapatkan array foto dari JSON
            var photos = response.foto;

            console.log(photos)
            // Membagi foto ke dalam 4 kolom
            var columns = [[], [], [], []];

            photos.forEach(function (photo, index) {
                columns[index % 4].push(photo);
            });

            // Membuat HTML untuk setiap kolom
            var htmlColumns = columns.map(function (column) {
                var htmlItems = column.map(function (photo) {
                    return `<div class="gallery-item" >
                                <img src="assets/img/gallery/${photo.photo}" class="img-fluid" alt="">
                                <div class="gallery-links d-flex align-items-center justify-content-center">
                                    <button type="button" title="Detail" class="preview-link expand-photo" data-id="${photo.id_photo}"><i
                                            class="bi bi-arrows-angle-expand"></i></button>
                                        <button type="button" id="delete-photo-btn" class="preview-link" photo-name="${photo.judul_foto}" photo-id="${photo.id_photo}"><i
                                                class="bi bi-trash3-fill h3"></i></button>
                                    </form>
                                    <button type="button" class="details-link" id="edit-photo-btn" user-id="${photo.user_id}" photo-name="${photo.judul_foto}" photo-id="${photo.id_photo}" photo-data="${photo.photo}" photo-desc="${photo.describe_photo}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                </div>
                            </div>
                            `;
                }).join('');

                return `<div class="galeri-col">${htmlItems}</div>`;
            }).join('');

            // Menyisipkan HTML ke dalam elemen dengan id "galeri-section"
            $("#galeri-profile-section").html(htmlColumns);
        }
    });
});