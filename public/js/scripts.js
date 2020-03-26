function search(url,table_name) {
    var searchText = $("input[name='search']").val();
    $.ajax({
        url: url,
        data: {
            search: searchText
        },
        success: function (data) {
            $(table_name).html(data);
        }
    });
}

function clean_search_results(url,table_name) {
    $.ajax({
        url: url,
        success: function (data) {
            $(table_name).html(data);
        }
    });
    $("#search-field").val("");
}

function filter(url, table_name){
    var selectedValue =  $("#select-change").val();
    $.ajax({
        url: url,
        data: {
            selectedValue: selectedValue
        },
        success: function (data) {
            $(table_name).html(data);
        }
    });
}