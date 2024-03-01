$(function() {
    var base_url = window.location.origin;
    
    const params = window.location.search;
    const urlParams = new URLSearchParams(params);
    const photoid = urlParams.get('photoid')
    // ?photoid=1
    
    if(photoid != null){
        getDetailFoto(photoid)
    }

    $(".icon-share").click(function(){
        var id = $(this).attr("photo-data");
        navigator.clipboard.writeText(base_url+"?photoid="+id);
        showSnackbar('Copied!', '#24D1BC');
    });
    
    // tambah komentar

    $("#add-comment-form").submit(function(e){
        e.preventDefault()
       data = $("#add-comment-form").serialize()
       console.log(data)
       addComment(data)
    })

    function addComment(coment){
        $.ajax({
            url: "/comment",
            type: "post",
            data: coment,
            success: function(response) {
                console.log(response.data)
                if (response.status === "sukses") {
                    let isi_comment = generateCommentHtml(response.data);
                    $("#comment-section").html(isi_comment);
                    $("#comment").val("")
                } else {
                    try {
                        const errorResponse = JSON.parse(response);
                        if (errorResponse.error && errorResponse.error.comment) {
                            console.log("Kesalahan: " + errorResponse.error.comment);
                            showSnackbar('Gagal, ' + errorResponse.error.comment, '#ff69b4');
                        } else {
                            console.error("Format respons error tidak valid:", errorResponse);
                            showSnackbar('Gagal, terjadi kesalahan', '#ff69b4');
                        }
                    } catch (error) {
                        console.error("Terjadi kesalahan dalam parsing JSON respons error:", error);
                        showSnackbar('Gagal, terjadi kesalahan', '#ff69b4');
                    }
                }
                
            }
        });
    }

    // Tombol Like
    $("#likeBtn").click(function() {
        likeAction();
        return false; // Stop the actual form post !important!
    });
    
    // hide modal
    $(".close").click(function() {
        hideModal();
    });
    
    // ajax get detail foto
    $(document).on("click", ".gallery-item", function() {
        console.log("tes")
        var userId = $("#user-data").val();
        isUserHasLiked(userId, $(this).attr("data-id"))
        getDetailFoto($(this).attr("data-id"));
        
    });
    
    // is User Has Liked the photo
    function isUserHasLiked(user_id, id_photo){
        data = { "id_photo": id_photo, "user_id": user_id }
        $.ajax({
            url: "/has-liked",
            type: "post",
            data: JSON.stringify(data),
            success: function(response) {
                var $iconLikeStatus = $("#icon-like-status");
                if (response.hasLiked) {
                    // Jika user sudah menyukai foto, ubah class element
                    $iconLikeStatus.removeClass("bi-heart").addClass("bi-heart-fill");
                    $iconLikeStatus.addClass("loved");
                } else {
                    $iconLikeStatus.removeClass("bi-heart-fill loved").addClass("bi-heart");
                }
                
            }
        });
    }
    
    // Function to handle like action
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
    
    // Function to hide modal
    function hideModal() {
        $(".modal").modal("hide");
    }
    
    // Function to get detail foto
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
    
    // Function to handle like response
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
            showSnackbar('Something was wrong, try again!', '#ff69b4');
        }
    }
    
    // Function to handle detail foto response
    function handleDetailFotoResponse(response, id) {
        const responseDetail = response.detail_foto[0];
        
        $(".photo-data").val(id);
        $(".icon-share").attr("photo-data", id);
        $("#img-blur, #img-main").attr("src",  base_url+`/assets/img/gallery/${responseDetail.photo}`);
        $("#profile-user").attr("src",  base_url+`/assets/img/profile/${responseDetail.photo_profile}`);
        $("#profile-modal").text(responseDetail.username);
        $("#judul-foto-modal").html(responseDetail.judul_foto);
        $("#deskripsi-foto-modal").html(responseDetail.describe_photo);
        
        const likeText = (response.totalLike > 1) ? "likes" : "like";
        $("#total-like").html(`${response.totalLike} ${likeText}`);
        
        let isi_comment = generateCommentHtml(response.comment);
        $("#comment-section").html(isi_comment);
        
        showModal();
    }
    
    // Function to show snackbar
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
    
    // Function to generate comment HTML
    function generateCommentHtml(commentArray) {
        let isi_comment = "";
        $.each(commentArray, function(k, v) {
            isi_comment +=
            `<div class="profile-commentator mb-2">
            <a href="/profile-user">
            <img src="`+base_url+`/assets/img/profile/${v.photo_profile}" alt="">
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
        return isi_comment;
    }
    
    // Function to show modal
    function showModal() {
        $('#ModalPhoto').modal('show');
    }
});
