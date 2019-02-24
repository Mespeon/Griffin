$(document).ready(function()
{
var wordCounts = {};
$("#word_count").keyup(function() {
    var matches = this.value.match(/\b/g);
    wordCounts[this.id] = matches ? matches.length / 2 : 0;
    var finalCount = 0;
    $.each(wordCounts, function(k, v) {
        finalCount += v;
    });
    $('#display_count').html(finalCount);
    am_cal(finalCount);
}).keyup();
}); 