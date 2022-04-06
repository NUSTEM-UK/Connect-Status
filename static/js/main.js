$(document).ready(() => {
    // Initialize page
    updateMoods();
    setInterval(updateMoods, 5000);
});

function updateMoods(e) {
    $.getJSON('/getMood.php', (data) => {
        parseMoods(data);
    });
};

function parseMoods(data) {
    // e.preventDefault();
    console.log(data);

    const $showMoods = $('#show-moods');
    const $raw = $('pre');
    // Parse mood JSON data, insert into list items
    console.log(data.mood_name);

    $('#show-moods').html('<ul>');
    var moodsInfo = data.map( function(item) {
        $('#show-moods').append('<li>' + item.mood_name + ' : ' + item.mood_count + '</li>');
    });
    $('#show-moods').append('</ul>');

}
