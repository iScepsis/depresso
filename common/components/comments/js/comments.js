let fadeSpeed = 300; //Скорость анимации эффекта появления/скрытия элементов

/**
 *
 * @param commentId
 * @param username
 */
function setAnswerForComment(commentId, username){
    $('#comments-parent_id').val(commentId);
    $('.answer-info-area').fadeIn(fadeSpeed);
    $('.answer-username').text(username);
}


$(document).ready(function(){
    $('.answer-info-area').on('click', '.close', function(){
        $(this).parents('.answer-info-area').fadeOut(fadeSpeed);
        $('#comments-parent_id').val('');
    });
});