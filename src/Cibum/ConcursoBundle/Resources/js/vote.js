$(function () {
    $('#vote-btns button').click(function () {
        var $this = $(this)
        var vote = $this.data('vote');
        var project = $("#snip").html();
        console.log($this.data('url'));
        $.ajax({
            url: $this.data('url'),
            type: 'post',
            data: {
                vote: vote,
                project: project
            },
            success: function() {
                $('#vote-btns button').removeClass('btn-primary');
                $this.addClass('btn-primary')
            },
            error: function() {

            }
        });
    });
});