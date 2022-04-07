$(document).ready(function () {
    // Initialize page
    updateMoods();
    setInterval(updateMoods, 10000);
    // updateDevices();
    // setInterval(updateDevices, 5000);
    var table = $('#mac-table').DataTable({
        "ajax": {
            "url": "/getDevices.php",
            "dataSrc": ""
        },
        aoColumns: [
            { mData: 'mac_address' },
            { mData: 'last_seen' },
            { mData: 'pings' },
            { mData: 'label' },
            { mData: 'cohort' }
        ],
        autofill: true,
        select: true,
        responsive: true,
        length: 25
    });
    setInterval(function () {
        // Reload, retaining user paging
        table.ajax.reload((null, false));
    }, 5000);
});


function updateMoods(e) {
    $.getJSON('/getMood.php', (data) => {
        parseMoods(data);
    });
};

function parseMoods(data) {
    // e.preventDefault();
    console.log(data);

    // Grab the selector
    const showMoods = $('#show-moods');

    // Parse mood JSON data, insert into list items
    showMoods.html('<ul>');
    var moodsInfo = data.map(function (item) {
        showMoods.append('<li>' + item.mood_name + ' : ' + item.mood_count + '</li>\n');
    });
    showMoods.append('</ul>');

}

function updateDevices(e) {
    $.getJSON('/getDevices.php', (data) => {
        parseDevices(data);
    });
};

function parseDevices(data) {
    console.log(data);

    // Grab the selector
    const deviceTable = $('#mac-table');
    deviceTable.html('<thead>\n<tr>\n'
        + '<th scope="col">ID</th>\n'
        + '<th scope="col">Last Seen</th>\n'
        + '<th scope="col">Pings</th>\n'
        + '<th scope="col">Cohort</th>\n'
        + '<th scope="col">Label</th>\n'
        + '</tr>\n</thead>\n<tbody>\n');
    var devicesInfo = data.map(function (item) {
        // deviceTable.append('<tr>\n');
        deviceTable.append('<tr>\n<td scope="row">' + item.mac_address + '</td>\n'
            + '<td>' + item.last_seen + '</td>\n'
            + '<td>' + item.pings + '</td>\n'
            + '<td>' + item.cohort + '</td>\n'
            + '<td>' + item.label + '</td>\n</tr>\n'
        );
        // deviceTable.append('</tr>\n');
    });
    deviceTable.append('</tbody>\n');
}
