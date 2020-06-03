var csrf_token_header = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };

function search(url, table_name) {
    var searchText = $("input[name='search']").val().trim();
    if (searchText.length === 0) {
        searchText = " ";
    }
    $.ajax({
        url: url,
        headers: csrf_token_header,
        data: {
            search: searchText
        },
        success: function (data) {
            $(table_name).html(data);
        }
    });
}

function clean_search_results(url, table_name) {
    $.ajax({
        url: url,
        headers: csrf_token_header,
        success: function (data) {
            $(table_name).html(data);
        }
    });
    $("#search-field").val("");
}

function filter(url, table_name) {
    var selectedValue = $("#select-change").val().trim();
    $.ajax({
        url: url,
        headers: csrf_token_header,
        data: {
            selectedValue: selectedValue
        },
        success: function (data) {
            $(table_name).html(data);
        }
    });
}