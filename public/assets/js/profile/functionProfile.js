// Document ready function
$(function() {
    var base_url = window.location.origin;

    // Check if photoid parameter exists in the URL
    const params = window.location.search;
    const urlParams = new URLSearchParams(params);
    const photoid = urlParams.get('photoid');
    if (photoid != null) {
        getDetailFoto(photoid);
    }

    // Copy shareable link to clipboard
    $(".icon-share").click(function(){
        var id = $(this).attr("photo-data");
        navigator.clipboard.writeText(base_url + "?photoid=" + id);
        showSnackbar('Copied!', '#24D1BC');
    });

    // Delete photo
    $(document).on("click", "#delete-photo-btn", function(){
        var id_photo = $(this).attr("photo-id");
        var photo_name = $(this).attr("photo-name");
        $("#delete-button").attr("photo-id", id_photo);
        $("#delete-text").html("Are you sure you want to delete the photo <span class='fw-bold'>" + photo_name + "</span>?");
        $("#delete-modal").modal("show");
    });

    // Handle delete confirmation
    $(document).on("click", "#delete-button", function(){
        var id_photo = $(this).attr("photo-id");
        data = { "id_photo": id_photo };
        $.ajax({
            url: "/delete-photo",
            type: "post",
            data: data,
            success: function(response) {
                if(response === "sukses"){
                    showSnackbar('Successfully Deleted Photo!', '#24D1BC');
                    setTimeout(location.reload(), 2000);
                } else {
                    showSnackbar('Failed to Delete Photo!', '#ff69b4');
                }
            }
        });
    });

    // Variables for editing photo
    var photo_name = "";
    var photo_desc = "";

    // Edit photo
    $(document).on("click", "#edit-photo-btn", function(){
        var userId = $("#user-data").val();
        var photo_id = $(this).attr("photo-id");
        photo_name = $(this).attr("photo-name");
        var photo_data = $(this).attr("photo-data");
        photo_desc = $(this).attr("photo-desc");
        var user_id = $(this).attr("user-id");

        $("#photo-id").val(photo_id);
        $("#userid-edit").val(user_id);
        $("#edit-img").attr("src", "assets/img/gallery/" + photo_data);
        $("#edit-judul").attr("value", photo_name);
        $("#edit-deskripsi").html(photo_desc);

        $("#EditPhotoModal").modal("show");
    });

    // Reset edit form
    $(document).on("click", "#reset-edit-btn", function(){
        $("#edit-judul").attr("value", photo_name);
        $("#edit-deskripsi").html(photo_desc);
    });

    // Handle edit photo form submission
    $("#editPhotoForm").submit(function(e){
        e.preventDefault();
        data = $("#editPhotoForm").serializeObject();
        $.ajax({
            url: "/edit-photo",
            type: "post",
            data: data,
            success: function(response) {
                if(response === "sukses"){
                    showSnackbar('Successfully Edited Photo!', '#24D1BC');
                    setTimeout(location.reload(), 3000);
                } else {
                    showSnackbar('Failed to Edit Photo!', '#ff69b4');
                }
            }
        });
    });

    // Handle edit profile form submission
    $("#edit-photo-form").submit(function(e){
        e.preventDefault();
        var formData = new FormData($('#edit-photo-form')[0]);
        
        $.ajax({
            url: '/profile-edit',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                showSnackbar(response.message, '#24D1BC');
                setTimeout(location.reload(), 2000);
            },
            error: function(error) {
                showSnackbar('Failed, ' + error, '#ff69b4');
            }
        });
    });

    // Edit profile 
    $(document).on("click", "#edit-profile-btn", function(){
        userid = $(this).attr("data-user");
        data = { "user_id": userid };
        $.ajax({
            url: "/getCurrentUser",
            type: "post",
            data: data,
            success: function(response) {
                data = response.data[0];
                $("#userid_input").attr("value", data.user_id);
                $("#namaLengkap_input").attr("value", data.nama_lengkap);
                $("#email_input").attr("value", data.email);
                $("#username_input").attr("value", data.username);
                $("#bio_input").html(data.describe_profile);
                $("#preview-profile").attr("src", base_url + `/assets/img/profile/${data.photo_profile}`);
                $("#editProfileModal").modal("show");
            }
        });
    });

    // Preview profile image on change
    $('#photo-profile-edit').change(function() {
        previewImages(this);
    });

    $('#photo-upload').change(function() {
        previewUpload(this);
    });

    function previewUpload(input) {
        var fileInput = input;
        var imagePreview = $('#preview-upload')[0];
        
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    // Function to display preview image
    function previewImages(input) {
        var fileInput = input;
        var imagePreview = $('#preview-profile')[0];
        
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    // upload photo 

    $(document).on("click", ".upload-photo", function(){
        console.log("yes")
        $("#postFotoModal").modal("show")
    })

    // Add comment
    $("#add-comment-form").submit(function(e){
        e.preventDefault()
        data = $("#add-comment-form").serialize()
        console.log(data)
        addComment(data)
    });

    // Function to add comment
    function addComment(comment){
        $.ajax({
            url: "/comment",
            type: "post",
            data: comment,
            success: function(response) {
                console.log(response.data)
                if (response.status === "sukses") {
                    let commentHtml = generateCommentHtml(response.data);
                    $("#comment-section").html(commentHtml);
                    $("#comment").val("");
                } else {
                    handleCommentError(response);
                }
            }
        });
    }

    // Like button click event
    $("#likeBtn").click(function() {
        likeAction();
        return false; // Stop the actual form post !important!
    });

    // Close modal
    $(".close").click(function() {
        hideModal();
    });

    // Get detail photo on click
    $(document).on("click", ".expand-photo", function() {
        var userId = $("#user-data").val();
        isUserHasLiked(userId, $(this).attr("data-id"));
        getDetailFoto($(this).attr("data-id"));
    });

    // Check if the user has liked the photo
    function isUserHasLiked(user_id, id_photo){
        data = { "id_photo": id_photo, "user_id": user_id };
        $.ajax({
            url: "/has-liked",
            type: "post",
            data: JSON.stringify(data),
            success: function(response) {
                var $iconLikeStatus = $("#icon-like-status");
                if (response.hasLiked) {
                    $iconLikeStatus.removeClass("bi-heart").addClass("bi-heart-fill");
                    $iconLikeStatus.addClass("loved");
                } else {
                    $iconLikeStatus.removeClass("bi-heart-fill loved").addClass("bi-heart");
                }
            }
        });
    }

    // Handle like action
    function likeAction() {
        data = $("#likes-form").serialize();
        $.ajax({
            type: "POST",
            url: "/likes",
            data: data,
            success: function(responses) {
                handleLikeResponse(responses);
                const likeText = (responses.totalLike > 1) ? "likes" : "like";
                $("#total-like").html(`${responses.totalLike} ${likeText}`);
            }
        });
    }

    // Hide modal
    function hideModal() {
        $(".modal").modal("hide");
    }

    // Get detail photo
    function getDetailFoto(id) {
        $.ajax({
            url: "/detail-foto/" + id,
            type: "get",
            success: function(response) {
                handleDetailFotoResponse(response, id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    // Handle like response
    function handleLikeResponse(responses) {
        var $iconLikeStatus = $("#icon-like-status");
        if (responses.status === "Liked") {
            $iconLikeStatus.removeClass("bi-heart").addClass("bi-heart-fill");
            $iconLikeStatus.addClass("loved");
            showSnackbar('Liked!', '#24D1BC');
        } else if (responses.status === "unLiked") {
            $iconLikeStatus.removeClass("bi-heart-fill loved").addClass("bi-heart");
            showSnackbar('Unliked :(', '#ff69b4');
        } else {
            showSnackbar('Something went wrong, try again!', '#ff69b4');
        }
    }

    // Handle detail photo response
    function handleDetailFotoResponse(response, id) {
        const responseDetail = response.detail_foto[0];

        $(".photo-data").val(id);
        $(".icon-share").attr("photo-data", id);
        $("#img-blur, #img-main").attr("src",  base_url + `/assets/img/gallery/${responseDetail.photo}`);
        $("#profile-user").attr("src",  base_url + `/assets/img/profile/${responseDetail.photo_profile}`);
        $("#profile-modal").text(responseDetail.username);
        $("#judul-foto-modal").html(responseDetail.judul_foto);
        $("#deskripsi-foto-modal").html(responseDetail.describe_photo);

        const likeText = (response.totalLike > 1) ? "likes" : "like";
        $("#total-like").html(`${response.totalLike} ${likeText}`);

        let commentHtml = generateCommentHtml(response.comment);
        $("#comment-section").html(commentHtml);

        showModal();
    }

    // Show snackbar
    function showSnackbar(text, textColor) {
        Snackbar.show({
            text: text,
            backgroundColor: '#fff',
            textColor: textColor,
            pos: 'top-right',
            duration: '2000',
            showAction: false,
        });
    }

    // Generate comment HTML
    function generateCommentHtml(commentArray) {
        let commentHtml = "";
        $.each(commentArray, function(k, v) {
            commentHtml +=
            `<div class="profile-commentator mb-2">
                <a href="/profile-user">
                    <img src="${base_url}/assets/img/profile/${v.photo_profile}" alt="">
                </a>
            </div>
            <div class="detail-comment">
                <a href="/profile-user">
                    <div class="username-commentator">
                        ${v.username}
                    </div>
                </a>
                <div class="isi-comment">
                    ${v.comment}
                </div>
            </div>`;
        });
        return commentHtml;
    }

    // Show modal
    function showModal() {
        $('#ModalPhoto').modal('show');
    }
});
