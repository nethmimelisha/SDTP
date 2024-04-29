$(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");

        if (target === '#new-requests') {
            console.log("New requests tab clicked");
        }
    });
});
